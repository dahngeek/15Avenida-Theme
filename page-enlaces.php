<?php
get_header();
?>
<div id="slider">
  <h1 class="titPagina">Enlaces</h1>
</div>
<!-- termina slider -->
<div id="contenidoEnlaces" class="row">
 <div id="contenidoseccionEnlaces">
  <div id="lateralEnlaces" class="large-3 medium-3 left">
    <ul>
      <?
        global $wpdb;
	//
  $linksArr = array();
	$sqllnk  = "SELECT term_id FROM wp_term_taxonomy WHERE taxonomy='link_category'";
	$reslnks = $wpdb->get_results($sqllnk);
  foreach ($reslnks as $key => $value) {
    $sqllnk  = "SELECT name, slug FROM wp_terms WHERE term_id='$value->term_id'";
  	$reslnks = $wpdb->get_results($sqllnk);
    //Push al arreglo
    //debug($reslnks);
    $linksArr[$key]["id"] = $value->term_id;
    $linksArr[$key]["nombre"] = $reslnks[0]->name;
    $linksArr[$key]["slug"] = $reslnks[0]->slug;
    $linksArr[$key]["links"] = array();
  }
  foreach ($linksArr as $llave => $value) {
    $sqllnk  = "SELECT object_id FROM wp_term_relationships WHERE term_taxonomy_id='".$value['id']."'";
  	$reslnks = $wpdb->get_results($sqllnk);
    foreach ($reslnks as $key => $value) {
      $sqllnk  = "SELECT link_name, link_url, link_description FROM wp_links WHERE link_id='".$value->object_id."'";
    	$infolink = $wpdb->get_results($sqllnk);
      $linksArr[$llave]["links"][$key]["nombre"] = $infolink[0]->link_name;
      $linksArr[$llave]["links"][$key]["url"] = $infolink[0]->link_url;
      $linksArr[$llave]["links"][$key]["descripcion"] = $infolink[0]->link_description;
      //debug($infolink);
    }
  }
  //debug($linksArr);
 ?>
      <li class="activo"><a href="#" class="categoriaEnlace">Todos</a></li>
      <?php
      foreach ($linksArr as $key => $value) {
        ?>
        <li><a href="#" class="categoriaEnlace"><?php echo $value["nombre"]; ?></a></li>
        <?php
      }
      ?>
    </ul>
  </div>
  <?php
  foreach ($linksArr as $key => $value) {
    ?>
    <div id="contenedorEnlaces<?=$key;?>" style="display:block;" class="contenedorEnlaces large-9 medium-9 right">
        <?php
        foreach ($value["links"] as $key => $value) {
          ?>
          <div class="enlace">
            <a href="<?php echo $value["url"];?>"><p class="titulo"><?php echo $value["nombre"];?></p></a>
            <p class="descrip"><?php echo $value["descripcion"];?></p>
            <div class="social">
                Compartir:
                <?php
                  $cantidadLetras = strlen($value["url"]);
                  $twittershare = substr($value["nombre"]." - ".$value["descripcion"], 0, 127-$cantidadLetras)."... [".$value['url']."]";
                  $facebookshare = $value["nombre"].' - '.$value["descripcion"].' ['.$value["url"].']';
                ?>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $value['url'];?>"><img src="<?php bloginfo('template_url');?>/img/facebook.png" width="20" target="_blank"></a>
                <a href="https://twitter.com/home?status=<?php echo urlencode($twittershare); ?>"><img src="<?php bloginfo('template_url');?>/img/twitter.png" width="20" target="_blank"></a>
            </div>
          </div>
          <?php
        }
        ?>
    </div>
    <?php
  }
  ?>
 </div>
 <!--Enlaces relacionados-->
<div id="menuOp" class="large-12 medium-12 small-12 left">
  <?php
$popularpost = new WP_Query( array( 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
if ($popularpost->have_posts()) {
?>
<h3>También te puede Interesar:</h3>
<?php
while ( $popularpost->have_posts() ) : $popularpost->the_post();
?>
<div class="itemMain large-3 medium-3 left columns">
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

</div>
</div>
<?php
get_footer();
?>
