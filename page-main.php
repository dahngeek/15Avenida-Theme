<?php
get_header();


/* Get all sticky posts */
$sticky = get_option( 'sticky_posts' );

/* Sort the stickies with the newest ones at the top */
rsort( $sticky );

/* Get the 5 newest stickies (change 5 for a different number) */
$sticky = array_slice( $sticky, 0, 5 );
//var_dump($sticky);
/* Query sticky posts */
$the_query = new WP_Query( array( 'post__in' => $sticky ) );
// The Loop
if ( $the_query->have_posts() ) {
  ?>
  <div id="slider">
    <div class="cycle">
  <?php
  while ( $the_query->have_posts() ) {
    $the_query->the_post();
    ?>
      <div class="slide">
                <img src="<?php echo get_post_meta(get_the_ID(), 'slider', true); ?>" alt="<?php echo get_the_title();?>">
                <div class="descrip"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></div>
              </div>
    <?php
    
  }
  ?>
</div>
      <div id="navSl"></div>
    </div>
  <?php
  
} else {
  ?>
<div id="slider">
      <div class="cycle">
        <div class="slide">
          <img src="<?php bloginfo('template_url');?>/img/slider/image1.png" alt="">
          <div class="descrip"><a href="">Titulo del Anuncio</a></div>
        </div>
        <div class="slide">
          <img src="<?php bloginfo('template_url');?>/img/slider/image2.png" alt="">
          <div class="descrip"><a href="">Titulo de la Entrada</a></div>
        </div>
        <div class="slide">
          <img src="<?php bloginfo('template_url');?>/img/slider/image3.png" alt="">
          <div class="descrip"><a href="">Titulo de la Página</a></div>
        </div>
        <div class="slide">
          <img src="<?php bloginfo('template_url');?>/img/slider/image4.png" alt="">
          <div class="descrip"><a href="">Titulo de la publicación</a></div>
        </div>
      </div>
      <div id="navSl"></div>
    </div>
  <?php
}
/* Restore original Post Data */
wp_reset_postdata();
?>
<!-- Inicia slider -->
    <!-- termina slider -->
  <?php
global $wp_query;
       $post_id = $wp_query->get_queried_object_id();
    $locations = get_registered_nav_menus();
    $menus = wp_get_nav_menus();
    $menu_locations = get_nav_menu_locations();
$location_id = 'primario';
if (isset($menu_locations[ $location_id ])) {
foreach ($menus as $menu) {
  // ====================================================
  //              MENU INICIO 
  // ====================================================
  $location_menu = 'inicial';
  if ($menu->term_id == $menu_locations[ $location_menu ]) {
    // This is the correct menu
    // Get the items for this menu
    $menu_items = (array)wp_get_nav_menu_items($menu);
    $arrInicio = array();
    $i = 0;
    foreach ($menu_items as $key => $menu_item) {
      //echo "<pre>";
      //var_dump($menu_item);
      //echo "</pre>";
      if ($menu_item->menu_item_parent == 0) {
        $i =  $menu_item->ID;
        $arrInicio[$i]["titulo"] = $menu_item->title;
        $arrInicio[$i]["id"] = $menu_item->object_id;
        $arrInicio[$i]["url"] = $menu_item->url;
        $arrInicio[$i]["img_option"] = $menu_item->attr_title;
      } else {
        $padre = $menu_item->menu_item_parent;
        $i =  $menu_item->ID;
        $arrInicio[$padre]["h"][$i]["titulo"] = $menu_item->title;
        $arrInicio[$padre]["h"][$i]["url"] = $menu_item->url;
      }
    }
    //echo "<pre>";
    //var_dump($arrInicio);
    //echo "</pre>";
  }
}
}
?>
    <div id="menuOp">
      <?php 
        //Menu inicio, usamos arreglo definido en el header.
        // Arreglo: arrInicio
        // La imagen la cargamos del attr_title y en el arreglo se llama "img_option"
        // En este caso, ignoramos los submenus
      $i = 0; // Contador
      //var_dump($arrInicio);
      if (!empty($arrInicio)){
        //Si no está vacio el arreglo
      foreach ($arrInicio as $key => $item) {
        if ($i == 2) {
          //Mostrar widget de mapa ubicacion
          ?>
            <div class="direccionMain large-6 medium-6 left columns">
              <div class="overtitle"><a href="/contacto">Encuéntranos</a></div>
              <div class="overlay"></div>
              <div id="gmap"></div>
            </div>
          <?php
        }
        $i++;
        ?>
          <div class="itemMain large-3 medium-3 left columns">
            <div class="containergrid">
              <div class="overlay">
                <a href="<?php echo $item['url']?>">
                  <p><?php echo $item['titulo']?></p>
                </a>
              </div>
              <?php 
              if (empty($item['img_option'])) {
                if (has_post_thumbnail($item['id'])) {
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($item['id']), 'medium' );
                    $link = $thumb['0'];
                } else {
                  $link = get_bloginfo('template_url')."/img/test.png";
                }
              } else {
                $link = $item['img_option'];
              }
              ?>
              <img class="imagenSeleccion" src="<?php echo $link; ?>" alt="">
            </div>
          </div>
        <?php
      }
    } else {
      ?>
<div class="itemMain large-3 medium-3 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="<?php bloginfo('template_url');?>/img/test.png" alt="">
        </div>
      </div>
      <div class="itemMain large-3 medium-3 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Sefksde</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="<?php bloginfo('template_url');?>/img/test.png" alt="">
        </div>
      </div>
      <div class="direccionMain large-6 medium-6 left columns">
        <div id="gmap"></div>
      </div>
      <div class="itemMain large-3 medium-3 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="<?php bloginfo('template_url');?>/img/test.png" alt="">
        </div>
      </div>
      <div class="itemMain large-3 medium-3 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="<?php bloginfo('template_url');?>/img/test.png" alt="">
        </div>
      </div>
      <div class="itemMain large-3 medium-3 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada de comida comida comida</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="<?php bloginfo('template_url');?>/img/test.png" alt="">
        </div>
      </div>
      <div class="itemMain large-3 medium-3 left columns">
        <div class="containergrid">
          <div class="overlay">
            <a href="#">
              <p>Titulo de la entrada</p>
            </a>
          </div>
          <img class="imagenSeleccion" src="<?php bloginfo('template_url');?>/img/test.png" alt="">
        </div>
      </div>
<?php }?>
    </div>

<?php
get_footer();
?>
