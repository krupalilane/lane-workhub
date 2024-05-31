$(document).ready(function() {
    // Custom method to check if email exists
        $.validator.addMethod("emailExists", function(value, element) {
            var response = false;
            $.ajax({
                type: "POST",
                url: check_email_url, // URL to your server-side script
                data: { email: value },
                dataType: "json",
                async: false,
                success: function(data) {
                    if (typeof data.user_id !== "undefined") {
                        $('#user_id').val(data.user_id);
                        console.log(data.user_id);
                    }
                    response = !data.exists;
                }
            });
            return response;
        }, "Email not exists.");
    $('#forget-form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    $('#forget-form').validate({
        rules: {
            email: {
                required: true,
                email: true,
                emailExists: true
            }
        },
        messages: {
            email: {
                required: "Please provide Email!",
                email: "Enter valid email!"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});