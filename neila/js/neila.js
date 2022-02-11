jQuery(function($) {
	"use strict";

	// hide #back-top first
	$("#back-top").hide();

	// fade in #back-top

	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	$('#back-top a').on("click", function(){
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	// slider
	$('.mz-slider').slick({

		dots: true,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear',

		autoplay: true,
		autoplaySpeed: 7000,
		arrows: true,
		prevArrow: '<a href="#" class="prev-arrow"><i class="fa fa-angle-left"></i></a>',
		nextArrow: '<a href="#" class="next-arrow"><i class="fa fa-angle-right"></i></a>',
		dots: false,
		infinite: true,

	});

});