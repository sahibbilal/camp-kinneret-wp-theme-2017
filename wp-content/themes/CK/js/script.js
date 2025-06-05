(function($) {

var Project = {
	init: function () {
		$('html').removeClass('no-js');
		if (navigator.userAgent.match(/Trident\/7\./)) { // if IE
			$('body').on("mousewheel", function () {
				// remove default behavior
				event.preventDefault();

				//scroll without smoothing
				var wheelDelta = event.wheelDelta;
				var currentScrollPosition = window.pageYOffset;
				window.scrollTo(0, currentScrollPosition - wheelDelta);
			});
		}
	},
	formOpen: function () {
		var $trigger = $('.form-trigger');
		var $form = $('.container--sem-form');
		$trigger.on('click', function () {
			$(this).toggleClass('active');
			$form.toggleClass('active');
		});
	},
	tablesWrapper: function () {
		$('table.tablepress').each(function () {
			if (!$(this).parent().hasClass('dataTables_wrapper')) {
				$(this).wrap('<div class="dataTables_wrapper"> </div>');
			}
		})

	},
	nextSteps: function () {
		$('.ctas-next-steps, .next-steps__single').on('click', function () {
			$('.next-steps-overlay').toggleClass('visible');
			$('body').toggleClass('noscroll');
			$('.ctas-next-steps').toggleClass('opened');
		});
	},
	wrapIframe: function () {
		if ($('iframe').length) {
			$('iframe[src*="youtube"],iframe[src*="vimeo"]').wrap('<div class="video-container"></div>');
			$('.video-container').unwrap();
		}
	},
	slickSliders: function () {
		$('.page-slider').slick({
			// rtl: true,
			speed: 500,
			prevArrow: "<span class='slider-button slider-button--left control-c prev slick-prev'></span>",
			nextArrow: "<span class='slider-button slider-button--right control-c next slick-next'></span>",
			responsive: [{
				breakpoint: 768,
				settings: {
					arrows: false,
					dots: true
				}
			}, ]
		});

		$('.two-columns-slider').slick({
			// rtl: true,
			prevArrow: "<span class='slider-button slider-button--left control-c prev slick-prev'></span>",
			nextArrow: "<span class='slider-button slider-button--right control-c next slick-next'></span>",
			responsive: [{
				breakpoint: 768,
				settings: {
					arrows: false,
					dots: true
				}
			}, ]
		});
		$('.page-slider__caption-trigger').hover(function () {
			$(this).siblings('.page-slider__caption-content').addClass('visible');
		}, function () {
			$(this).siblings('.page-slider__caption-content').removeClass('visible');
		});
	},
	mobileMenu: function () {
		$('.mobile-menu a').on('click', function (e) {
			$(this).toggleClass('active');
			$submenu = $(this).siblings('.sub-menu');
			if ($submenu.length > 0) {
				e.preventDefault();
				$submenu.toggleClass('active');
			}
		});

		$('.mobile-menu-trigger').on('click', function () {
			$('.mobile-menu-wrapper').addClass('visible');
			$('#page').addClass('mobilemenu');
			$('body').addClass('noscroll')
		});
		$('.mobile-menu-closer').on('click', function () {
			$('.mobile-menu-wrapper').removeClass('visible');
			$('#page').removeClass('mobilemenu');
			$('body').removeClass('noscroll')
		});
	},
	heroMobileMenu: function () {
		$('.second-navigation__trigger').on('click', function () {
			$('.second-navigation__list').toggleClass('visible');
		});
	},
	tabsMobileSlider: function () {
		$('.tabs').on('click', '.tab-arrow', function () {
			var $firstClass = $(this).attr('class').split(" ")[0],
				$tabHead = $(this).parent(),
				$activeTabHeadId = $tabHead.find('.act').data('tab'),
				$container = $('.tabs');

			if ($firstClass == 'tab-next' && $tabHead.next('li').length) {

				var $tabContentToShow = $tabHead.next('li').find('.act').data('tab');

				$container.find('div#' + $tabContentToShow).addClass('active');
				$container.find('div#' + $activeTabHeadId).removeClass('active');

				$tabHead.removeClass('active');
				$tabHead.next('li').addClass('active');

			} else if ($firstClass == 'tab-prev' && $tabHead.prev('li').length) {

				var $tabContentToShow = $tabHead.prev('li').find('.act').data('tab');

				$container.find('div#' + $tabContentToShow).addClass('active');
				$container.find('div#' + $activeTabHeadId).removeClass('active');

				$tabHead.removeClass('active');
				$tabHead.prev('li').addClass('active');

			}

		});
	},
	revealImages: function () {

		$('img:not(.countdown-social-fb-icon)').each(function () {
			$this = $(this);

			if (!$this.parent().hasClass('slick-slide')) {

				if ($this.hasClass('aligncenter') && !$this.parent().hasClass('out-of-container')) {
					$this.removeClass('aligncenter');
					$this.wrap('<div class="image-reveal aligncenter"></div>');

				} else if ($this.parent().hasClass('out-of-container')) {
					$this.parent().addClass('image-reveal');

				} else if ($this.hasClass('alignleft')) {
					$this.removeClass('alignleft');
					$this.wrap('<div class="image-reveal alignleft"></div>');

				} else if ($this.hasClass('alignright')) {
					$this.removeClass('alignright');
					$this.wrap('<div class="image-reveal alignright"></div>');

				} else {

					$this.wrap('<div class="image-reveal"></div>');

				}
			}
		});

		function reveal() {
			$('.image-reveal').each(function () {

				$this = $(this);

				var topObject = $this.offset().top;
				var bottom_of_window = $(window).scrollTop() + $(window).height() - 250;

				if (bottom_of_window > topObject) {

					$this.addClass('revealed');

				}
			})
		}
		reveal();

		$(window).scroll(function () {

			reveal();

		});
	},
	justScroll: function () {
		$('.scroll-down').on('click', function () {
			$('html, body').animate({
				scrollTop: $('.scroll-down').offset().top
			}, 1000);
			return false;
		})
	},
	stopScroll: function () {
		var $button = $('.blogpost-back-button');
		var $blogLink = $('.blogpost-link');

		if ($blogLink.length > 0) {

			var $buttonPos = $button.position().top + parseInt($button.css('margin-top')) + $button.height();
			var fired = false;

			$blogLink.scrollToFixed({
				marginTop: 350,
				limit: $buttonPos
			});
		}
	},
	blogNavigation: function () {
		$('.blog-navigation__trigger').on('click', function () {
			$(this).find('span').toggleClass('active');
			$('.blog-navigation').toggleClass('active');
		});
		$('.blog-navigation__authors, .blog-navigation__categories, .blog-navigation__tags').on('click', function () {
			$(this).toggleClass('active');
		});
		$('.page-numbers.max-num-pages').insertAfter('div.nav-links .page-numbers.current');
	},
	openToggler: function () {
		$('.open-trigger').on('click', function () {
			$(this).toggleClass('open');
		})
	},
	searchFormText: function () {
		$('.search-in-place-box-container input[name="s"]').each(function() {
			// $(this).attr('placeholder', 'Search this Page');
		})
	},
	searchFormTextFaq: function () {
		$('.page-id-6605 .search-in-place-box-container input[name="s"]').each(function() {
			$(this).attr('placeholder', 'Search Our FAQs');
		})
	},
	instructionalText: function () {
		var text = '<p id="instructional_text">There is lots of great information in our FAQs and hope that you will read through each of them. If you are looking for a specific answer, feel free to use the search box below. </p>';
		let searchBoxContainer = document.querySelector(".search-in-place-box-container");
		if (searchBoxContainer) {
			searchBoxContainer.insertAdjacentHTML('afterbegin', text);
		}
	}
}


var Alert = {
	init: function () {
		this.cacheDom();
		this.eventTrigger();
	},
	cacheDom: function () {
		this.$page = $('#page');
		this.$alert = $('.alert-message');
		this.$trigger = this.$alert.find('.alert-message__close');
	},
	eventTrigger: function () {
		$(document).on('ready', this.checkStorage);
		this.$trigger.on('click', this.addVariable);
	},
	showAlert: function () {
		$(window).on('load', function () {
			Alert.$alert.addClass('bounceInDown');
			Alert.$alert.removeClass('bounceOutUp');
			Alert.$alert.removeClass('inactive');
		});
	},
	hideAlert: function () {
		this.$alert.addClass('bounceOutUp');
		this.$alert.removeClass('bounceInDown');
		setTimeout(function () {
			Alert.pageUp()
		}, 2000);
	},

	addVariable: function (e) {
		e.preventDefault();
		Alert.setCookie('alert-hidden', 'yes', 9999);
		Alert.hideAlert();
	},

	checkStorage: function () {
		if (!Alert.getCookie('alert-hidden')) {
			Alert.showAlert();
		}
	},
	pageUp: function () {
		this.$page.addClass('whithout-alert');
	},
	getCookie: function (name) {

		// get cookie function
		var match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]+)'));
		return match ? match[2] : null;
	},
	setCookie: function (name, value, days) {

		// set cookie function
		var now = new Date();
		var time = now.getTime();
		var expireTime = time + 1000 * 60 * 60 * 24 * days;
		now.setTime(expireTime);
		document.cookie = name + '=' + value + '; expires=' + now + ';path=/';
	}
}


