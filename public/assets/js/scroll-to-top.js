$(document).ready(function($){
	var offset = 300;
	var duration = 500;
	var scroll_top_duration = 700;

	$(window).scroll(function(){
		if($(this).scrollTop() > offset ) {
			$('.cd-top').fadeIn(duration);
		} else {
			$('.cd-top').fadeOut(duration);
		}
	});

	$('.cd-top').click(function(event){
		event.preventDefault();
		$('html, body').animate({scrollTop: 0}, scroll_top_duration);
		return false;
	});

});
