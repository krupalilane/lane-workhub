$(document).ready(function() {
    // Adding custom validation method for password
    $.validator.addMethod("passwordCheck", function(value, element) {
        return this.optional(element) 
            || /[A-Z]/.test(value) // has an uppercase letter
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value); // has a digit
    }, "Password must contain at least one uppercase letter, one lowercase letter, and one digit.");
    $('#reset_password_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    $('#reset_password_form').validate({
        rules: {
            password: {
                required: true,
                passwordCheck: true
            },
            rpassword: {
                required: true,
                equalTo: "#register_password"
            }
        },
        messages: {
            password: {
                required: "Password is required!"
            },
            rpassword: {
                required: "Please Re-type your Password!",
                equalTo: "Passwords must match!"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});