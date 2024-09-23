$(document).ready(function() {
    $('#attachment1').change(function(event) {
        var input = event.target;
        var file = input.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (file) {
            // Validate file type (only images are allowed)
            var validImageTypes = ["image/jpeg", "image/png", "image/gif"];
            if ($.inArray(file.type, validImageTypes) < 0) {
                Swal.fire({
                    icon: "info",
                    title: "No valid images were uploaded.",
                    text: "Only images are allowed. Please select an image!"
                  });
                input.value = ''; // Clear the input
                return;
            }

            // Validate file size (optional, example: max 2MB)
            if (file.size > maxSize) {
                Swal.fire({
                  icon: "warning",
                  title: "Upload Limit Reached",
                  text: "You can only upload a maximum of " + maxSize + " images."
                });
                input.value = ''; // Clear the input
                return;
            }

            // If valid, display the image preview
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result).show();
                $('#noImageText').hide();
            }
            reader.readAsDataURL(file); // convert to base64 string
        } else {
            $('#previewImage').show();
        }
    });
});
$(document).ready(function() {
    //start code for submit data check rule
    $.validator.addMethod("passwordCheck", function(value, element) {
        if (value != '') {
           return this.optional(element) 
            || /[A-Z]/.test(value) // has an uppercase letter
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value); // has a digit 
        }else{
            return true;
        }
        
    }, "Password must contain at least one uppercase letter, one lowercase letter, and one digit.");
    
    $.validator.addMethod("emailExists", function(value, element) {
        var response = false;
        $.ajax({
            type: "POST",
            url: check_email_url, // URL to your server-side script
            data: { email: value, user_id: $('#user_id').val() },
            dataType: "json",
            async: false,
            success: function(data) {
                response = !data.exists;
            }
        });
        return response;
    }, "Email already exists.");
    $.validator.addMethod("usernameExists", function(value, element) {
        var response = false;
        $.ajax({
            type: "POST",
            url: check_user_name_url, // URL to your server-side script
            data: { user_name: value, user_id: $('#user_id').val() },
            dataType: "json",
            async: false,
            success: function(data) {
                response = !data.exists;
            }
        });
        return response;
    }, "User Name already exists.");
    $('#user_edit_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });

    $('#user_edit_form').validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            DOB: {
                required: true
            },
            DOJ: {
                required: true
            },
            new_password: {
                passwordCheck: true
            }
        },
        messages: {
            email: {
                required: "Please provide Email!",
                email: "Enter valid email!"
            },
            first_name: {
                required: "Please provide first name!"
            },
            last_name: {
                required: "Please provide last name!"
            },
            user_name: {
                required: "Please provide user name!"
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "location") {
                error.appendTo(".location_error_message");
            }else if (element.attr("name") == "severity_level") {
                error.appendTo(".severity_level_error_message");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});