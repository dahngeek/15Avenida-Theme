jQuery(document).ready(function($) {

	$('.categoriaEnlace').click(function(event){
			event.preventDefault();
			$(".activo").removeClass("activo");
			$(this).parent().addClass("activo");
			var variable = $(".categoriaEnlace").index(this);
			if (variable == 0) {
				$(".contenedorEnlaces").fadeIn();
			} else {
				$(".contenedorEnlaces").fadeOut();
				$(".contenedorEnlaces:nth-child("+(variable+1)+")").fadeIn();
			}
			console.log("Es el ID: "+variable);
		});





});
