(function ($) {
    $(document).ready(function) {
    // Drupal.behaviors.ajaxModule = {
    //   attach: function (context, settings) {
        $('#edit-third-field').hide();

        $('#edit-checkbox-field').change(function () {
          // Check if the checkbox is selected
          if ($(this).is(':checked')) {
            // Show the third field
            $('#edit-third-field').hide();
          } else {
            // Hide the third field
            $('#edit-third-field').show();
          }
        });
      }
    };
  })(jQuery);