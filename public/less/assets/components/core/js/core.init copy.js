/* Remove Envato Frame */
if (window.location != window.parent.location)
	top.location.href = document.location.href;

(function($, window)
{

	// fix for safari back button issue
	window.onunload = function(){};

	$.expr[':'].scrollable = function( elem )
    {
      var scrollable = false,
          props = [ '', '-x', '-y' ],
          re = /^(?:auto|scroll)$/i,
          elem = $(elem);

      $.each( props, function(i,v){
        return !( scrollable = scrollable || re.test( elem.css( 'overflow' + v ) ) );
      });

      return scrollable;
    };

	window.beautify = function (source)
	{
		var output,
			opts = {};

	 	opts.preserve_newlines = false;
		output = html_beautify(source, opts);
	    return output;
	}

	// generate a random number within a range (PHP's mt_rand JavaScript implementation)
	window.mt_rand = function (min, max)
	{
		var argc = arguments.length;
		if (argc === 0) {
			min = 0;
			max = 2147483647;
		}
		else if (argc === 1) {
			throw new Error('Warning: mt_rand() expects exactly 2 parameters, 1 given');
		}
		else {
			min = parseInt(min, 10);
			max = parseInt(max, 10);
		}
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	// scroll to element animation
	function scrollTo(id)
	{
		if ($(id).length)
			$('html,body').animate({scrollTop: $(id).offset().top},'slow');
	}

	if (typeof $.fn.niceScroll != 'undefined')
	{
		$('#menu > div')
		.addClass('hasNiceScroll')
		.niceScroll({
			zindex: 1001,
			cursorborder: "none",
			cursorborderradius: "0",
			cursorcolor: primaryColor,
			horizrailenabled: false,
			enablemousewheel: true,
			preservenativescrolling: false
		});
	}

	// handle menu toggle button action
	function toggleMenuHidden(onload)
	{
		if (typeof onload == 'undefined')
			var onload = false;

		if (!$('html.content-transitions').length)
			$('html').addClass('content-transitions');

		var c = $('.container-fluid');
		c.toggleClass('menu-hidden sidebar-hidden-phone');

		if (c.is('.menu-hidden'))
			$('#menu').addClass('hidden-xs');
		else
			$('#menu').removeClass('hidden-xs');
	}

	if (typeof Holder != 'undefined')
	{
		Holder.add_theme("dark", {background:"#424242", foreground:"#aaa", size:9}).run();
		Holder.add_theme("white", {background:"#fff", foreground:"#c9c9c9", size:9}).run();
	}

	if (Modernizr.touch)
	{
		$('html.sidebar .container-fluid:first').on('swipeleft swiperight', function(e){
			if ($(this).is('.sidebar-hidden-phone') && e.type == 'swiperight')
				return toggleMenuHidden();
			if (!$(this).is('.sidebar-hidden-phone') && e.type == 'swipeleft')
				return toggleMenuHidden();

			e.preventDefault();
		});

		$('html.sidebar .container-fluid').on('movestart', function(e) {
			// If the movestart is heading off in an upwards or downwards
			// direction, prevent it so that the browser scrolls normally.
			if ((e.distX > e.distY && e.distX < -e.distY) ||
				(e.distX < e.distY && e.distX > -e.distY)) {
				e.preventDefault();
			}
		});
	}

	if (!Modernizr.touch)
	{
		$('html.sidebar.sidebar-hat #menu').on('mouseenter', function(){
			if ($(this).parents('.menu-hidden').length)
				toggleMenuHidden();
		}).on('mouseleave', function(){
			if (!$(this).parents('.menu-hidden').length)
			{
				$(this).find('li.dropdown.open > [data-toggle="dropdown"]').click();
				toggleMenuHidden();
			}
		});

		// dropdown menus
		$('html.sidebar.sidebar-dropdown').find('.slim-scroll > ul, > ul').on('mouseenter', '> li.dropdown:not(.open)', function(){
			$(this).find('> [data-toggle="dropdown"]').click();
		});

		// Dropdowns
		$('.navbar.main ul.topnav').on('mouseenter', '> li.dropdown:not(.open)', function(){
			$(this).find('> [data-toggle="dropdown"]').click();
		});
		$('.navbar.main').on('mouseleave', 'li.dropdown.open', function(){
			$(this).find('> [data-toggle="dropdown"]').click();
		});

		// Mega menus
		$('.navbar.main ul.topnav').on('mouseenter', '> li.mega-menu:not(.mega-menu-open)', function(){
			$(this).find('> a').click();
		});
		$('.navbar.main').on('mouseleave', 'li.mega-menu.mega-menu-open', function(){
			$('body').click();
		});
	}

	// Sidebar menu collapsibles
	if ($('html.sidebar-collapsible').length)
	{
		$('#menu .collapse').on('show.bs.collapse', function(e)
		{
			e.stopPropagation();
			$(this).parents('.hasSubmenu:first').addClass('active');

			if ($('html.sidebar-collapsible .container-fluid:first').is('.menu-hidden'))
				toggleMenuHidden();
		})
		.on('hidden.bs.collapse', function(e)
		{
			e.stopPropagation();
			$(this).parents('.hasSubmenu:first').removeClass('active');
		});
	}

	// main menu visibility toggle
	$('.navbar.main .btn-navbar, #menu .btn-navbar').click(function()
	{
		var disabled = typeof toggleMenuButtonWhileTourOpen != 'undefined' ? toggleMenuButtonWhileTourOpen(true) : false;
		if (!disabled)
			toggleMenuHidden();
	});

	// multi-level top menu
	$('.submenu').hover(function()
	{
        $(this).children('ul').removeClass('submenu-hide').addClass('submenu-show');
    }, function()
    {
    	$(this).children('ul').removeClass('submenu-show').addClass('submenu-hide');
    });

	// tooltips
	$('body').tooltip({ selector: '[data-toggle="tooltip"]' });

	// popovers
	$('[data-toggle="popover"]').popover();

	// loading state for buttons
	$('[data-toggle*="btn-loading"]').click(function () {
        var btn = $(this);
        btn.button('loading');
        setTimeout(function () {
        	btn.button('reset')
        }, 3000);
    });
	$('[data-toggle*="button-loading"]').click(function () {
        var btn = $(this);
        btn.button('loading');
    });

	// print
	$('[data-toggle="print"]').click(function(e)
	{
		e.preventDefault();
		window.print();
	});

	// carousels
	$('.carousel').carousel();

	// Google Code Prettify
	if ($('.prettyprint').length && typeof prettyPrint != 'undefined')
		prettyPrint();

	$(window).setBreakpoints({
		distinct: false,
		breakpoints: [ 768 ]
	});

	$(window).bind('exitBreakpoint768',function() {
		$('.container-fluid').addClass('menu-hidden');
	});

	$(window).bind('enterBreakpoint768',function() {
		if (!$('.sidebar-width-mini').length)
			$('.container-fluid').removeClass('menu-hidden');
	});

	if ($(window).width() <= 768)
		$('.container-fluid').addClass('menu-hidden');

})(jQuery, window);