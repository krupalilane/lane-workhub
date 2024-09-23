$(document).ready(function() {
    // Get initial plant value and load categories
    var plant = $('#plant').val();
    if (plant) {
        get_categories(plant, function() {
            // After categories are loaded, get the initial category value and load subcategories
            var category = $('#category').val();
            if (category) {
                get_sub_categories(plant, category);
            }
        });
    }

    // Change event for plant selection
    $('#plant').change(function() {
        var plant = $(this).val();
        get_categories(plant, function() {
            // After categories are reloaded, reset subcategories
            var category = $('#category').val();
            if (category) {
                get_sub_categories(plant, category);
            }
        });
    });

    // Change event for category selection
    $('#category').change(function() {
        var category = $(this).val();
        var plant = $('#plant').val();
        if (plant && category) {
            get_sub_categories(plant, category);
        }
    });
});

function get_categories(plant, callback) {
    $.ajax({
        url: get_category,
        type: "post",
        data: { "plant": plant },
        success: function(data) {
            var option = '';
            $(data).each(function(index, value) {
                option += '<option value="' + value.Category + '">' + value.Category + '</option>';
            });
            $('#category').html(option);
            if (typeof callback === "function") {
                callback();
            }
        }
    });
}

function get_sub_categories(plant, category) {
    $.ajax({
        url: get_sub_category,
        type: "post",
        data: { "plant": plant, "category": category },
        success: function(data) {
            var option = '';
            $(data).each(function(index, value) {
                option += '<option value="' + value.SubCategory + '">' + value.SubCategory + '</option>';
            });
            $('#sub_categories').html(option);
        }
    });
}

$(document).ready(function() {
    $.validator.addMethod('decimal', function(value, element) {
        return this.optional(element) || /^(\d+|\d*\.\d{1,2})$/.test(value);
    }, 'Please enter a valid number with up to two decimal places.');
    //start code for submit data check rule
    $('#plants_add_form').validate({
        rules: {
            plant: {
                required: true
            },
            category: {
                required: true
            },
            sub_categories: {
                required: true
            },
            year: {
                required: true
            },
            quater: {
                required: true
            },
            actual_planned: {
                required: true
            },
            plan_value: {
                required: true,
                decimal: true
            }
        },
        messages: {
            plant: {
                required: "Please select plant!"
            },
            category: {
                required: "Please select category!"
            },
            sub_categories: {
                required: "Please select sub category!"
            },
            year: {
                required: "Please select year!"
            },
            quater: {
                required: "Please select quater!"
            },
            actual_planned: {
                required: "Please select actual planned!"
            },
            plan_value: {
                required: "Please enter value!",
                decimal: "Please enter a valid number."
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "quater") {
                error.appendTo(".quater_error_message");
            }else if (element.attr("name") == "actual_planned") {
                error.appendTo(".actual_planned_error_message");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});