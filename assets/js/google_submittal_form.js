$(document).ready(function() {
    //start code for submit data check rule
    $('#issue_submittal_form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            location: {
                required: true
            },
            severity_level: {
                required: true
            },
            company_name: {
                required: true
            },
            description_defective_product: {
                required: true
            },
            description_issue: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please provide Email!",
                email: "Enter valid email!"
            },
            location: {
                required: "Please select location!"
            },
            severity_level: {
                required: "Please select severity level!"
            },
            company_name: {
                required: "Please provide company name!"
            },
            description_defective_product: {
                required: "Please provide Description of defective product!"
            },
            description_issue: {
                required: "Please provide Description of issue!"
            },
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