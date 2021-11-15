/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */
(function ($) {

	"use strict";

	// Global variables
	var globalMobileWidth = 1240;

	// Use this variable to set up the common and page specific functions. If you
	// rename this variable, you will also need to rename the namespace below.
	var fanatic = {
		// All pages
		'common': {
			finalize: function () {


				$(document).ready(function () {

					makeTransparentNavbar(1, globalMobileWidth);
					toggleMainNavigation();
					toggleSearchMenu();
					customBlockSlider();

					var wow;
					wow = new WOW(
						{
							boxClass:     'wow',      // default
							animateClass: 'animated', // default
							offset:       -150,          // default
							mobile:       false,       // default
							live:         false        // default
						}
					);
					wow.init();

					var bLazy = new Blazy({
						// Options
					});

					if ($(window).width() > globalMobileWidth && $('.background__cover.extra').length) {
						skrollr.init({
							forceHeight: false,
							smoothScrolling: true
						});
					}


				});
				$(window).scroll(function () {
					makeTransparentNavbar(1, globalMobileWidth);
				});

				$(window).resize(function () {

				});

				$(document).ajaxStop(function () {
					if ($('.nf-form-cont select').length) {
						$('.nf-form-cont select').select2(
							{
								width: 'resolve',
								dropdownAutoWidth: true,
								minimumResultsForSearch: -1
							}
						);
					}

					// Setting up select2 events
					$('.nf-form-cont select').on("select2:open", function () {
						$(".select2-search--dropdown .select2-search__field").attr("placeholder", "Type to filter");
					});
					$('.nf-form-cont select').on("select2:opening", function () {
						setTimeout(function () {
							$('.select2-dropdown').css("opacity", "1");
						}, 100);
					});

					$('.nf-form-cont select').on('select2:closing', function (e) {
						$('.select2-dropdown').css("opacity", "0");
					});
					$('.nf-form-cont select').on('select2:close', function (e) {
						$('.select2-dropdown').css("opacity", "");
					});
				});
			}
		},
		// Home
		'home': {
			finalize: function () {

				$(document).ready(function () {

				});
			}
		}

	};//end namespace

	// The routing fires all common scripts, followed by the page specific scripts.
	// Add additional events for more control over timing e.g. a finalize event
	var UTIL = {
		fire: function (func, funcname, args) {
			var fire,
				namespace = fanatic;
			funcname = (funcname === undefined) ? 'init' : funcname;
			fire = func !== '';
			fire = fire && namespace[func];
			fire = fire && typeof namespace[func][funcname] === 'function';

			if (fire) {
				namespace[func][funcname](args);
			}
			console.log(func);
		},
		loadEvents: function () {
			// Fire common init JS
			UTIL.fire('common');

			// Fire page-specific init JS, and then finalize JS
			$.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
				UTIL.fire(classnm);
				UTIL.fire(classnm, 'finalize');
			});

			// Fire common finalize JS
			UTIL.fire('common', 'finalize');
		}
	};//end UTIL namespace

	// Load Events
	$(document).ready(UTIL.loadEvents);


	// Custom functions
