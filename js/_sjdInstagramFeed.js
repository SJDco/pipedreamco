/*jshint multistr: true */
/**
* Module for handling instagram feed functionality
* @namespace sjdInstagramFeed
*/
var sjdInstagramFeed = sjdInstagramFeed || {};
(function(context) {
    'use strict';

    var wordpressInstallUrl = $('body').data('wp-install-url');
    var numberOfImagesToFetch = 6;
    var apiEndpointLocation = '/wp-content/themes/pipedreamco/api/ig.php/?count=' + numberOfImagesToFetch;
    var $insertInto = $('#instagram-feed');

    var template = '<div class="small-6 medium-4 large-2 columns">\
                        <a href="{{link}}" target="_blank">\
                            <div class="instagram-image" style="background-image: url(\'{{url}}\')"></div>\
                        </a>\
                    </div>';

    /**
    * Merge variables into a string using the {{variable}} expression syntax
    *
    * @method mergeVariables
    * @param {string} string to merge variables into
    * @param {object: object} Variables to merge
    * @return The merged content
    */
    function mergeWithVariables(mergeVariables, content) {
        for (var merger in mergeVariables) {
            if (mergeVariables.hasOwnProperty(merger)) {
                content = content.replace("{{" + merger + "}}", mergeVariables[merger]);
            }
        }
        return content;
    }

    function init() {

        // console.log("About to query " + wordpressInstallUrl + apiEndpointLocation);

        // Get the IG token
        var $getIGTokenXHR = $.get( wordpressInstallUrl + apiEndpointLocation )
        .success(function(response) {
            // Succeeded

            $insertInto.empty();

            if (response.data[0]) {
                $.each(response.data, function( index, value ) {
                    var vars = {
                        link: value.link,
                        url: value.images.low_resolution.url
                    };

                    var mergedTemplate = mergeWithVariables(vars, template);
                    $insertInto.append(mergedTemplate);
                    $('.instagram-image').keepSquared();
                });
            } else {
                $insertInto.append('<p class="text-center">There are currently no posts here.</p>');
            }


            // $insertInto.append(allImages);

        })
        .fail(function(response) {
            // Failed
            console.error("Failed to get the Instagram access token: " + response.status + " - " + response.statusText);
        })
        .always(function() {
            // Regardless
        });

    }

    context.init = init;

})(sjdInstagramFeed);

