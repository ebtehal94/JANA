/**
 * Title:   Dashcore - HTML App Landing Page - Main Javascript file
 * Author:  http://themeforest.net/user/5studiosnet
 **/
 import $ from 'jquery'
 import jQuery from 'jquery'

(function() {
    'use strict';

    // Avoid `console` errors in browsers that lack a console.
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any code in here.
$(function(){
    'use strict';

    /** navbar reference **/
    var $navbar = $(".main-nav"),
        stickyPoint = 90;

    /** Perspective mockups reference **/
    var $perspectiveMockups = $(".perspective-mockups");

    // This element is used as reference for relocation of the mockups on mobile devices.
    // If you remove it please be sure you add another reference element preferably within the same section and/or position the button was.
    // You can change the selector (".learn-more") to one that uniquely identifies the reference element.
    var $topReference = $(".learn-more", ".lightweight-template");

    var setMockupsTop = function() {
        // check if the perspective mockups elements are on the page, if you're not going to use them, you can remove all its references
        if (!$perspectiveMockups.length) return;

        if ($(window).outerWidth() < 768) {
            $perspectiveMockups.css({top: $topReference.offset().top + "px"});
            return;
        }

        $perspectiveMockups.removeAttr("style");
    };

    var navbarSticky = function() {
        if ($(window).scrollTop() >= stickyPoint) {
            $navbar.addClass("navbar-sticky");
        } else {
            $navbar.removeClass("navbar-sticky");
        }
    };

    /**
     * STICKY MENU
     **/
    $(window).on("scroll", navbarSticky);

    navbarSticky();

    /**
     * SCROLLING NAVIGATION
     * Enable smooth transition animation when scrolling
     **/
    $('a.scrollto').on('click', function (event) {
        event.preventDefault();

        var scrollAnimationTime = 1200;
        var target = this.hash;

        $('html, body').stop().animate({
            scrollTop: $(target).offset().top - 45
        }, scrollAnimationTime, 'easeInOutExpo', function () {
            window.location.hash = target;
        });
    });

    /**
     *  NAVBAR SIDE COLLAPSIBLE - On Mobiles
     **/
    $(".navbar-toggler", $navbar).on("click", function() {
        if (!$navbar.is('.st-nav')) $navbar.toggleClass("navbar-expanded");
    });

    /**
     * Blog interaction with buttons: favorite and bookmark
     **/
    $('.card-blog').on({
        click: function (e) {
            e.preventDefault();

            var $el = $(this).removeClass('far').addClass('fas');
            if ($el.hasClass('favorite')) {
                $el.addClass('text-danger');
            } else {
                $el.addClass('text-warning');
            }
        },
        mouseenter: function () {
            $(this).addClass('fas');
        },
        mouseleave: function () {
            $(this).removeClass('fas');
        }
    }, 'i.far');

    /**
     * Position the perspective mockups at the end of the first content section on mobile
     **/
    $perspectiveMockups.removeClass("hidden-preload");
    $(window).on("resize", setMockupsTop);

    setMockupsTop();

    /**
     * AOS
     * Cool scrolling animations
     **/
    // AOS.init({
    //     offset: 100,
    //     duration: 1500,
    //     disable: 'mobile'
    // });


});