// ---------------------------------------------------------------------------------------------------------------------

	function renderACFMap() {
		$('.acf-map').each(function () {
			var map = new_map($(this));
		});
	}

	/* FAQs accordion
	 -----------------------------------------------------------------------------------------
	 */
	function faqsAccordion() {

		function setHeight() {
			$(".response").each(function (index, element) {
				var target = $(element);
				target.removeClass("fixed-height");
				var height = target.innerHeight() - 20;
				target.attr("data-height", height)
					.addClass("fixed-height");
			});

		}

		$("input[name=question]").on("change", function () {
			$("div.response").removeAttr("style");

			var target = $(this).next().next();
			target.height(target.attr("data-height"));
		});

		setHeight();

	}

	/* Select2 Init
	 -----------------------------------------------------------------------------------------
	 */

	if ($('#filter select').length) {
		$('#filter select').select2(
			{
				width: 'resolve',
				dropdownAutoWidth: true,
				minimumResultsForSearch: -1
			}
		);
	}

	// Setting up select2 events
	$('#filter select').on("select2:open", function () {
		$(".select2-search--dropdown .select2-search__field").attr("placeholder", "Type to filter");
	});
	$('#filter select').on("select2:opening", function () {
		setTimeout(function () {
			$('.select2-dropdown').css("opacity", "1");
		}, 100);
	});

	$('#filter select').on('select2:closing', function (e) {
		$('.select2-dropdown').css("opacity", "0");
	});
	$('#filter select').on('select2:close', function (e) {
		$('.select2-dropdown').css("opacity", "");
	});


	/* Change Navigation bar layout when scroll > value
	 -----------------------------------------------------------------------------------------
	 */
	function makeTransparentNavbar(top, maxWidth) {

		var scroll = $(window).scrollTop();

		if ($(window).width() < maxWidth) {
			if (scroll >= 1) {
				$(".l-header").addClass("scrolled");
			} else {
				$(".l-header").removeClass("scrolled");
			}
		} else {
			if (scroll >= top) {
				$(".l-header").addClass("scrolled");
			} else {
				$(".l-header").removeClass("scrolled");
			}
		}

	}

	/* Initialize Homepage slick slider
	 -----------------------------------------------------------------------------------------
	 */

	function homepageSlider() {

		var $banner = $('.slider');

		if ($banner.length) {

			$banner.slick({
				arrows: false,
				dots: false,
				autoplay: true,
				fade: true,
				autoplaySpeed: 3000,
				speed: 900,
				infinite: true,
				cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
				touchThreshold: 100
			});

		}

	}

	/* Initialize Homepage slick slider
	 -----------------------------------------------------------------------------------------
	 */

	function customBlockSlider() {

		var $banner = $('.custom-block-slider');

		if ($banner.length) {

			$banner.slick({
				arrows: false,
				dots: true,
				autoplay: true,
				fade: true,
				autoplaySpeed: 3000,
				speed: 900,
				infinite: true,
				cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
				touchThreshold: 100
			});

		}

	}


	/* Initialize Gallery slick slider
	 -----------------------------------------------------------------------------------------
	 */

	function gallerySlider() {

		var $gallery = $('.gallery--slider');

		if ($gallery.length) {

			$gallery.slick({
				arrows: true,
				dots: true,
				autoplay: true,
				fade: true,
				autoplaySpeed: 3000,
				speed: 800,
				infinite: true,
				cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
				touchThreshold: 100
			});

		}

	}


	/* Toggle main menu
	 -----------------------------------------------------------------------------------------
	 */

	function toggleMainNavigation() {

		var $navTriger = $('#js-brg .ham'),
			$navOverlay = $('.nav__overlay'),
			$navWrapper = $('.nav--wrapper'),
			$header = $('.l-header');

		$navTriger.click(function () {
			$navOverlay.toggleClass('active');
			$header.toggleClass('menu-opened');
		});

		$(".nav__overlay nav a").click(function () {
			$navOverlay.toggleClass('active');
			$navTriger.toggleClass('active');
			$header.toggleClass('menu-opened');
		});

		$navWrapper.click(function (e) {
			if (e.target === this) {
				$navOverlay.toggleClass('active');
				$navTriger.toggleClass('active');
				$header.toggleClass('menu-opened');
			}
		});

	}

	/* Toggle main menu
	 -----------------------------------------------------------------------------------------
	 */

	function toggleSearchMenu() {

		var $navTriger = $('#js-search'),
			$navOverlay = $('.search__overlay'),
			$header = $('.l-header');

		$("#search__box").focusin(function () {
			$('.search-input-wrapper').toggleClass('active');
		});

		$("#search__box").focusout(function () {
			$('.search-input-wrapper').toggleClass('active');
			console.log("Out");
		});

		$navTriger.click(function (e) {
			e.preventDefault();
			closeSearch();
		});

		$navOverlay.click(function (e) {
			if (e.target === this) {
				closeSearch();
			}
		});

		function closeSearch() {
			$navOverlay.toggleClass('active');
			$navTriger.toggleClass('active');
			$header.toggleClass('menu-opened');
		}

	}


	/* hide Nav bar when scroll down
	 -----------------------------------------------------------------------------------------
	 */

	var mainHeader = $('.header--main'),
		headerHeight = mainHeader.height();

	//set scrolling variables
	var scrolling = false,
		previousTop = 0,
		currentTop = 0,
		scrollDelta = 10,
		scrollOffset = 150;

	mainHeader.on('click', '.nav-trigger', function (event) {
		// open primary navigation on mobile
		event.preventDefault();
		mainHeader.toggleClass('nav-open');
	});

	$(window).on('scroll', function () {
		if (!scrolling) {
			scrolling = true;
			(!window.requestAnimationFrame)
				? setTimeout(autoHideHeader, 250)
				: requestAnimationFrame(autoHideHeader);
		}
	});

	$(window).on('resize', function () {
		headerHeight = mainHeader.height();
	});

	function autoHideHeader() {

		if ($(window).width() < globalMobileWidth) {
			var currentTop = $(window).scrollTop();

			checkSimpleNavigation(currentTop);

			previousTop = currentTop;
			scrolling = false;
		}
	}

	function checkSimpleNavigation(currentTop) {
		//there's no secondary nav or secondary nav is below primary nav
		if (previousTop - currentTop > scrollDelta) {
			//if scrolling up...
			mainHeader.removeClass('hide');
		} else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
			//if scrolling down...
			mainHeader.addClass('hide');
		}
	}


	/* Toggle Stud Map
	 -----------------------------------------------------------------------------------------
	 */

	function toggleStudMap() {

		var $showMap = $('.showMap');

		$showMap.click(function (e) {
			e.preventDefault();
			console.log($(this).parentsUntil(".stud"));
			$(this).closest('.stud').find('.stud-map').toggleClass('visible');
			$(this).html() === "Hide Map" ? $(this).html('Show Location') : $(this).html('Hide Map');

		});

	}


	/* Gallery Popups control
	 -----------------------------------------------------------------------------------------
	 */
	function closeModal() {
		$(".mask--gallery").removeClass("active");
		$(".gallery--slider").addClass("hide");
		$('.galleryTitle--fixed').addClass("fade");
		$('.galleryTitle--fixed').removeClass("active");
	}

	function fireGalleryOverlay() {
		$(".close--popup, .mask--gallery").on("click", function (e) {
			e.preventDefault();
			closeModal();
		});

		$(".article__single.gallery").on("click", function (e) {
			e.preventDefault();
			$('.galleryTitle--fixed').removeClass("fade");
			$('.galleryTitle--fixed').addClass("active");
			$(".mask--gallery").addClass("active");
		});
	}

	//---------------------------------------------------------------------|
