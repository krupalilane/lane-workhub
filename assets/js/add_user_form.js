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
        return this.optional(element) 
            || /[A-Z]/.test(value) // has an uppercase letter
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value); // has a digit
    }, "Password must contain at least one uppercase letter, one lowercase letter, and one digit.");
    
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
    $.validator.addMethod("usernameExists", function(value, element) {
        var response = false;
        $.ajax({
            type: "POST",
            url: check_user_name_url, // URL to your server-side script
            data: { user_name: value },
            dataType: "json",
            async: false,
            success: function(data) {
                response = !data.exists;
            }
        });
        return response;
    }, "User Name already exists.");
    $('#user_add_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });

    $('#user_add_form').validate({
        rules: {
            email: {
                required: true,
                email: true,
                emailExists: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            user_name: {
                required: true,
                usernameExists: true
            },
            password: {
                required: true,
                passwordCheck: true
            },
            DOB: {
                required: true
            },
            DOJ: {
                required: true
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
            },
            password: {
                required: "Please provide password!"
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
$(document).ready(function(){
    // When a checkbox with class 'site_permission_list' is clicked
    $('.site_permission_list').on('click', function() {
        // Get the data-id from the clicked checkbox to match the corresponding select element
        var key = $(this).data('id');
        
        // Check if the checkbox is checked
        if ($(this).is(':checked')) {
            // Set the value of the select element with the corresponding id to '2' (View)
            $('#site_permission_role' + key).val('2');
        } else {
            // If unchecked, reset the select element to default value '0' (Select Permission)
            $('#site_permission_role' + key).val('0');
        }
    });
});
$(document).ready(function() {
    // Iterate over each checkbox with class 'site_permission_list'
    $('.site_permission_list').each(function() {
        // Get the checkbox ID
        var id = $(this).attr('id');
        var key = $(this).data('id');
        
        // Initially set the select and favorite fields based on the checkbox state
        toggleFields(key, $(this).is(':checked'));

        // Attach change event to toggle fields based on checkbox state
        $(this).change(function() {
            toggleFields(key, $(this).is(':checked'));
        });
    });

    // Function to enable/disable fields
    function toggleFields(key, isChecked) {
        if (isChecked) {
            // Enable the select and favorite checkbox
            $('#site_permission_role' + key).prop('disabled', false);
            $('#site_permission_role' + key).removeAttr('readonly'); // In case readonly was set
            $('#favorite'+key).prop('disabled', false);
            $('#site_permission_role' + key).val(2);
            // Enable star icon
            $('#favorite' + key).next('.fa-star').removeClass('disabled-star');
        } else {
            // Disable the select and favorite checkbox
            $('#site_permission_role' + key).prop('disabled', true);
            $('#site_permission_role' + key).attr('readonly', true); // Optional if readonly needs to be maintained
            $('#favorite'+key).prop('disabled', true).prop('checked', false);
            $('#favorite' + key).next('.fa-star').addClass('disabled-star');
            $('#site_permission_role' + key).val(2);
        }
    }
});