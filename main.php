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
    </div>

<?php
get_footer();
?>
