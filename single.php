<?php
get_header();
?>
<!-- Inicia slider -->
    <div id="slider">
      <h1 class="titPagina">Temas</h1>
    </div>
    <!-- termina slider -->
    <div id="contenidoNoticiaPrincipal" class="row">
      <div id="noticiaContenido" class="large-9 medium-9 left">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="tituloDnoticia">
              <h1 class="tituloNoticia"><?php the_title(); ?></h1>
              <?php
                if ( has_post_thumbnail() ) {
                  $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                  ?>
                  <img src="<?php echo $large_image_url; ?>" alt="imagendestacada" class="imagenDestacada">
                  <?php
                }
                ?>
          </div>
          <small id="postInfo"><?php setlocale(LC_TIME, "es_ES"); ?><?php echo strftime("%d de %B de %Y"); ?></small>
          <div class="contenidoNoticia">
              <?php the_content(); ?>
              <?php endwhile; else : ?>
              <p><?php _e( 'No se encontró nada.' ); ?></p>

          </div>
          <?php endif; ?>
      </div>
    <div id="menuOp" class="large-3 medium-3 small-12 left">
      <h3>Articulos Relacionados:</h3>
      <div class="itemMain large-12 medium-12 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="img/test.png" alt="">
        </div>
      </div>
      <div class="itemMain large-12 medium-12 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Sefksde</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="img/test.png" alt="">
        </div>
      </div>
      <div class="itemMain large-12 medium-12 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="img/test.png" alt="">
        </div>
      </div>
      <div class="itemMain large-12 medium-12 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="img/test.png" alt="">
        </div>
      </div>
    </div>
    </div>

<?php
get_footer();
?>
