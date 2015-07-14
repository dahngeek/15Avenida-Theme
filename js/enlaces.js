jQuery(document).ready(function($) {

	$('.categoriaEnlace').click(function(event){ 
			event.preventDefault();
			$(".activo").removeClass("activo");
			$(this).parent().addClass("activo");
			var variable = $(".categoriaEnlace").index(this);
			if (variable == 0) {
				$(".contenedorEnlace").fadeIn();
			} else {
				variable = variable-1;
				
			}
			console.log("Es el ID: "+variable);
		});





});