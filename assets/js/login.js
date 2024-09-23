$(document).ready(function() {
    $('#login-form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    $('#login-form').validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Please provide Username!",
            },
            password: {
                required: "Password is required!"
            }
        },
        submitHandler: function(form) {
            // Form is valid, perform AJAX or regular submit here
            form.submit();
        }
    });
});