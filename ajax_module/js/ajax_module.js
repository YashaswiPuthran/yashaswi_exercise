(function ($) {
    $(document).ready(function) {
    // Drupal.behaviors.myModule = {
      attach: function (context, settings) {
        $('#edit-third-field').hide();

        $('#edit-checkbox-field').change(function () {
          // Check if the checkbox is selected
          if ($(this).is(':checked')) {
            // Show the third field
            $('#edit-third-field').show();
          } else {
            // Hide the third field
            $('#edit-third-field').hide();
          }
        });
      }
    };
  })(jQuery);