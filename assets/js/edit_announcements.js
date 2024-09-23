$(document).ready(function() {
    document.querySelectorAll('.editor').forEach((element) => {
        CKEDITOR.replace(element, {
            extraPlugins: 'scayt',
            scayt_autoStartup: true,
            disallowedContent: 'footer; body; p'
        });
    });
    CKEDITOR.config.extraPlugins = 'colorbutton';
    // Configure the CKEditor toolbar globally
    CKEDITOR.config.toolbar = [{
        name: 'editor',
        items: ['Scayt', 'Bold', 'Italic', 'Underline', 'Styles', 'TextColor', 'BGColor']
    }];
    //start code for attach file in 1
        var old_image1 = $('#old_image1').val(); // Hidden input to store file info
        var fileExtension = old_image1.split('.').pop().toLowerCase(); // Extract the file extension

        if (old_image1) {
            switch (fileExtension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    $('#previewImage1').attr('src', asset_base_url + 'images/announcements/' + old_image1).show();
                    $('#noImageText1').hide();
                    $('#filePreview1').hide();
                    $('#videoPreview1').hide();
                    break;

                case 'pdf':
                case 'xls':
                case 'xlsx':
                case 'txt':
                case 'doc':
                case 'docx':
                    $('#previewImage1').hide();
                    $('#noImageText1').hide();
                    $('#filePreview1').html('<a href="'+ asset_base_url +'images/announcements/' + old_image1 + '" target="_blank">View ' + fileExtension.toUpperCase() + ' file</a>').show();
                    $('#videoPreview1').hide();
                    break;

                case 'mp4':
                case 'webm':
                case 'ogg':
                    var videoUrl = asset_base_url + 'images/announcements/' + old_image1;
                    $('#previewImage1').hide();
                    $('#noImageText1').hide();
                    $('#filePreview1').hide();
                    $('#videoPreview1').html('<video width="320" height="240" controls><source src="' + videoUrl + '" type="video/' + fileExtension + '">Your browser does not support the video tag.</video>').show();
                    break;
            }
        } else {
            $('#previewImage1').hide();
            $('#filePreview1').hide();
            $('#videoPreview1').hide();
        }
        var old_image2 = $('#old_image2').val(); // Hidden input to store file info
        var fileExtension = old_image2.split('.').pop().toLowerCase(); // Extract the file extension

        if (old_image2) {
            switch (fileExtension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    $('#previewImage2').attr('src', asset_base_url + 'images/announcements/' + old_image2).show();
                    $('#noImageText2').hide();
                    $('#filePreview2').hide();
                    $('#videoPreview2').hide();
                    break;

                case 'pdf':
                case 'xls':
                case 'xlsx':
                case 'txt':
                case 'doc':
                case 'docx':
                    $('#previewImage2').hide();
                    $('#noImageText2').hide();
                    $('#filePreview2').html('<a href="'+ asset_base_url +'images/announcements/' + old_image2 + '" target="_blank">View ' + fileExtension.toUpperCase() + ' file</a>').show();
                    $('#videoPreview2').hide();
                    break;

                case 'mp4':
                case 'webm':
                case 'ogg':
                    var videoUrl = asset_base_url + 'images/announcements/' + old_image2;
                    $('#previewImage2').hide();
                    $('#noImageText2').hide();
                    $('#filePreview2').hide();
                    $('#videoPreview2').html('<video width="320" height="240" controls><source src="' + videoUrl + '" type="video/' + fileExtension + '">Your browser does not support the video tag.</video>').show();
                    break;
            }
        } else {
            $('#previewImage2').hide();
            $('#filePreview2').hide();
            $('#videoPreview2').hide();
        }
        var old_image3 = $('#old_image3').val(); // Hidden input to store file info
        var fileExtension = old_image3.split('.').pop().toLowerCase(); // Extract the file extension

        if (old_image3) {
            switch (fileExtension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    $('#previewImage3').attr('src', asset_base_url + 'images/announcements/' + old_image3).show();
                    $('#noImageText3').hide();
                    $('#filePreview3').hide();
                    $('#videoPreview3').hide();
                    break;

                case 'pdf':
                case 'xls':
                case 'xlsx':
                case 'txt':
                case 'doc':
                case 'docx':
                    $('#previewImage3').hide();
                    $('#noImageText3').hide();
                    $('#filePreview3').html('<a href="'+ asset_base_url +'images/announcements/' + old_image3 + '" target="_blank">View ' + fileExtension.toUpperCase() + ' file</a>').show();
                    $('#videoPreview3').hide();
                    break;

                case 'mp4':
                case 'webm':
                case 'ogg':
                    var videoUrl = asset_base_url + 'images/announcements/' + old_image3;
                    $('#previewImage3').hide();
                    $('#noImageText3').hide();
                    $('#filePreview3').hide();
                    $('#videoPreview3').html('<video width="320" height="240" controls><source src="' + videoUrl + '" type="video/' + fileExtension + '">Your browser does not support the video tag.</video>').show();
                    break;
            }
        } else {
            $('#previewImage3').hide();
            $('#filePreview3').hide();
            $('#videoPreview3').hide();
        }
    //start code for attach file in 2
    $('#attachment1').change(function(event) {
        var input = event.target;
        var file = input.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (file) {
            // Get file extension
            var fileExtension = file.name.split('.').pop().toLowerCase();

            // Valid file extensions
            var validFileExtensions = ['xls', 'xlsx', 'pdf', 'txt', 'doc', 'docx', 'mp4', 'webm', 'ogg', 'jpg', 'jpeg', 'png', 'gif'];

            // Validate file extension
            if ($.inArray(fileExtension, validFileExtensions) < 0) {
                Swal.fire({
                    icon: "info",
                    title: "Invalid file type",
                    text: "Only images, PDFs, text, Word, Excel, and video files are allowed. Please select a valid file!"
                });
                input.value = ''; // Clear the input
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                Swal.fire({
                    icon: "warning",
                    title: "Upload Limit Reached",
                    text: "You can only upload files with a maximum size of " + (maxSize / (1024 * 1024)) + " MB."
                });
                input.value = ''; // Clear the input
                return;
            }

            // If valid, handle file preview or file links
            switch (fileExtension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage1').attr('src', e.target.result).show();
                        $('#noImageText1').hide();
                        $('#filePreview1').hide();
                        $('#videoPreview1').hide();
                    }
                    reader.readAsDataURL(file); // convert to base64 string for image preview
                    break;

                case 'pdf':
                case 'xls':
                case 'xlsx':
                case 'txt':
                case 'doc':
                case 'docx':
                    $('#previewImage1').hide();
                    $('#noImageText1').hide();
                    $('#filePreview1').html('<a href="' + URL.createObjectURL(file) + '" target="_blank">View ' + fileExtension.toUpperCase() + ' file</a>').show();
                    $('#videoPreview1').hide();
                    break;

                case 'mp4':
                case 'webm':
                case 'ogg':
                    var videoUrl = URL.createObjectURL(file);
                    $('#previewImage1').hide();
                    $('#noImageText1').hide();
                    $('#filePreview1').hide();
                    $('#videoPreview1').html('<video width="320" height="240" controls><source src="' + videoUrl + '" type="video/' + fileExtension + '">Your browser does not support the video tag.</video>').show();
                    break;
            }
        } else {
            $('#previewImage1').hide();
            $('#filePreview1').hide();
            $('#videoPreview1').hide();
        }
    });
    $('#attachment2').change(function(event) {
        var input = event.target;
        var file = input.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (file) {
            // Get file extension
            var fileExtension = file.name.split('.').pop().toLowerCase();

            // Valid file extensions
            var validFileExtensions = ['xls', 'xlsx', 'pdf', 'txt', 'doc', 'docx', 'mp4', 'webm', 'ogg', 'jpg', 'jpeg', 'png', 'gif'];

            // Validate file extension
            if ($.inArray(fileExtension, validFileExtensions) < 0) {
                Swal.fire({
                    icon: "info",
                    title: "Invalid file type",
                    text: "Only images, PDFs, text, Word, Excel, and video files are allowed. Please select a valid file!"
                });
                input.value = ''; // Clear the input
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                Swal.fire({
                    icon: "warning",
                    title: "Upload Limit Reached",
                    text: "You can only upload files with a maximum size of " + (maxSize / (1024 * 1024)) + " MB."
                });
                input.value = ''; // Clear the input
                return;
            }

            // If valid, handle file preview or file links
            switch (fileExtension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage2').attr('src', e.target.result).show();
                        $('#noImageText2').hide();
                        $('#filePreview2').hide();
                        $('#videoPreview2').hide();
                    }
                    reader.readAsDataURL(file); // convert to base64 string for image preview
                    break;

                case 'pdf':
                case 'xls':
                case 'xlsx':
                case 'txt':
                case 'doc':
                case 'docx':
                    $('#previewImage2').hide();
                    $('#noImageText2').hide();
                    $('#filePreview2').html('<a href="' + URL.createObjectURL(file) + '" target="_blank">View ' + fileExtension.toUpperCase() + ' file</a>').show();
                    $('#videoPreview2').hide();
                    break;

                case 'mp4':
                case 'webm':
                case 'ogg':
                    var videoUrl = URL.createObjectURL(file);
                    $('#previewImage2').hide();
                    $('#noImageText2').hide();
                    $('#filePreview2').hide();
                    $('#videoPreview2').html('<video width="320" height="240" controls><source src="' + videoUrl + '" type="video/' + fileExtension + '">Your browser does not support the video tag.</video>').show();
                    break;
            }
        } else {
            $('#previewImage2').hide();
            $('#filePreview2').hide();
            $('#videoPreview2').hide();
        }
    });
    $('#attachment3').change(function(event) {
        var input = event.target;
        var file = input.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB in bytes

        if (file) {
            // Get file extension
            var fileExtension = file.name.split('.').pop().toLowerCase();

            // Valid file extensions
            var validFileExtensions = ['xls', 'xlsx', 'pdf', 'txt', 'doc', 'docx', 'mp4', 'webm', 'ogg', 'jpg', 'jpeg', 'png', 'gif'];

            // Validate file extension
            if ($.inArray(fileExtension, validFileExtensions) < 0) {
                Swal.fire({
                    icon: "info",
                    title: "Invalid file type",
                    text: "Only images, PDFs, text, Word, Excel, and video files are allowed. Please select a valid file!"
                });
                input.value = ''; // Clear the input
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                Swal.fire({
                    icon: "warning",
                    title: "Upload Limit Reached",
                    text: "You can only upload files with a maximum size of " + (maxSize / (1024 * 1024)) + " MB."
                });
                input.value = ''; // Clear the input
                return;
            }

            // If valid, handle file preview or file links
            switch (fileExtension) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage3').attr('src', e.target.result).show();
                        $('#noImageText3').hide();
                        $('#filePreview3').hide();
                        $('#videoPreview3').hide();
                    }
                    reader.readAsDataURL(file); // convert to base64 string for image preview
                    break;

                case 'pdf':
                case 'xls':
                case 'xlsx':
                case 'txt':
                case 'doc':
                case 'docx':
                    $('#previewImage3').hide();
                    $('#noImageText3').hide();
                    $('#filePreview3').html('<a href="' + URL.createObjectURL(file) + '" target="_blank">View ' + fileExtension.toUpperCase() + ' file</a>').show();
                    $('#videoPreview3').hide();
                    break;

                case 'mp4':
                case 'webm':
                case 'ogg':
                    var videoUrl = URL.createObjectURL(file);
                    $('#previewImage3').hide();
                    $('#noImageText3').hide();
                    $('#filePreview3').hide();
                    $('#videoPreview3').html('<video width="320" height="240" controls><source src="' + videoUrl + '" type="video/' + fileExtension + '">Your browser does not support the video tag.</video>').show();
                    break;
            }
        } else {
            $('#previewImage3').hide();
            $('#filePreview3').hide();
            $('#videoPreview3').hide();
        }
    });
});
$('#announcements_add_form').validate({
    debug: false,
    ignore: [],
    rules: {
        header: {
            required: true
        },
        date: {
            required: true
        },
        Content: {
            required: function() {
                // Use CKEditor content for validation
                CKEDITOR.instances['Content'].updateElement();
                return CKEDITOR.instances['Content'].getData() == '';
            }
        }
    },
    messages: {
        header: {
            required: "Please add header!"
        },
        date: {
            required: "Please Select date!"
        },
        Content: {
            required: "Please provide Content!"
        }
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "Content") {
            error.appendTo(".Content_error_message");
        }else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        $('#submit').prop('disabled', true);
        $('#submit').val('Submitting...');
        form.submit();
    }
});