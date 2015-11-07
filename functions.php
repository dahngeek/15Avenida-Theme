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
add_action('wp_head', 'setPageMetas');
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
    if (is_page('enlaces')) {
      wp_enqueue_script("enlaces", get_template_directory_uri()."/js/enlaces.js", array('jquery'), false, false);
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
    ?>
        <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo get_bloginfo('template_url').'/media/imagenes/generales/favicon.ico'; ?>" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo get_bloginfo('template_url');?>/media/imagenes/generales/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <?php
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

function setPageMetas() {
    global $post, $category;
    if (is_home() || is_front_page() || is_search() || is_404()) {
     ?>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="Iglesia, Adventista, 15 Avenida, Guatemala, recursos adventistas, articulos cristianos, argumentos cristianos">
     <?php   
    } else {
        $keywords = wp_get_post_tags( $post->ID, array( 'fields' => 'names' ));
        $arreglo = "";
        if (empty($post->post_excerpt)) {
            $metaDesc = get_post_meta($post->ID, 'description', true);
            //debug($metaDesc);
            if (!empty($metaDesc)) {
                $descrip = $metaDesc;
            } else {
                $descrip = $post->post_title;
            }
        } else {
            $descrip = $post->post_excerpt;
        }
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
        }
        ?>
        <meta name="description" content="<?php echo $descrip; ?>">
        <?php 
            if (!empty($arreglo)) {?>
                <meta name="keywords" content="<?php echo $arreglo; ?>">
                <?php
            }
        ?>
        <meta name="date" content="<?php echo substr($post->post_date, 0 , 10);?>" scheme="YYYY-MM-DD">
        <?php
    }
}

function setFacebookMetas() {
    global $post, $category;

    if ( is_home() || is_front_page() || is_search() || is_404()) {
        ?>
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
            <meta property="og:type" content="blog" />
    <meta name="og:description" content="<?php bloginfo('description'); ?>">
            <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/FB-og-Image<?php echo rand(1,2)?>.jpg" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<meta property="fb:app_id" content="1713920422174957" />
        <?php
    } else if (is_category()) {
        ?>
            <meta property="og:title" content="<?php echo get_cat_name($category->cat_ID); ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:description" content="<?php echo category_description(); ?>" />
            <meta property="og:url" content="<?php echo get_category_link($category->cat_ID); ?>" />
            <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/media/imagenes/generales/FB-og-Image<?php echo rand(1,2)?>.jpg" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<meta property="fb:app_id" content="1713920422174957" />
        <?php
    } else {
        $image_to_show = array();
        if (has_post_thumbnail( $post->ID )) {
            $image_to_show = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        } else {
            $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
            $attachments = get_posts($args);


            foreach($attachments as $attachs) {
                if (wp_attachment_is_image($attachs->ID)) {
                    $image_to_show = wp_get_attachment_image_src( $attachs->ID, 'full' );
                }
            }
        }

        if (count($image_to_show) == 0) {
            $image_to_show = array(get_template_directory_uri()."/media/imagenes/generales/FB-og-Image".rand(1,2).".jpg", 0, 0);
        }

if (empty($post->post_excerpt)) {
            $metaDesc = get_post_meta($post->ID, 'description', true);
            //debug($metaDesc);
            if (!empty($metaDesc)) {
                $descrip = $metaDesc;
            } else {
                $descrip = $post->post_title;
            }
        } else {
            $descrip = $post->post_excerpt;
        }
        ?>
            <meta property="og:title" content="<?php echo $post->post_title; ?>" />
            <meta property="og:type" content="blog" />
            <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
            <meta property="og:image" content="<?php echo $image_to_show[0]; ?>" />
            <meta property="og:description" content="<?php echo $descrip; ?>" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<meta property="fb:app_id" content="1713920422174957" />
        <?php
    }

}

function setIECompatibility() {
    echo '<meta http-equiv="X-UA-Compatible" content="IE=9" />';
}

function setPageTitle() {
    global $post, $category;

    echo '<title>';

    // Add the blog description for the home/front page.
    if (is_home()) {
        echo "Artículos | ";
} else if (is_front_page()) {
    } else if (is_search()) {
        echo "Búsqueda";
    echo ' | ';
    } else if (is_404()) {
        echo "No se encontró nada";
    echo ' | ';
    } else if (is_category()) {
        $category = end(get_the_category());
        echo get_cat_name($category->cat_ID);
    echo ' | ';
    } else {
        echo $post->post_title;
    echo ' | ';
    }
    echo get_bloginfo('name');
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

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
  $args = array(
    'name'          => __( 'Barra Articulos', 'theme_text_domain' ),
    'id'            => 'articles-sidebar',
    'description'   => 'Barra lateral que va junto a los artiulos',
          'class'         => '',
    'before_widget' => '<div id="%1$s" class="itemMain large-12 medium-12 left columns %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>' );
    register_sidebar( $args );
    $arges = array(
        'name'          => __( 'Barra Páginas', 'theme_text_domain' ),
        'id'            => 'pages-sidebar',
        'description'   => 'Barra lateral que va junto a las paginas.',
            'class'         => '',
        'before_widget' => '<div id="%1$s" class="itemMain large-12 medium-12 left columns %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>' );
      register_sidebar( $arges );
}

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

/* REGISTAR MENUS */

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primario', 'Menu principal' );
}

add_action( 'after_setup_theme', 'register_my2_menu' );
function register_my2_menu() {
  register_nav_menu( 'inicial', 'Menu Contenidos' );
}
/* Necesito el debug */
ini_set("display_errors", 1); 

/* Registrar thumbnails del sitio */
add_image_size( 'side-size', 300, 140, array( 'center', 'center' ) );
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
 
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'side-size' => __( 'Imagen de lista de recomendados' ),
    ) );
}
?>