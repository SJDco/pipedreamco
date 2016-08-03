/*global document, window, $ */
/*jshint globalstrict: true */
'use strict';

/** Instantiate Foundation */
$(document).foundation();

/** On Document Load */
$(function () {

    // App code here...
    window.console.log("Now Running: Sam Bedrock Theme");

    // Configure matchHeight on the .matchHeight class
    $('.matchHeight').matchHeight();

    // Animate the hamburger when clicked
    $('#animated-hamburger').click(function() {
        $(this).toggleClass("active");
        $('#mobile-nav').slideToggle(200);
    });

});