//  Initialise Google Map                                              |
//---------------------------------------------------------------------|

	function new_map($el) {

		// var
		var $markers = $el.find('.marker');


		// vars
		var args = {
			zoom: 12,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: [{
				"featureType": "poi",
				"stylers": [
					{"visibility": "off"}
				]
			}]
		};


		// create map
		var map = new google.maps.Map($el[0], args);


		// add a markers reference
		map.markers = [];


		// add markers
		$markers.each(function () {

			add_marker($(this), map);

		});


		// center map
		center_map(map);


		// return
		return map;

	}

	function add_marker($marker, map) {

		// var
		var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

		var full = location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '');

		// create marker
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			icon: {
				url: full + '/wp-content/themes/fanatic/assets/img/icons/marker-big.svg',
				scaledSize: new google.maps.Size(50, 63)
			}
		});

		// add to array
		map.markers.push(marker);

		// if marker contains HTML, add it to an infoWindow
		if ($marker.html()) {
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content: $marker.html()
			});

			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function () {

				infowindow.open(map, marker);

			});
		}

	}

	function center_map(map) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each(map.markers, function (i, marker) {

			var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

			bounds.extend(latlng);

		});

		// only 1 marker?
		if (map.markers.length == 1) {
			// set center of map
			map.setCenter(bounds.getCenter());
			map.setZoom(12);
		}
		else {
			// fit to bounds
			map.fitBounds(bounds);
		}

	}


})(jQuery);
