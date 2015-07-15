<?php

/*QUITAMOS LA BARRA DE ADMINISTRACION DEL FRONTEND*/
add_filter( 'show_admin_bar', '__return_false' );

/*SOPORTES DEL TEMA*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 180, true ); // Normal post thumbnails
add_image_size( 'single-post-thumbnail', 300, 180 ); // Permalink thumbnail size


/*ACTIONS*/
add_action('wp_head', 'setIECompatibility', 1);
add_action('wp_head', 'setUpdateMode');
add_action('wp_head', 'setPageTitle');
add_action('wp_head', 'blogFavicon');
/*INIT SCRIPTS*/
add_action('get_header', 'get_the_scripts');
/*INIT STYLES*/
add_action('get_header', 'get_the_styles');
add_action('wp_head', 'setFacebookMetas');
add_action("login_head", "myLoginHead");
add_filter('login_headerurl', 'cambiarURLLogin');
add_filter('login_headertitle', 'cambiarTituloLogin');

function get_the_styles() {
    global $post;

    wp_enqueue_style('resetStyle', get_bloginfo( 'stylesheet_directory' ).'/css/reset.css');
    wp_enqueue_style('foundation', get_bloginfo( 'stylesheet_directory' ).'/css/foundation.css');
    wp_enqueue_style('themeStyle', get_bloginfo( 'stylesheet_url' ), array("resetStyle"));



    //SPECIFIC STYLES
    if (isset($post->ID)) {
        switch ($post->ID) {

        }
    }
}

function get_the_scripts() {
    global $post;

    //GENERAL SCRIPTS
    wp_enqueue_script("cssBrowserSelector", get_bloginfo( 'stylesheet_directory' ).'/js/libs/css_browser_selector.js', array(), false, true);
    wp_enqueue_script("general", get_template_directory_uri()."/js/functions/general.js", array("jquery"), false, true);
    wp_enqueue_script("Foundation", get_template_directory_uri()."/js/foundation.min.js", array("jquery"), false, true);
    wp_enqueue_script("geometryMaps", "http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7", array("jquery"), false, true);
    wp_enqueue_script("jCycle", get_template_directory_uri()."/js/jquery.cycle.all.js", array("jquery"), false, true);
    wp_enqueue_script("mapPlace", get_template_directory_uri()."/js/maplace.min.js", array("jquery"), false, true);
    wp_enqueue_script("modernizr", get_template_directory_uri()."/js/vendor/modernizr.js", array(), false, false);
    wp_enqueue_script("main", get_template_directory_uri()."/js/main.js", array(), false, true);

    //SPECIFIC SCRIPTS
    if (isset($post->ID)) {
        switch ($post->ID) {

        }
    }
}

//cambiamos la imagen del login
function myLoginHead() {
	echo "
	<style>
            body.login #login h1 a {
                    background: url('".get_bloginfo('template_url')."/media/imagenes/generales/login_logo.png') no-repeat scroll center top transparent;
                    width: 390px;
                    height: 227px;
                    margin-left: -35px;
                    background-size: 390px 227px;
            }
	</style>
	";
}

//Cambiamos el link de el logo del login
function cambiarURLLogin(){
    return ('http://dahngeek.com/');
}

//Cambiamos el titulo del link
function cambiarTituloLogin(){
    return ('IASD 15 Avenida');
}

//set favicon
function blogFavicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_url').'/media/imagenes/generales/favicon.ico" />';
}

function setUpdateMode() {
    global $user_email;

    $update = false;

    if ($update) {

        if ((!is_user_logged_in() && $user_email != "me@dahngeek.com") && !is_home() && !is_front_page()) {
            wp_redirect(home_url());
            exit;
        }
    }
}

function setFacebookMetas() {
    global $post, $category;

    if ( is_home() || is_front_page() || is_search() || is_404()) {
        ?>
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_bloginfo('url '); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/share_image.png" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    } else if (is_category()) {
        ?>
            <meta property="og:title" content="<?php echo get_cat_name($category->cat_ID); ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_category_link($category->cat_ID); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/share_image.png" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    } else {
        $image_to_show = array();
        if (has_post_thumbnail( $post->ID )) {
            $image_to_show = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        } else {
            $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
            $attachments = get_posts($args);


            foreach($attachments as $attachs) {
                if (wp_attachment_is_image($attachs->ID)) {
                    $image_to_show = wp_get_attachment_image_src( $attachs->ID, 'medium' );
                }
            }
        }

        if (count($image_to_show) == 0) {
            $image_to_show = array(get_template_directory_uri()."/media/imagenes/generales/logo.jpg", 0, 0);
        }
        ?>
            <meta property="og:title" content="<?php echo $post->post_title; ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
            <meta property="og:image" content="<?php echo $image_to_show[0]; ?>" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <?php
    }

}

function setIECompatibility() {
    echo '<meta http-equiv="X-UA-Compatible" content="IE=9" />';
}

function setPageTitle() {
    global $post, $category;

    echo '<title>';

    echo get_bloginfo('name').' | ';

    // Add the blog description for the home/front page.
    if ( is_home() || is_front_page()) {
        echo "Inicio";
    } else if (is_search()) {
        echo "Búsqueda";
    } else if (is_404()) {
        echo "No se encontró nada";
    } else if (is_category()) {
        $category = end(get_the_category());
        echo get_cat_name($category->cat_ID);
    } else {
        echo $post->post_title;
    }

    echo '</title>';
}

/*FUNCIONES DE TEMA*/


/*FUNCIONES GENERALES*/

//$s -> texto
//$l -> numero de caracteres
function truncate($s, $l, $e = '...', $isHTML = false){
    $i = 0;
    $tags = array();
    if($isHTML){
            preg_match_all('/<[^>]+>([^<]*)/', $s, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            foreach($m as $o){
                    if($o[0][1] - $i >= $l)
                            break;
                    $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
                    if($t[0] != '/')
                            $tags[] = $t;
                    elseif(end($tags) == substr($t, 1))
                            array_pop($tags);
                    $i += $o[1][1] - $o[0][1];
            }
    }
    return substr($s, 0, $l = min(strlen($s),  $l + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '') . (strlen($s) > $l ? $e : '');
}

function debug($variable, $mensaje="", $die=false) {
    if (!empty($mensaje)) {
        echo $mensaje;
    }
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    if ($die) {
        die();
    }
}

?>
