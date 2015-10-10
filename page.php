<?php
get_header();
?>
<!-- Inicia slider -->
    <div id="slider">
      <?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();
      ?>
      <h1 class="titPagina"><?php the_title(); ?></h1>
    </div>
    <!-- termina slider -->
    <div id="contenidoNoticiaPrincipal" class="row">

      <div id="noticiaContenido" class="large-9 medium-9 left">
          <div class="tituloDnoticia">
              <?php
                if (has_post_thumbnail()) {
                  ?>
                  <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
                        $url = $thumb['0']; ?>
                  <div style="background: url(<?php echo $url;?>); background-size:cover; width: 100%; height:300px;"></div>
                  <?php
                }
              ?>
          </div>
          <div class="contenidoNoticia">
            <?php the_content(); ?>
          </div>
      </div>
      <?php
    } // end while
  } // end if
  ?>
    <div id="menuOp" class="large-3 medium-3 small-12 left">
      <?php
$popularpost = new WP_Query( array( 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
if ($popularpost->have_posts()) {
  ?>
  <h3>Articulos y Noticias Destacados:</h3>
  <?php
  while ( $popularpost->have_posts() ) : $popularpost->the_post();
?>
<div class="itemMain large-12 medium-12 left columns">
  <div class="containergrid">
    <div class="overlay">
      <a href="<?php the_permalink(); ?>">
        <p><?php the_title(); ?></p>
      </a>
    </div>
    <?php
    if (has_post_thumbnail()) {
      $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(300,140) );
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
?>
<?php dynamic_sidebar( 'pages-sidebar' ); ?>
    </div>
    </div>

<?php
get_footer();
?>
