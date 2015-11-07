<?php
get_header();
?>
<!-- Inicia slider -->
    <div id="slider">
      <h1 class="titPagina">Temas</h1>
    </div>
    <!-- termina slider -->
    <div id="contenidoNoticiaPrincipal" class="row">
      <?php
  if ( have_posts() ) {
  	while ( have_posts() ) {
      the_post();
      ?>
      <div id="noticiaContenido" class="large-9 medium-9 left">
          <div class="tituloDnoticia">
              <h1 class="tituloNoticia"><?php the_title(); ?></h1>
              <?php
                if (has_post_thumbnail()) {
                  ?>
                  <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
                        $url = $thumb['0']; ?>
                  <div style="margin:0px;"><img src="<?php echo $url;?>" style="max-width:100%;" /></div>
                  <?php
                }
              ?>
          </div>
          <div class="contenidoNoticia">
            <?php the_content(); ?>
          </div>
          <?php 
          $keywords = wp_get_post_tags( $post->ID, array( 'fields' => 'names' ));
          $arreglo = "";
        
              if (!empty($keywords)) {
                  //var_dump($keywords);
                  foreach ($keywords as $k => $value) {
                      if ($k == 0) {
                          $arreglo = $arreglo.$value;
                      } else {
                          $arreglo = $arreglo.", ".$value;
                      }
                      //echo $arreglo;
                  }
                  ?>
                  <div id="Etiquetas del post" style="font-style: italic; color: #ccc;">Etiquetas del post: <?php echo $arreglo;?></div>
                  <?php
              }
          ?>
      </div>
      <?php
  	} // end while
  } // end if
  ?>
    <div id="menuOp" class="large-3 medium-3 small-12 left">
      <?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
  $etiquetas = array();
foreach ($tags as $key => $value) {
  $etiquetas[$key] = $value->term_id;
}
$args=array(
'tag__in' => $etiquetas,
'post__not_in' => array($post->ID),
'posts_per_page'=>4,
'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
?>
<h3>Articulos Relacionados:</h3>
<?php
while ($my_query->have_posts()) : $my_query->the_post(); ?>
<div class="itemMain large-12 medium-12 left columns">
  <div class="containergrid">
    <div class="overlay">
      <a href="<?php the_permalink(); ?>">
        <p><?php the_title(); ?></p>
      </a>
    </div>
    <?php
    if (has_post_thumbnail()) {
      $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'side-size' );
      ?>
      <img class="imagenSeleccion" src="<?php echo $url[0]; ?>" alt="">
      <?php
    } else {
      ?>
      <img class="imagenSeleccion" src="<?php bloginfo('template_url');?>/img/test.png" alt="">
      <?php
    }
    ?>
  </div>
</div>
<?php
endwhile;
}
wp_reset_query();
}
?>
<?php dynamic_sidebar( 'articles-sidebar' ); ?>
    </div>
    </div>

<?php
get_footer();
?>