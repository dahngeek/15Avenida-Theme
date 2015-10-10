    <div id="piePagina">
  		<p class="texto">Derechos de Autor © 2014 - 15 Avenida 4-12 Zona 1, Guatemala, Guatemala | Adventistas15Avenida.org </p>  
	</div><!-- #footer -->
    
<?php      
	wp_footer();
?>
<script>

      jQuery(document).foundation();
    </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68433172-1', 'auto');
  ga('send', 'pageview');
<?php 
	if(is_single()) {
		echo "var dimensionValue = 'Tema';
		ga('set', 'dimension1', dimensionValue);";
	}
?>

</script>
</body>
</html>