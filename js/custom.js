(function($, Drupal, drupalSettings) {

    // (function ($, Drupal) {

    $.fn.datacheck = function() {
        alert("ajax worked");
        $("#custom_get_user_details").submit();
    };

// }(jQuery, Drupal));


    Drupal.behaviors.MyModuleBehavior = {
        attach: function(context, settings) {
            // get color_body value with "drupalSettings.mymodule.color_body"
            var color_body = drupalSettings.yashaswi_exercise.color_body;
            alert(color_body)
            $('body').css('background', color_body);
        }
    };

// (function ($) {
    $(document).ready(function () {
        var $permanentAdd = $('#same-as-permanent');
        var $tempAdd = $('.form-item-temporary-address');
        if ($permanentAdd.is(':checked')) {
            $tempAdd.hide();
        }
        $permanentAdd.on('change', function () {
        if ($(this).is(':checked')) {
            $tempAdd.hide();
        } else {
            $tempAdd.show();
        }
        });
    });
// })(jQuery);


} (jQuery, Drupal, drupalSettings));