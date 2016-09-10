$(document).ready(function() {

	$('#menu li img').mouseover(function(e){
		$('#key').animate({width: 'show'}, 'slow') ;
	}) ;

	$('#menu li img').mouseout(function(e){
		$('#key').hide() ;
	}) ;
}) ;
