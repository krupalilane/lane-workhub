$(document).ready(function() {
    var plant_name   = $('#plant_name').val();
    var year        = $('#year').val();
    get_plants_details(plant_name,year);
    $('#plant_name').change(function() {
       var plant_name   = $(this).val();
       var year        = $('#year').val();
       get_plants_details(plant_name,year);
    });
    $('#year').change(function() {
       var plant_name   = $('#plant_name').val();
       var year        = $(this).val();
       get_plants_details(plant_name,year);
    });
});
function get_plants_details(plant_name,year) {
    $("#overlay").fadeIn(300);　
    $.ajax({
        url : get_plants_details_url,
        type: "POST",
        data: {"plant_name":plant_name,'year':year},
         success : function(data){
            var thead = '';
            thead += '<tr>';
            thead += '<th class="text-center" rowspan="3"></th>';
                $( data.year ).each(function( index,value ) {
                    thead += '<th class="text-center category_font" colspan="8"><b>'+value+'</b></th>';
                });
            thead += '</tr>';
            thead += '<tr>';
                for(var i = 1; i <= data.year.length; i++){
                    thead += '<th class="text-center category_font" colspan="2"><b>Q1</b></th>';
                    thead += '<th class="text-center category_font" colspan="2"><b>Q2</b></th>';
                    thead += '<th class="text-center category_font" colspan="2"><b>Q3</b></th>';
                    thead += '<th class="text-center category_font" colspan="2"><b>Q4</b></th>';
                }
            thead += '</tr>';
            thead += '<tr>';
                for(var i = 1; i <= data.year.length; i++){
                    thead += '<th class="text-center">Actual</th>';
                    thead += '<th class="text-center">Plan</th>';
                    thead += '<th class="text-center">Actual</th>';
                    thead += '<th class="text-center">Plan</th>';
                    thead += '<th class="text-center">Actual</th>';
                    thead += '<th class="text-center">Plan</th>';
                    thead += '<th class="text-center">Actual</th>';
                    thead += '<th class="text-center">Plan</th>';
                }
            thead += '</tr>'; 
            $('#plants_thead').html(thead);
            var tbody = '';
            $.each(data.plant_details, function(category, items) {
                var showCategory = true;  // Flag to check if category row should be shown
                $.each(items, function(sub_category, sub_cate_item) {
                    if (category !== sub_category) {
                        if (showCategory) {
                            var subCateItemLength = Object.keys(sub_cate_item).length;
                            tbody += '<tr>';
                            tbody += '<td class="plan-td-no-wrap category_font"><b>'+category+'</b></td>';
                            tbody += '<td class="plan-td-no-wrap" colspan="'+subCateItemLength+'"></td>';
                            tbody += '</tr>';
                            showCategory = false;  // Category row has been added, no need to add again
                        }
                        tbody += '<tr>';
                        tbody += '<td class="plan-td-no-wrap sub_category_font">'+sub_category+'</td>';
                        $.each(sub_cate_item, function(key, value) {
                            var number_data     = value.Value;
                            var number_value    = number_data.replace(/[$%,]/g, "");
                            tbody += '<td class="edit_plan_detail_button" data-id="'+value.ID+'" data-category="'+category+'" data-subcategory="'+sub_category+'" data-planned_actual="'+value.Planned_Actual+'" data-quarter="'+value.Quarter+'" data-year="'+value.Year+'" data-value="'+number_value+'">'+value.Value+'</td>';
                        });
                        tbody += '</tr>';
                    } else {
                        tbody += '<tr>';
                        tbody += '<td class="plan-td-no-wrap category_font"><b>'+sub_category+'</b></td>';
                        $.each(sub_cate_item, function(key, value) {
                            var number_data     = value.Value;
                            var number_value    = number_data.replace(/[$%,]/g, "");
                            tbody += '<td class="edit_plan_detail_button" data-id="'+value.ID+'" data-category="'+sub_category+'" data-subcategory="'+sub_category+'" data-planned_actual="'+value.Planned_Actual+'" data-quarter="'+value.Quarter+'" data-year="'+value.Year+'" data-value="'+number_value+'">'+value.Value+'</td>';
                        });
                        tbody += '</tr>';
                    }
                });
            });

            $('#plants_tbody').html(tbody);
            $("#overlay").fadeOut(300);
        }
    });
}

$(document).on('click', '.edit_plan_detail_button', function(e) {
    var id              = $(this).data('id');
    var category        = $(this).data('category');
    var subcategory     = $(this).data('subcategory');
    var year            = $(this).data('year');
    var planned_actual  = $(this).data('planned_actual');
    var quarter         = $(this).data('quarter');
    var plan_value      = $(this).data('value');
    var plant_name      = $('#plant_name').val();
    $('#edit_plan_division').val(plant_name);
    $('#edit_plan_category').val(category);
    $('#edit_plan_sub_category').val(subcategory);
    $('#edit_plan_year').val(year);
    $('#edit_plan_quarter').val(quarter);
    $('#edit_plan_actual').val(planned_actual);
    $('#edit_plan_value').val(plan_value);
    $('#edit_plan_id').val(id);
    $('#edit_plan_details_modal').modal('show');
});
$('#export_plan_excel').on('click', function(e) {
    e.preventDefault(); 
    $("#overlay").fadeIn(300);

    // Gather the year field data (assuming you have a way to get this data)
    var year = $('#year').val(); // Adjust the selector to your actual year input field

    // Create a form and submit it to handle file download
    var form = $('<form>', {
        method: 'POST',
        action: export_excle_plants_url
    }).append($('<input>', {
        type: 'hidden',
        name: 'year',
        value: year
    }));

    // Append form to body and submit it
    $('body').append(form);
    form.submit();
    // Hide overlay after submission (not immediately but after the form is submitted)
    setTimeout(function() {
        $("#overlay").fadeOut(300);
    }, 65000); // Adjust delay if necessary
});
// Adding the custom 'decimal' validation method
$.validator.addMethod('decimal', function(value, element) {
    return this.optional(element) || /^(\d+|\d*\.\d{1,2})$/.test(value);
}, 'Please enter a valid number with up to two decimal places.');

// Initialize validation on the form
$("#edit_plants_form").validate({
    rules: {
        edit_plan_value: {
            required: true,
            decimal: true // Apply the custom 'decimal' validation
        }
    },
    messages: {
        edit_plan_value: {
            required: "This field is required",
            decimal: "Please enter a valid number with up to two decimal places."
        }
    },
    submitHandler: function(form) {
        // Handle form submission via AJAX
        $.ajax({
            url: $(form).attr('action'),
            type: $(form).attr('method'),
            data: $(form).serialize(),
            success: function(response) {
                $('#edit_plan_details_modal').modal('hide');
                var plant_name   = $('#plant_name').val();
                var year        = $('#year').val();
                get_plants_details(plant_name,year);
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('An error occurred: ' + error);
            }
        });
    }
});
$("#EditplanButton").on('click', function() {
    if ($("#edit_plants_form").valid()) {
        $("#edit_plants_form").submit(); // Submit form if valid
    }
});