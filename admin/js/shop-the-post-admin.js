(function( $ ) {
	'use strict';

	jQuery(document).ready(function( $ ) {

		// Tabs
		var $rewardstyleTab = $('#rewardstyle-tab');
		var $shopstyleTab = $('#shopstyle-tab');
		var $tracdelightTab = $('#tracdelight-tab');
		var $sliderTab = $('#slider-tab');
		var $rewardstyle = $('#rewardstyle');
		var $shopstyle = $('#shopstyle');
		var $tracdelight = $('#tracdelight');
		var $slider = $('#slider');
		var $navTab = $('.nav-tab');

		$shopstyle.show();

		$rewardstyleTab.click(function(e) {
			e.preventDefault();
			console.log('Have been clickeed!!');
			$rewardstyle.fadeIn();
			$shopstyle.fadeOut();
			$tracdelight.fadeOut();
			$slider.fadeOut();
		});

		$shopstyleTab.click(function(e) {
			e.preventDefault();
			$rewardstyle.fadeOut();
			$shopstyle.fadeIn();
			$tracdelight.fadeOut();
			$slider.fadeOut();
		});

		$tracdelightTab.click(function(e) {
			e.preventDefault();
			$rewardstyle.fadeOut();
			$shopstyle.fadeOut();
			$tracdelight.fadeIn();
			$slider.fadeOut();
		});

		$sliderTab.click(function(e) {
			e.preventDefault();
			$rewardstyle.fadeOut();
			$shopstyle.fadeOut();
			$tracdelight.fadeOut();
			$slider.fadeIn();
		});

		$navTab.click(function() {
			$navTab.removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
		})
	});

})( jQuery );