var Header = {
	init: function () {
		this.cacheDom();
		this.eventTrigger();
	},

	cacheDom: function () {
		this.$alert = $('.alert-message');
		this.$header = $('header.main');
		this.$headerHeight = this.$header.height();
		this.$alertHeight = this.$alert.height();
		this.$heroHeight = $('.hero').height();
	},

	eventTrigger: function () {
		$(window).on('scroll', this.hideHeader);
	},

	hideHeader: function () {
		if (($(window).scrollTop() > (Header.$alertHeight + Header.$headerHeight + Header.$heroHeight))) {
			Header.$alert.addClass('invisible');
			Header.$header.addClass('fixed slideInDown');
		} else {
			Header.$alert.removeClass('invisible');
			Header.$header.removeClass('fixed slideInDown');
		}
	}
}


var MegaMenu = {
	init: function () {
		this.cacheDom();
		this.eventTrigger();
	},

	cacheDom: function () {
		this.$mainMenuItem = $('.main-menu .menu-item-object-ccs_custom_menu_item');
	},

	eventTrigger: function () {

		// this.$mainMenuItem.on('click', this.checkMegaOpen.bind(this));

		this.$mainMenuItem.on({
			mouseenter: this.MMshow.bind(this),
			mouseleave: this.checkMegaOpen.bind(this)
		});

		this.$mainMenuItem.on('click touchend', function (e) {
			if (e.type == 'click') {} else {
				if (!($(e.currentTarget)).hasClass('active')) {
					e.preventDefault();
					MegaMenu.MMshow(e);
				}
			}
		});



	},

	checkMegaOpen: function (e) {

		if (!($(e.currentTarget)).hasClass('active')) {
			e.preventDefault();
			this.MMshow(e);
		} else  {
this.MMhide(e);

		}

		$('html').one('click touchend', function () {
			MegaMenu.MMhideall();
		});

		e.stopPropagation();


	},

	MMshow: function (e) {

			this.MMhideall();




			$(e.currentTarget).addClass('active');

			$(e.currentTarget).find('.navi-megamenu').slideDown(400);




		},

		MMhide: function (e) {

			$(e.currentTarget).removeClass('active');
	$(e.currentTarget).find('.navi-megamenu').slideUp(400);
		},

		MMhideall: function () {
			this.$mainMenuItem.each(function () {
				$(this).removeClass('active');
				$(this).find('.navi-megamenu').slideUp(400);
			});
		}
	}



