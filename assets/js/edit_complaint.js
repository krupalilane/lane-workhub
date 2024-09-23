$(document).ready(function() {
  $('#edit_complaint_form').validate({
    rules: {
      root_cause: {
        required: true
      },
      resolution: {
        required: true
      },
      corrective_action: {
        required: true
      },
      date_colsed: {
        required: true
      }      
    },
    messages: {
      root_cause: {
        required: "Please add details for root cause!"
      },
      resolution: {
        required: "Please add details for preventive measures or resolution!"
      },
      corrective_action: {
        required: "Please add details for corrective action!"
      },
      date_colsed: {
        required: "Please select date of closed!"
      }        
    },
    submitHandler: function(form) {
      $('#submit').prop('disabled', true);
      $('#submit').val('Submitting...');
      form.submit();
    }
  });
});
$('.zoom_complaint_image').click(function() {
  var image_url = $(this).data('imageurl');
  $('#zoom_complaint_image_big').attr('src', image_url);
  $('#complaint_image_modal').modal('show');
});