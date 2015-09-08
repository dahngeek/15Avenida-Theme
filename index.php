<div id="slider">
      <h1 class="titPagina"><?php get_the_title(); ?></h1>
    </div>
    <!-- termina slider -->
<div id="blogPosts">
  <?php
  $estilos = [
    [ "row" => "estilo1"
      "classes" => ["large-6 small-h item-1 right","large-6 large-h iten-3 left","large-6 small-h item-2 right"],
      "max" => 3
    ],
    [ "row" => "estilo2"
      "classes" => ["large-3 small-h item-4 left","large-3 small-h item-3 left","large-3 small-h item-2 left","large-3 small-h item-1 left"],
      "max" => 4
    ],
    [ "row" => "estilo3"
      "classes" => ["large-6 large-h item-2 left", "large-6 large-h item-2 left"],
      "max" => 2
    ],
    [ "row" => "estilo4"
      "classes" => ["large-3 small-h item-2 right","large-3 small-h item-1 right","large-6 large-h item-3 left","large-3 small-h item-4 right","large-3 small-h item-2 right"],
      "max" => 2
    ]
  ];
 if ( have_posts() ) {
  $num = 0;
  $i = 0;
  echo '<div class="row estilo1">';
 	while ( have_posts() ) {
 		the_post();
    ?>
    <div class="noticia small-12 <?php echo $estilos[$num]["classes"][$i]; ?>">
    <?php if (has_post_thumbnail()) {
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
          $url = $thumb['0'];
      } else {
        $url = 'http://www.hizook.com/files/users/3/robot_assembly_3.jpg';
        } 
        ?>
      <div class="img" style="background:url('<?php echo $url; ?>');background-size:cover;background-position: 0% 50%;"></div>
      <div class="info">
      <?php
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
          $catt = esc_html( $categories[0]->name );  
          $cattlink = esc_url( get_category_link( $categories[0]->term_id ) );
        } else {
          $catt = "Articulos";
          $cattlink = "#";
        }
      ?>
        <div class="cat"><a href="<?php echo $cattlink; ?>"><?php echo $catt; ?></a></div>
        <div class="fecha"><i><?php echo get_the_date("j / n / Y"); ?></i></div>
      </div>
      <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
    </div>
    <?php
 		if ($i+1 >= $estilos[$num]["max"]) {
      $num = $num +1;
      echo '  </div>';
      if ($num > 3) {
        $num = 0;
      }
      echo '<div class="row '.$estilos[$num]["row"].'">';
      $i = 0;
    } else {
      $i++;
    }

 	} // end while
  if ($i+1 < $estilos[$num]["max"]) {
    echo '</div>';
  }
 } // end if
 ?>
</div>
