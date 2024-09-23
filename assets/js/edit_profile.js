$(document).ready(function() {
    // Adding custom validation method for password
    $.validator.addMethod("passwordCheck", function(value, element) {
        return this.optional(element) 
            || /[A-Z]/.test(value) // has an uppercase letter
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value); // has a digit
    }, "Password must contain at least one uppercase letter, one lowercase letter, and one digit.");
    $('#password_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    $('#password_form').validate({
        rules: {
            newpassword: {
                required: true,
                minlength: 6,
                passwordCheck: true
            },
            rnewpassword: {
                required: true,
                equalTo: "#newpassword"
            }
        },
        messages: {
            newpassword: {
                required: "New password is required!",
                minlength: "Your password must be at least 6 characters long.",
            },
            rnewpassword: {
                required: "Please Re-type your password!",
                equalTo: "Passwords must match!"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});