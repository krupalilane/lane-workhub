$(document).ready(function() {
    $('#login-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please provide Email!",
                email: "Enter valid email!"
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