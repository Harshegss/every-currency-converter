jQuery(document).ready(function($) {
    $('#change_currency_by_harsh').on('change',function(){
        let value = $(this).val();
        $.ajax({
          url: my_ajax_object.ajax_url, // WordPress AJAX URL
          type: 'POST',
          data: {
            action: 'my_ajax_action',
            to: value
          },
          beforeSend: function() {
        // setting a timeout
        $('#every_currency_converter').prepend('<div class="every_currency_converter_loader"></div>');
    },
          success: function(response) {
            console.log(response);
            window.location.href=window.location
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
        });
      })
  });