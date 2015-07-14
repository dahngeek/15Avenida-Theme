var activeSlide;
jQuery(document).ready(function($) {
	var cantidadItems = $('.slide').length;
	$('.cycle').cycle({
		fx:     'scrollHorz',
		containerResize: 1,
    	width: 'fit',
    	pause:   1,
	    pager:  '#navSl',
	    before: function(curr, next, obj) {
	    	porcentaje = (obj.currSlide - 1)*(1000 / cantidadItems);
        	$('.cycle').animate({"background-position-x":+porcentaje+"%"},900);
	    },
    	after: function(curr, next, obj) {
        	activeSlide = obj.currSlide;
    	}
	});

	$(window).resize(function(){
		$('.cycle').cycle('destroy');
		$('.cycle').each(function(){
	        newWidth = $(this).parent('div').width();
	        $(this).width(newWidth);
	        $(this).height('auto');
	        $(this).children('div').width(newWidth);
	        $(this).children('div').height('auto');
    	});
		$('.cycle').cycle({
			fx:     'scrollHorz',
			containerResize: 1,
	    width: 'fit',
	    pause:   1,
	    pager:  '#navSl',
	    before: function(curr, next, obj) {
	    	porcentaje = (obj.currSlide - 1)*(1000 / cantidadItems);
        	$('.cycle').animate({"background-position-x":+porcentaje+"%"},900);
	    },
	    after: function(curr, next, obj) {
	        activeSlide = obj.currSlide;
	    }
		});
	});

	new Maplace({
	locations: [{
		lat: 14.642858, 
		lon: -90.5035002,
		zoom: 16
	}]
}).Load(); 
})