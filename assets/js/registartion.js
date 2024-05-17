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
    $('#register-form').validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            localoffice: {
                required: true
            },
            email: {
                required: true,
                email: true,
                emailExists: true
            },
            password: {
                required: true,
                passwordCheck: true
            },
            rpassword: {
                required: true,
                equalTo: "#register_password"
            },
            agree_eul: {
                required: true
            },
            agree_tou: {
                required: true
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
            },
            email: {
                required: "Please provide Email!",
                email: "Enter valid email!"
            },
            password: {
                required: "Password is required!"
            },
            rpassword: {
                required: "Please Re-type your Password!",
                equalTo: "Passwords must match!"
            },
            agree_eul: {
                required: "Please read/accept End User License!"
            },
            agree_tou: {
                required: "Please read/accept Terms of Use!"
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "agree_eul") {
                error.appendTo("#register_eul_error");
            }else if(element.attr("name") == "agree_tou"){
                error.appendTo("#register_tou_error");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});