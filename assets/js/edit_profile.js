$(document).ready(function() {
    // Adding custom validation method for password
    $.validator.addMethod("passwordCheck", function(value, element) {
        return this.optional(element) 
            || /[A-Z]/.test(value) // has an uppercase letter
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value); // has a digit
    }, "Password must contain at least one uppercase letter, one lowercase letter, and one digit.");
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
                response = !data.exists;
            }
        });
        return response;
    }, "Email already exists.");
    // Custom method to check if current password match or not
    $.validator.addMethod("passwordExists", function(value, element) {
        var response = false;
        $.ajax({
            type: "POST",
            url: check_current_pasword_url, // URL to your server-side script
            data: { password: value },
            dataType: "json",
            async: false,
            success: function(data) {
                response = !data.exists;
            }
        });
        return response;
    }, "Please enter correctCurrent password.");
    $.validator.addMethod("alphaNumericNoFirstNumber", function(value, element) {
        return this.optional(element) || /^[a-zA-Z][a-zA-Z0-9]*$/.test(value);
    }, "Only alphanumeric words are allowed, and the first character cannot be a number.");
    $('#profile_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    $('#profile_form').validate({
        rules: {
            firstname: {
                required: true,
                alphaNumericNoFirstNumber: true
            },
            lastname: {
                required: true,
                alphaNumericNoFirstNumber: true
            },
            localoffice: {
                required: true
            },
            phone: {
                phoneUS: true
            }
        },
        messages: {
            firstname: {
                required: "First name is required!"
            },
            lastname: {
                required: "Last name is required!"
            },
            localoffice: {
                required: "Please select local office!"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#email_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    $('#email_form').validate({
        rules: {
            emailnew: {
                required: true,
                email: true,
                emailExists: true
            },
            remailnew: {
                required: true,
                equalTo: "#emailnew"
            },
            email_understand: {
                required: true
            },
        },
        messages: {
            emailnew: {
                required: "Please provide Email!",
                email: "Enter valid email!"
            },
            rpassword: {
                required: "Please Re-type your Email!",
                equalTo: "Email must match!"
            },
            email_understand: {
                required: "You must signify that you agree to the above statement."
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "email_understand") {
                error.appendTo("#understand_error");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#password_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    $('#password_form').validate({
        rules: {
            currentpassword: {
                required: true,
                passwordExists: true
            },
            newpassword: {
                required: true,
                passwordCheck: true
            },
            rnewpassword: {
                required: true,
                equalTo: "#newpassword"
            }
        },
        messages: {
            currentpassword: {
                required: "Current password is required!"
            },
            newpassword: {
                required: "New password is required!"
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