<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
//ini_set("display_errors", 1); 

	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
?>
</head>

<?php
global $wp_query;
       $post_id = $wp_query->get_queried_object_id();
    $locations = get_registered_nav_menus();
    $menus = wp_get_nav_menus();
    $menu_locations = get_nav_menu_locations();
$location_id = 'primario';
if (isset($menu_locations[ $location_id ])) {
foreach ($menus as $menu) {
  // If the ID of this menu is the ID associated with the location we're searching for
  if ($menu->term_id == $menu_locations[ $location_id ]) {
    // This is the correct menu
    // Get the items for this menu
    $menu_items = (array)wp_get_nav_menu_items($menu);
    $menuArr = array();
    $i = 0;
    foreach ($menu_items as $key => $menu_item) {
      //echo "<pre>";
      //var_dump($menu_item);
      //echo "</pre>";
      if ($menu_item->menu_item_parent == 0) {
        $i =  $menu_item->ID;
        $menuArr[$i]["titulo"] = $menu_item->title;
        $menuArr[$i]["id"] = $menu_item->object_id;
        $menuArr[$i]["url"] = $menu_item->url;
        $menuArr[$i]["icononame"] = $menu_item->attr_title;
      } else {
        $padre = $menu_item->menu_item_parent;
        $i =  $menu_item->ID;
        $menuArr[$padre]["h"][$i]["titulo"] = $menu_item->title;
        $menuArr[$padre]["h"][$i]["url"] = $menu_item->url;
      }
    }
    //echo "<pre>";
    //var_dump($menuArr);
    //echo "</pre>";
  }
}
}
?>


<body <?php body_class(); ?>>
	<!-- Inicia Cabecera -->
	<div id="cabecera">
      <div class="row">
        <div class="small-12">
            <p class="centrado">
              <a href=" <?php echo get_bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/img/logo_15av.png" alt=""></a>
            </p>
        </div>
        <div class="menu large-12 small-12">
          <ul class="small-12">
            <?php 
              $ii = 0;
              foreach ($menuArr as $key => $itemmenu) {
            ?>
                <li class="medium-2 columns  <?php if($ii > 1 ){echo "right";} else {echo "left";} if($itemmenu["id"] == $post_id) {echo " activo";}?>"><a href="<?php echo $itemmenu['url']?>"><?php echo $itemmenu['titulo']?></a></li> 
            <?php 
              $ii++;
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
<!-- Termina Cabecera -->
