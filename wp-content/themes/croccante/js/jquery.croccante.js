(function($) {
	"use strict";
	$( window ).scroll(function () {
		if( $( 'ul.croccante_sectionmap' ).length ) {
			var currentNode = null;
			$('.croccante_onepage_section').each(function () {
				var s = $(this);
				var currentId = s.attr('id') || '';
				if ( $( window ).scrollTop() >= s.offset().top - 56 ) {
					currentNode = currentId;
				}

			});
			$('ul.croccante_sectionmap li').removeClass('current-section');
			if ( currentNode ) {
				$('ul.croccante_sectionmap li').find('a[href$="#' + currentNode + '"]').parent().addClass('current-section');
			}
		}
	});
	$(window).load(function() {
		if ( $( '.flexslider' ).length ) {
		  $('.flexslider').flexslider({
			animation: 'fade',
			controlNav: false,
			slideshowSpeed: 7000,
			animationSpeed: 1000, 
			pauseOnHover: true
		  });
		}
	});
	$(document).ready(function() {
		/*-----------------------------------------------------------------------------------*/
		/*  Detect Mobile Browser
		/*-----------------------------------------------------------------------------------*/
			var mobileDetect = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		/*-----------------------------------------------------------------------------------*/
		/*  Page Loader
		/*-----------------------------------------------------------------------------------*/ 
			if ( $( '.croccanteLoader' ).length ) {
				$('.croccanteLoader').delay(600).fadeOut(1000);
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Home icon in main menu
		/*-----------------------------------------------------------------------------------*/ 
			if($('body').hasClass('rtl')) {
				$('.main-navigation .menu-item-home:first-child > a').append('<i class="fa fa-home spaceLeft"></i>');
			} else {
				$('.main-navigation .menu-item-home:first-child > a').prepend('<i class="fa fa-home spaceRight"></i>');
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Set slider height an onepage services
		/*-----------------------------------------------------------------------------------*/ 	
			function setHeightOnepage() {
				if ( $( '.flexslider' ).length ) {
					var windowHeight = $(window).innerHeight() - 85;
					$('.flexslider, .flexslider .slides > li .flexText .inside, .flexslider .slides li .flexImage').css({
					  'height': windowHeight
					});
				}
			}
			function setHeightServices() {
				if($('body').hasClass('page-template-template-onepage')) {
					if ( $( 'section.croccante_services' ).length ) {
						var servicesHeight = $('.services_columns_single.one').outerHeight();
						$('.serviceContent').css({
						  'height': servicesHeight
						});
					}
				}
			}
			setHeightOnepage();
			setHeightServices();
		/*-----------------------------------------------------------------------------------*/
		/*  Sidebar Push Button
		/*-----------------------------------------------------------------------------------*/ 
			$('#push-nav, .opacityBox').click(function(){
				var $delay = 0;
				if ( $('.icon-search').hasClass('is-active') ) {
					$('.icon-search, .opacityBoxSearch, .search-container').removeClass('is-active');
					$('#primary.content-area,#secondary.widget-area,.footerArea').removeClass('open');
					$delay = 300;
				}
				setTimeout(function() {
					$('#push-nav, .opacityBox, #tertiary.widget-area').toggleClass('open');
					$('#primary.content-area,#secondary.widget-area,.footerArea').toggleClass('open');
				}, $delay);
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Search Push Button
		/*-----------------------------------------------------------------------------------*/ 
			$('.icon-search, .opacityBoxSearch').click(function(){
				var $ddelay = 0;
				if ( $('#push-nav').hasClass('open') ) {
					$('#push-nav, .opacityBox, #tertiary.widget-area').removeClass('open');
					$('#primary.content-area,#secondary.widget-area,.footerArea').removeClass('open');
					$ddelay = 300;
				}
				setTimeout(function() {
					$('.icon-search, .opacityBoxSearch, .search-container').toggleClass('is-active');
					$('#primary.content-area,#secondary.widget-area,.footerArea').toggleClass('open');
				}, $ddelay);
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Scroll to section
		/*-----------------------------------------------------------------------------------*/ 
			$('ul.menu a[href*="#"]:not([href="#"]), ul.croccante_sectionmap li a').click(function() {
				if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
				  var target = $(this.hash);
				  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				  if (target.length) {
					$('html, body').animate({
					  scrollTop: target.offset().top - 55
					}, 1000);
					return false;
				  }
				}
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Set nanoscroller
		/*-----------------------------------------------------------------------------------*/ 
			function setNano() {
				if ( $( '#tertiary.widget-area' ).length ) {
					$('.nano').nanoScroller({ preventPageScrolling: true });
				}
			}
			setNano();
		/*-----------------------------------------------------------------------------------*/
		/*  Menu Widget
		/*-----------------------------------------------------------------------------------*/
			if ( $( 'aside ul.menu' ).length ) {
				$('aside ul.menu').find('li').each(function(){
					if($(this).children('ul').length > 0){
						$(this).append('<span class="indicatorBar"></span>');
					}
				});
				$('aside ul.menu > li.menu-item-has-children .indicatorBar, .aside ul.menu > li.page_item_has_children .indicatorBar').click(function() {
					$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpenBar');
					$(this).toggleClass('yesOpenBar');
					var $self = $(this).parent();
					if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpenBar')) {
						$self.find('> ul.sub-menu, > ul.children').slideDown(300);
					} else {
						$self.find('> ul.sub-menu, > ul.children').slideUp(200);
					}
				});
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Mobile Menu
		/*-----------------------------------------------------------------------------------*/ 
			if ($( window ).width() <= 1024) {
				$('.main-navigation').find('li').each(function(){
					if($(this).children('ul').length > 0){
						$(this).append('<span class="indicator"></span>');
					}
				});
				$('.main-navigation ul > li.menu-item-has-children .indicator, .main-navigation ul > li.page_item_has_children .indicator').click(function() {
					$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpen');
					$(this).toggleClass('yesOpen');
					var $self = $(this).parent();
					if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpen')) {
						$self.find('> ul.sub-menu, > ul.children').slideDown(300);
					} else {
						$self.find('> ul.sub-menu, > ul.children').slideUp(200);
					}
				});
			}
			$(window).resize(function() {
				if ($( window ).width() > 1024) {
					$('.main-navigation ul > li.menu-item-has-children, .main-navigation ul > li.page_item_has_children').find('> ul.sub-menu, > ul.children').slideDown(300);
				}
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Waypoints general script
		/*-----------------------------------------------------------------------------------*/ 
		if($('body').hasClass('page-template-template-onepage')) {
			if ( $.isFunction($.fn.waypoint) ) {
				/*-----------------------------------------------------------------------------------*/
				/*  Waypoints for section titles
				/*-----------------------------------------------------------------------------------*/ 
					if ( $('.onepage_header.aboutus').hasClass('crocanim') ) {
						$('section.croccante_aboutus').waypoint(function() {
							$('.croccante_action_aboutus .crocanim .crocaniminside').addClass('start');
							setTimeout(function() {
								$('.croccante_action_aboutus .crocanim').addClass('complete');
							}, 600);
						},{
							triggerOnce: true,
							offset: '50%'
						});
					}
					if ( $('.onepage_header.features').hasClass('crocanim') ) {
						$('section.croccante_features').waypoint(function() {
							$('.croccante_action_features .crocanim .crocaniminside').addClass('start');
							setTimeout(function() {
								$('.croccante_action_features .crocanim').addClass('complete');
							}, 600);
						},{
							triggerOnce: true,
							offset: '50%'
						});
					}
					if ( $('.onepage_header.skills').hasClass('crocanim') ) {
						$('section.croccante_skills').waypoint(function() {
							$('.croccante_action_skills .crocanim .crocaniminside').addClass('start');
							setTimeout(function() {
								$('.croccante_action_skills .crocanim').addClass('complete');
							}, 600);
						},{
							triggerOnce: true,
							offset: '50%'
						});
					}
					if ( $('.onepage_header.services').hasClass('crocanim') ) {
						$('section.croccante_services').waypoint(function() {
							$('.croccante_action_services .crocanim .crocaniminside').addClass('start');
							setTimeout(function() {
								$('.croccante_action_services .crocanim').addClass('complete');
							}, 600);
						},{
							triggerOnce: true,
							offset: '50%'
						});
					}
					if ( $('.onepage_header.blog').hasClass('crocanim') ) {
						$('section.croccante_blog').waypoint(function() {
							$('.croccante_action_blog .crocanim .crocaniminside').addClass('start');
							setTimeout(function() {
								$('.croccante_action_blog .crocanim').addClass('complete');
							}, 600);
						},{
							triggerOnce: true,
							offset: '50%'
						});
					}
					if ( $('.onepage_header.team').hasClass('crocanim') ) {
						$('section.croccante_team').waypoint(function() {
							$('.croccante_action_team .crocanim .crocaniminside').addClass('start');
							setTimeout(function() {
								$('.croccante_action_team .crocanim').addClass('complete');
							}, 600);
						},{
							triggerOnce: true,
							offset: '50%'
						});
					}
					if ( $('.onepage_header.contact').hasClass('crocanim') ) {
						$('section.croccante_contact').waypoint(function() {
							$('.croccante_action_contact .crocanim .crocaniminside').addClass('start');
							setTimeout(function() {
								$('.croccante_action_contact .crocanim').addClass('complete');
							}, 600);
						},{
							triggerOnce: true,
							offset: '50%'
						});
					}
				/*-----------------------------------------------------------------------------------*/
				/*  Waypoints for skills
				/*-----------------------------------------------------------------------------------*/ 
				$('section.croccante_skills').waypoint(function() {
					$('.skillBottom .skillRealBar').each( function() {
					var $this = $(this);
						setTimeout(function() {
							$this.css('width',$this.data('number'));
						}, $this.data('delay'));
					});
					$('.skillTop .skillValue').each( function() {
					var $this = $(this);
						setTimeout(function() {
							$this.css({'opacity':'1', 'bottom': '-5px'});
						}, 1000 + $this.data('delay'));
					});
				},{
					triggerOnce: true,
					offset: '60%'
				});
				/*-----------------------------------------------------------------------------------*/
				/*  Waypoints for contact icon
				/*-----------------------------------------------------------------------------------*/ 
				$('section.croccante_contact').waypoint(function() {
					$('.contact_columns .croccanteContactIcon').css({'opacity':'0.1', 'left': '50px'});
				},{
					triggerOnce: true,
					offset: '20%'
				});
			}
		}
		/*-----------------------------------------------------------------------------------*/
		/*  Scroll Down button
		/*-----------------------------------------------------------------------------------*/ 
			if ( $( '.scrollDownCroccante' ).length ) {
				$('.scrollDownCroccante').click(function(){
					$('html, body').animate({ scrollTop: $('section.croccante_slider').outerHeight() }, 1000);
					return false;
				});
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Scroll To Top
		/*-----------------------------------------------------------------------------------*/ 
			if (!mobileDetect || $('#toTop').hasClass('scrolltop_on') ) {
				$(window).scroll(function(){
					if ($(this).scrollTop() > 700) {
						$('#toTop').addClass('visible');
					} 
					else {
						$('#toTop').removeClass('visible');
					}
				}); 
				$('#toTop').click(function(){
					$('html, body').animate({ scrollTop: 0 }, 1000);
					return false;
				});
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Detect Mobile Browser
		/*-----------------------------------------------------------------------------------*/ 
			if ( !mobileDetect ) {
				/*-----------------------------------------------------------------------------------*/
				/*  Set min height for sections
				/*-----------------------------------------------------------------------------------*/
					if($('body').hasClass('page-template-template-onepage')) {
						$('section.croccante_onepage_section').each(function(){
							var sectionTitleHeight = $(this).find('.croccante_inside_header .croccante_main_text');
							if ( sectionTitleHeight.length ) {
								$(this).find('[class$="_columns"]').css({'min-height': sectionTitleHeight.innerWidth() + 30});
							}
						});
					}
				/*-----------------------------------------------------------------------------------*/
				/*  Set resize
				/*-----------------------------------------------------------------------------------*/ 
					$(window).resize(function() {
						setNano();
						setHeightOnepage();
						setHeightServices();
					});
			}
	});
})(jQuery);