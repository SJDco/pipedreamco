/*global document, window, $, sjdInstagramFeed */
/*jshint globalstrict: true */
'use strict';

/** Instantiate Foundation */
$(document).foundation();

/** On Document Load */
$(function () {

    // App code here...
    // window.console.log("Now Running: Sam Bedrock Theme");

    // Configure matchHeight on the .matchHeight class
    $('.matchHeight').matchHeight();

    // Animate the hamburger when clicked
    $('#animated-hamburger').click(function() {
        $(this).toggleClass("active");
        $('#mobile-nav').slideToggle(200);
    });

    // Init Owl carousel
    $('.hero-slider').owlCarousel({
        items: 1,
        autoplay: true,
        animateOut: 'fadeOut',
        loop: true
    });

    // Init sjdInstagramFeed
    sjdInstagramFeed.init();

    // Init keepsquared to isntagram images
    $('.instagram-image').keepSquared();

    // Show mobile-menu sub menus when the parens is clicked/tapped
    $('.mobile-nav .menu-item-has-children a').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('sub-menu-active');
        $(this).next().slideToggle(200);
    });


    // Add appropriate wrappers around content-area h1s
    $('.content-area .page-title').wrap('<div class="page-title-container">')
    .parent().append('<div class="page-title-line"></div>');

});