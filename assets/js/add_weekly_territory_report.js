    $(document).ready(function() {
    $('#add_weekly_form').submit(function(e) {
        $('input[type=text]').each(function() {
          $(this).val($.trim($(this).val()));
        });
    });
    document.querySelectorAll('.editor').forEach((element) => {
        CKEDITOR.replace(element, {
            extraPlugins: 'scayt',
            scayt_autoStartup: true,
            disallowedContent: 'footer; body; p'
        });
    });

    // Configure the CKEditor toolbar globally
    CKEDITOR.config.toolbar = [{
        name: 'editor',
        items: ['Scayt']
    }];
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
    // CKEDITOR.replace('editor', {
    //     extraPlugins: 'scayt',
    //     scayt_autoStartup: true,
    //     on: {
    //         instanceReady: function(evt) {
    //             $('.banner-class').hide(); // Adjust the selector based on actual usage
    //         }
    //     }
    // });
    $.validator.addMethod("check_ck_add_method",
        function (value, element) {
            return check_ck_editor();
        });

    function check_ck_editor() {
        alert('yes');
        if (CKEDITOR.instances.content_body.getData() == '') {
            return false;
        }
        else {
            $("#error_check_editor").empty();
            return true;
        }
    }
    $('#add_weekly_form').validate({
        debug: false,
        ignore: [],
        rules: {
            WeekEnding: {
                required: true
            },
            Name: {
                required: true
            },
            GeneralOverview: {
               required: function() {
                   // Use CKEditor content for validation
                   CKEDITOR.instances['GeneralOverview'].updateElement();
                   return CKEDITOR.instances['GeneralOverview'].getData() == '';
               }
            },
            GoalforthisWeek: {
                required: function() {
                    // Use CKEditor content for validation
                    CKEDITOR.instances['GoalforthisWeek'].updateElement();
                    return CKEDITOR.instances['GoalforthisWeek'].getData() == '';
                }
            },
            NextWeekPlansGoals: {
                required: function() {
                    // Use CKEditor content for validation
                    CKEDITOR.instances['NextWeekPlansGoals'].updateElement();
                    return CKEDITOR.instances['NextWeekPlansGoals'].getData() == '';
                }
            },
            CompetitiveInsights: {
                required: function() {
                    // Use CKEditor content for validation
                    CKEDITOR.instances['CompetitiveInsights'].updateElement();
                    return CKEDITOR.instances['CompetitiveInsights'].getData() == '';
                }
            }
        },
        messages: {
            WeekEnding: {
                required: "Please select Week Ending!"
            },
            Name: {
                required: "Please provide name!"
            },
            GeneralOverview: {
                required: "Please provide General Overview!"
            },
            GoalforthisWeek: {
                required: "Please provide Goal for this Week!"
            },
            NextWeekPlansGoals: {
                required: "Please provide Next Week Plans Goals!"
            },
            CompetitiveInsights: {
                required: "Please provide Competitive Insights!"
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "GeneralOverview") {
                error.appendTo(".GeneralOverview_error_message");
            }else if (element.attr("name") == "GoalforthisWeek") {
                error.appendTo(".GoalforthisWeek_error_message");
            }else if (element.attr("name") == "NextWeekPlansGoals") {
                error.appendTo(".NextWeekPlansGoals_error_message");
            }else if (element.attr("name") == "CompetitiveInsights") {
                error.appendTo(".CompetitiveInsights_error_message");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('#submit').prop('disabled', true);
            $('#submit').val('Submitting...');
            form.submit();
        }
    });
});