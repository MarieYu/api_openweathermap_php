$(function(){

	$('#forecast').hide();
	$('#prev').hide();

	// Mouse event showing legend for arrow
	$('#arrowPrev').mouseover(function(){
		$('#prev').show();
	});	
	$('#arrowPrev').mouseout(function(){
		$('#prev').hide();
	});

	// Forecast weather shown or hidden on click
	$('#btn_forecast').on('click', function(){
		if($('#arrowPrev').hasClass('fa-arrow-circle-down')){
			$('#prev').html() === 'Voir les prévisions';
			$('#forecast').show();	
			$('#arrowPrev').removeClass('fa-arrow-circle-down').addClass('fa-arrow-circle-up');
			$('#prev').html('Cacher les prévisions');
		}
		else if ($('#arrowPrev').hasClass('fa-arrow-circle-up')){
			$('#prev').html() === 'Cacher les prévisions';
			$('#forecast').hide();
			$('#arrowPrev').removeClass('fa-arrow-circle-up').addClass('fa-arrow-circle-down');
			$('#prev').html('Voir les prévisions');
		}
	});

});