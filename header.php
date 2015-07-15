<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
	<!-- Inicia Cabecera -->
	<div id="cabecera">
      <div class="row">
        <div class="small-12">
            <p class="centrado">
              <a href=""><img src="<?php bloginfo('template_url');?>/img/logo_15av.png" alt=""></a>
            </p>
        </div>
        <div class="menu large-12 small-12">
          <ul class="small-12">
            <li class="medium-2 columns left">Acerca de</li>
            <li class="medium-2 columns left">Blog</li>
            <li class="medium-2 columns right">Contacto</li>
            <li class="medium-2 columns right">Enlaces</li>
          </ul>
        </div>
      </div>
    </div>
<!-- Termina Cabecera -->
