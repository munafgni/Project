jQuery(function($){

	// FitVids
	$('.entry-content').fitVids({ customSelector: "iframe[src^='https://www.slideshare.net']"});

	// Mega Menu
	$('.mega-menu').each(function(){
		$(this).find('.column').matchHeight();
	});

	// Mobile Menu
	$('.mobile-menu-toggle').sidr({
		name: 'sidr-mobile-menu',
		side: 'right',
		renaming: false,
	});
	$('.menu-item-has-children').prepend('<span class="submenu-toggle">' );
	$('.menu-item-has-children.sidr-class-current-menu-item').addClass('submenu-active');
	$('.menu-item-has-children > .submenu-toggle').click(function(e){
		$(this).parent().toggleClass('submenu-active');
		e.preventDefault();
	});
	$('.sidr a').click(function(e){
		$.sidr('close', 'sidr-mobile-menu');
		if( $(this).hasClass('close') ) {
			e.preventDefault();
		}
	});
	$(document).on( 'mouseup touchend', (function (e){
		var container = $("#sidr-mobile-menu");
		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$.sidr('close', 'sidr-mobile-menu');
		}
	}));

	// Select Visa
	$('.select-visa > a').click(function(e){
		e.preventDefault();
		$(this).parent().toggleClass('active');
	});
	$(document).on( 'mouseup touchend', function(e){
		var container = $('.select-visa.active');
		if( !container.is(e.target) && container.has(e.target).length === 0 ) {
			container.removeClass('active');
		}
	});

	// Load Disqus Comments
	$('.show-comments').on('click', function(e){
          var disqus_shortname = 'visapro'; // Replace this value with *your* username.

          // ajax request to load the disqus javascript
          $.ajax({
                  type: "GET",
                  url: "//" + disqus_shortname + ".disqus.com/embed.js",
                  dataType: "script",
                  cache: true
          });
          // hide the button once comments load
          $(this).fadeOut();
		  e.preventDefault();
    });

	// Newsletter Subscribe
	$('#wpforms-304-field_7 li').find('label strong').parent().parent().addClass('top-level');
	$('#wpforms-304-field_7 .top-level > input').change(function(){
		$(this).parent().nextUntil('.top-level').addClass('visible');
	});

	$(document).on('change', '#wpforms-304-field_7 .visible > input', function(){
		console.log('click');
		$(this).parent().prev('.top-level').find('input').prop('checked', 0);
	});

	// Switch Tab
	$('.tab-section .tab-nav a').click(function(e){
		$('.tab-section .tab-nav .current').removeClass('current');
		$('.tab-section .tab-content.current').removeClass('current');
		$(this).addClass('current');
		$('.tab-section .tab-content' + $(this).attr('href')).addClass('current');
		e.preventDefault();
	});

	// Match Height
	$('.visa-advisor-steps .description').matchHeight();
	$('.page-template-green-thank-you .more-information .item-content').matchHeight();
	$('.page-template-immigration-lawyer-consultation .service-options .service-box-content').matchHeight();
	$('.home-options .option .summary').matchHeight();
	$('.about-you .about-box .col').matchHeight();
	if( $('.page-template-service-options .service-listing').length ) {
		for( i = 0; i < 10; i++ ) {
			$('.service-listing .feature-' + i).matchHeight();
		}
	}

	// Resource Toggles
	$('.resource-filter .toggle').click(function(e){
		e.preventDefault();
		$(this).parent().toggleClass('active');
	});

	// Resource Load More
	var loading = false;
	$('body').on('click', '.resource-load-more', function(e){
		var button = $(this);
		$(button).addClass('loading');
		e.preventDefault();
		if( ! loading ) {
			loading = true;
			var data = {
				action: 'vp_resource_load_more',
				vp_resource_type: $(this).data('resource-type'),
				vp_resource_topic: $(this).data('resource-topic'),
				vp_resource_page: $(this).data('resource-page'),
				vp_resource_button_text: $(this).text()
			}
			$.post(vp_global.url, data, function(res){
				if( res.success ) {
					$(button).after( res.data );
					$(button).remove();
					loading = false;
				} else {
				}
			}).fail(function(xhr, textStatus, e) {
			});
		}
	});

	// Home Testimonial Carousel
	$('.testimonial-carousel').slick({appendArrows: '.carousel-nav', prevArrow: '<button type="button" class="slick-prev"><i class="icon-chevron-left"></i></button>', nextArrow: '<button type="button" class="slick-next"><i class="icon-chevron-right"></i></button>'});

	// Smooth scrolling anchor links
	function ea_scroll( hash ) {
		var target = $( hash );
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {
			var top_offset = 0;
			if ( $('.site-header').css('position') == 'fixed' ) {
				top_offset = $('.site-header').height();
			}
			if( $('body').hasClass('admin-bar') ) {
				top_offset = top_offset + $('#wpadminbar').height();
			}
			 $('html,body').animate({
				 scrollTop: target.offset().top - top_offset
			}, 1000);
			return false;
		}
	}
	// -- Smooth scroll on pageload
	if( window.location.hash ) {
		ea_scroll( window.location.hash );
	}
	// -- Smooth scroll on click
	$('a[href*="#"]:not([href="#"]):not(.no-scroll)').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			ea_scroll( this.hash );
		}
	});


});

// Google Site Search
  (function() {
    var cx = '009252728610438234297:zunbqkhilbw';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