var jsAccordeon = {

	init: function () {
		this.cacheDOM();
		this.bindEvent();
		// this.hideAll();
		this.accordionUrl();
	},

	// Get elements
	cacheDOM: function () {
		// this.$accordeon = $('.accordeon-wrapper');
		this.$element = $('.accordion-element');
		this.$trigger = this.$element.find('.accordion-element__title');
	},

	// Bind actions
	bindEvent: function () {
		this.$trigger.on('click', this.showContent);
	},

	// Methods
	showContent: function () {
		var $element = $(this).parent('.accordion-element'),
			$content = $element.find('.accordion-element__content');

		if ($element.hasClass('active')) {
			jsAccordeon.hide.call($element);
		} else {
			// jsAccordeon.hideAll();
			jsAccordeon.show.call($element);
		}
	},
	
	accordionUrl: function () {
		var accordionLocUrl = window.location.hash.replace("#","");
		var $elementAnchor = document.getElementById( accordionLocUrl );
		jsAccordeon.show.call($elementAnchor);
	},

	hide: function () {
		$(this).removeClass('active');
	},

	show: function () {
		$(this).addClass('active');
	},

	hideAll: function () {
		this.$element.each(this.hide);
	}
}
var Tab = {
	init: function () {
		this.cacheDOM();
		this.bindEvent();
	},

	// Get elements
	cacheDOM: function () {
		this.$container = $('.tabs');
		this.$tabHeads = this.$container.find('.tab-head li');
		this.$tabBodies = this.$container.find('.tab-body');
		this.$trigger = this.$container.find('.tab-head a');
		this.$activeTabHeadId = this.$container.find('.tab-head li.active .act').data('tab');
		this.$container.find('div#' + this.$activeTabHeadId).addClass('active');
	},

	// Bind actions
	bindEvent: function () {
		this.$trigger.on('click', this.showContent);
	},

	// Methods
	showContent: function (e) {
		e.preventDefault();

		var parentTabs = $(this).parent().parent().parent();

		if (!$(this).parent('li').hasClass('active')) {

			var currentTabId = $(this).data('tab');
			var $content = $(this).closest('.tabs').find('div#' + currentTabId);
			var $li = $(this).parent('li');

			Tab.hideAll(parentTabs);
			Tab.show.call($li);
			Tab.show.call($content);

		}

	},

	hide: function () {
		$(this).removeClass('active');
	},

	show: function () {
		$(this).addClass('active');
	},

	hideAll: function (parentTabs) {
		if (parentTabs) {
			var $tabHeads = parentTabs.find('.tab-head li');
			var $tabBodies = parentTabs.find('.tab-body');
			$tabHeads.removeClass('active');
			$tabBodies.removeClass('active');
		} else {
			Tab.$tabHeads.removeClass('active');
			Tab.$tabBodies.removeClass('active');
		}
	}
}

$(document).ready(function () {
	Alert.init();
	Project.init();
	Project.formOpen();
	Project.tablesWrapper();
	Project.nextSteps();
	Project.wrapIframe();
	Project.slickSliders();
	Project.mobileMenu();
	Project.heroMobileMenu();
	Project.tabsMobileSlider();
	Project.revealImages();
	Project.justScroll();
	Project.stopScroll();
	Project.blogNavigation();
	Project.searchFormText();
	Project.searchFormTextFaq();
	Project.instructionalText();
	MegaMenu.init();
	//	if ($('body').hasClass('home')) {
	Header.init();
	//	}
	jsAccordeon.init();
	Tab.init();
	Project.openToggler();
});

window.t = Tab;

})( jQuery );