jQuery(document).ready(function () {
  ImgUpload();
});

var imgArray = [];

function ImgUpload() {
  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      var imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = parseInt($(this).attr('data-max_length'));

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);

      filesArr.forEach(function (f) {
        if (!f.type.match('image.*')) {
          Swal.fire({
            icon: "info",
            title: "No valid images were uploaded.",
            text: "Only images are allowed. Please select an image!"
          });
          return;
        }

        if (imgArray.length >= maxLength) {
          Swal.fire({
            icon: "warning",
            title: "Upload Limit Reached",
            text: "You can only upload a maximum of " + maxLength + " images."
          });
          return false;
        } else {
          imgArray.push(f);

          var reader = new FileReader();
          reader.onload = function (e) {
            var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
            imgWrap.append(html);
          };
          reader.readAsDataURL(f);
        }
      });

      // Update the hidden input with the list of selected files
      updateHiddenInput();
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();

    // Update the hidden input after removing a file
    updateHiddenInput();
  });
}

function updateHiddenInput() {
  var dataTransfer = new DataTransfer();
  
  // Append all files from imgArray to DataTransfer object
  imgArray.forEach(function (file) {
    dataTransfer.items.add(file);
  });

  // Set the files property of the input element
  $('.upload__inputfile')[0].files = dataTransfer.files;
}
$(document).ready(function(){
  var i = 1;
  $('#add_more_product').click(function() {
    var lastRow = $('#dynamic_field tbody tr:last');
    var allFieldsFilled = true;
    // Check if all select fields in the last row are filled
    lastRow.children('td').each(function() {
      var selectElement = $(this).find('select');
      if (selectElement.length > 0 && selectElement.val() === '') {
        allFieldsFilled = false;
        selectElement.css('border', '1px solid red');
      } else {
        selectElement.css('border', '');
      }
    });

     // If all fields are filled, check for duplicates
    if (allFieldsFilled) {
      if (!checkForDuplicates()) {
        Swal.fire({
          icon: "info",
          title: "Duplicate Record",
          text: "A duplicate product row has been found. Please ensure all the rows have unique selections."
        });
        return;
      }

      i++;
      $('#dynamic_field tbody').append('<tr id="row'+i+'">'+
        '<td><select class="form-control dropdown_location product_location add_more_validation" data-rowid="'+i+'" id="location_'+i+'" name="location[]">'+locationOptions+'</select></td>'+
        '<td><select class="form-control lane-dropdown add_more_validation" name="line_number_and_name[]" id="line_number_and_name_'+i+'"></select></td>'+
        '<td><select class="form-control add_more_validation" id="product_diameter_'+i+'" name="product_diameter[]">'+diameterOptions+'</select></td>'+
        '<td><select class="form-control add_more_validation" id="_'+i+'" name="product_flavour[]">'+flavourOptions+'</select></td>'+
        '<td><select class="form-control add_more_validation" id="product_flavour_'+i+'" name="product_length[]">'+lengthOptions+'</select></td>'+
        '<td><select class="form-control add_more_validation" id="product_type_'+i+'" name="product_type[]">'+typeOptions+'</select></td>'+
        '<td><select class="form-control add_more_validation" id="bell_type_'+i+'" name="bell_type[]">'+bellTypeOptions+'</select></td>'+
        '<td><select class="form-control add_more_validation" id="product_perf_'+i+'" name="product_perf[]">'+perfOptions+'</select></td>'+
        '<td><select class="form-control" id="product_shift_'+i+'" name="product_shift[]">'+shiftOptions+'</select></td>'+
        '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button></td>'+
      '</tr>');

      var location = $('#location_'+i).val();
      addlanedetails(i, location);
      get_selected_location();
      $('#add_more_product').prop('disabled', false); // Re-enable button
    } else {
      Swal.fire({
        icon: "info",
        title: "Oops...",
        text: "Please fill all required fields in the previous row before adding a new one."
      });
      $('#add_more_product').prop('disabled', true); // Disable button if error
    }
  });
  var j = 1;
  $('#add_more_fitting_description').click(function() {
    var validation = check_fitting_validation();
    if (validation == true) {
      j++;
      $('#fitting_dynamic_field tbody').append('<tr id="row'+j+'">'+
        '<td width="15%"><select class="form-control fitting_add_more_validation dropdown_location" data-rowid="'+j+'" id="fabrication_location_'+j+'" name="FabricationLocation[]">'+locationOptions+'</select></td>'+
        '<td width="15%"><select readonly disabled class="form-control lane-dropdown"><option value="Fabrication">Fabrication</option></select></td>'+
        '<td><textarea class="form-control fitting_add_more_validation" name="FittingDescription[]" id="FittingDescription_'+j+'"></textarea></td>'+
        '<td width="5%"><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove_fitting"><i class="fa fa-minus"></i></button></td>'+
      '</tr>');
    }
  });
  $(document).on('change', '.fitting_add_more_validation', function() {
    check_fitting_validation();
  });
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
    $('#add_more_product').prop('disabled', false);
    $('#submit').prop('disabled', false);
    get_selected_location();
  });
  $(document).on('click', '.btn_remove_fitting', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
    $('#add_more_fitting_description').prop('disabled', false);
    $('#submit').prop('disabled', false);
    get_selected_location();
  });
  $(document).on('change', '.product_location', function(){
    var rowid     = $(this).data('rowid');
    var location  = $(this).val();
    addlanedetails(rowid,location);
  });
  $(document).on('change', '.dropdown_location', function(){
    var rowid     = $(this).data('rowid');
    var location  = $(this).val();
    get_selected_location();
  });
  $(document).on('change', '.lane-dropdown', function(){
    get_selected_location();
  });

  $('input[type=radio][name=severity_level]').change(function() {
    get_selected_location();
  });
  $(document).on('change', '.add_more_validation', function() {
    check_product_validation();    
  });
});
function addlanedetails(rowid,location) {
  var location_lane = $.parseJSON(lineNumberJson);
  var filteredData = location_lane.filter(function(item) {
    return item.Location === location;
  });
  var option = '';
  if (filteredData.length === 0) {
    option += '<option value="">Select Location first</option>';
  }
  // Append new options to the line number dropdown
  filteredData.forEach(function(item) {
    option += '<option value="' + item.LineNumberAndName + '">' + item.LineNumberAndName + '</option>';
  });
  $('#line_number_and_name_'+rowid).html(option);
  get_selected_location();
}
//start code for genrate associated number
let selections = []; // To store the location-lane pairs
    
// When the user clicks the generate button
function get_selected_location() {
  selections = [];
  // Loop through each location dropdown
  $('.dropdown_location').each(function(index) {
    let location = $(this).val(); // Get the selected location
    // Get the corresponding lane dropdown value based on index
    let lane = $('.lane-dropdown').eq(index).val(); 
    if(location && lane) {
      selections.push(`${location}-${lane}`);
    }
  });
  // Generate the desired pattern
  let pattern = generatePattern(selections);
  // Display the pattern in the result div
  $('#associated_num').val(pattern);
};

function generatePattern(selections) {
  let pattern          = [];
  let locationMap      = {}; // To track lanes by location
  let addedLanes       = new Set(); // To track unique lanes
  let severity_level_val  = $('input[name="severity_level"]:checked').val();
  let severity_level   = 0;

  if (typeof severity_level_val !== "undefined") {
    severity_level = severity_level_val.split('-')[0].trim();
  }

  // Populate the map based on the selections
  selections.forEach(function(selection) {
    let [location, lane] = selection.split('-');

    // Initialize the array for the location if not already set
    if (!locationMap[location]) {
      locationMap[location] = [];
    }

    // Skip duplicate checks if the lane is "fabrication"
    if (lane.trim().toLowerCase() === 'fabrication') {
      locationMap[location].push(lane); // Add the lane without duplicate check
    } else {
      // Add the lane only if it hasn't been added before
      if (!addedLanes.has(lane)) {
        locationMap[location].push(lane);
        addedLanes.add(lane); // Mark this lane as added
      }
    }
  });

  // Construct the final pattern
  for (let location in locationMap) {
    pattern.push(` ${location} - ${locationMap[location].join('- ')}`);
  }

  // Return pattern with severity level if available
  if (typeof severity_level === "undefined") {
    return pattern.join('-');
  } else {
    return pattern.join('-') + ' - ' + severity_level;
  }
}

// Function to check for duplicate rows
function checkForDuplicates() {
  var rowsData = [];
  $('#dynamic_field tbody tr').each(function() {
    var rowData = [];
    $(this).find('select').each(function() {
      rowData.push($(this).val());
    });
    // Convert the rowData array to a string and check if it's already in rowsData
    var rowString = rowData.join('|');
    if (rowsData.includes(rowString)) {
      return false; // Duplicate found
    }
    rowsData.push(rowString);
  });
  if ($('#dynamic_field tbody tr').length == rowsData.length) {
    return true;
  }else{
    return false;
  }
}
function checkForDuplicatesFitting() {
  var rowsData = [];
  $('#fitting_dynamic_field tbody tr').each(function() {
    var rowData = [];
    $(this).find('select').each(function() {
      rowData.push($(this).val());
    });
    // Convert the rowData array to a string and check if it's already in rowsData
    var rowString = rowData.join('|');
    if (rowsData.includes(rowString)) {
      return false; // Duplicate found
    }
    rowsData.push(rowString);
  });
  if ($('#fitting_dynamic_field tbody tr').length == rowsData.length) {
    return true;
  }else{
    return false;
  }
}
$(document).ready(function() {
  $('#add_complaint_form').validate({
    rules: {
      date_submit: {
        required: true
      },
      associated_num: {
        required: true
      },
      complaint_category: {
        required: true
      },
      location_submitting: {
        required: true
      },
      date_issue: {
        required: true
      },
      severity_level: {
        required: true
      },
      next_step: {
        required: true
      },
      how_failure: {
        required: true
      },
      complaint_summary: {
        required: true
      },
      
    },
    messages: {
      date_submit: {
        required: "Please select date submit!"
      },
      associated_num: {
        required: "Please select location and line details!"
      },
      complaint_category: {
          required: "Please select complaint category!"
      },
      location_submitting: {
        required: "Please select location submitting!"
      },
      date_issue: {
        required: "Please select date of issue/occurrence!"
      },
      severity_level: {
        required: "Please select severity level!"
      },
      next_step: {
        required: "Please add details for next steps taken!"
      },
      how_failure: {
        required: "Please add details for how was failure / nonconformance identified?"
      },
      complaint_summary: {
        required: "Please add details for complaint summary!"
      },
        
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "location_submitting") {
            error.appendTo(".location_submitting_error_message");
        }else if (element.attr("name") == "severity_level") {
            error.appendTo(".severity_level_error_message");
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
      var perform_val = perform_validation();
      if (perform_val == true) {
        var complaint_duplicat_check = complaimt_duplicat_check($(form).serialize());
        if (complaint_duplicat_check == true) {
          $('#submit').prop('disabled', true);
          $('#submit').val('Submitting...');
          form.submit();
        }else{
          Swal.fire({
            icon: "info",
            title: "Duplicate Record",
            text: "A duplicate complaint has been found. Please ensure all the complaints are unique."
          });
        }
      }      
    }
  });
});
function complaimt_duplicat_check(form_data) {
  var response = true;
  $.ajax({
      type: "POST",
      url: check_duplicate_complaint_url, // URL to your server-side script
      data: form_data,
      dataType: "json",
      async: false,
      success: function(data) {
          response = data.duplicate;
      }
  });
  return response;
}
function perform_validation() {
  var productDataFilled = false;
  var fittingDataFilled = false;

  // Check if any product field is filled
  $('.add_more_validation').each(function() {
    if ($(this).val() !== '') {
      productDataFilled = true;
    }
  });

  // Check if any fitting field is filled
  $('.fitting_add_more_validation').each(function() {
    if ($(this).val() !== '') {
      fittingDataFilled = true;
    }
  });

  // If neither product nor fitting data is filled, show an alert
  if (!productDataFilled && !fittingDataFilled) {
    Swal.fire({
      icon: "warning",
      title: "Validation Error",
      text: "You must fill out either product or fitting data completely!"
    });
    return false;
  }
  // If product data is filled, validate product fields
  var productValid = productDataFilled ? check_product_validation() : true;

  // If fitting data is filled, validate fitting fields
  var fittingValid = fittingDataFilled ? check_fitting_validation() : true;

  // Return true only if both validations pass
  return productValid && fittingValid;
}
function check_fitting_validation() {
  var fittingAllFieldsFilled = true;
  // Perform full fitting validation if any field is filled
  $('.fitting_add_more_validation').each(function() {
    if ($(this).val() === '') {
      $(this).css('border', '1px solid red'); // Add red border if not filled
      fittingAllFieldsFilled = false;
    } else {
      $(this).css('border', ''); // Remove border if filled
    }
  });

  // Check for duplicate fitting entries
  if (!checkForDuplicatesFitting()) {
    Swal.fire({
      icon: "info",
      title: "Duplicate Record",
      text: "A duplicate fitting location has been selected."
    });
    $('#add_more_fitting_description').prop('disabled', !fittingAllFieldsFilled);
    $('#submit').prop('disabled', !fittingAllFieldsFilled);
    return false;
  }

  // Enable/disable buttons based on validation
  $('#add_more_fitting_description').prop('disabled', !fittingAllFieldsFilled);
  $('#submit').prop('disabled', !fittingAllFieldsFilled);
  return fittingAllFieldsFilled;
}

function check_product_validation() {
  var productAllFieldsFilled = true;
  var anyProductFieldFilled = false;

  // Check if any .add_more_validation field is filled
  $('.add_more_validation').each(function() {
    if ($(this).val() !== '') {
      anyProductFieldFilled = true; // If any field is filled, we trigger full validation for product
    }
  });

  // If no product field is filled, skip product validation
  if (!anyProductFieldFilled) {
    return true; // Skip product validation if no field is filled
  }

  // Perform full product validation if any field is filled
  $('.add_more_validation').each(function() {
    if ($(this).val() === '') {
      $(this).css('border', '1px solid red'); // Add red border if not filled
      productAllFieldsFilled = false;
    } else {
      $(this).css('border', ''); // Remove border if filled
    }
  });

  // Check for duplicate product entries
  if (!checkForDuplicates()) {
    Swal.fire({
      icon: "info",
      title: "Duplicate Record",
      text: "A duplicate product row has been found. Please ensure all rows have unique selections."
    });
    $('#add_more_product').prop('disabled', !productAllFieldsFilled);
    $('#submit').prop('disabled', !productAllFieldsFilled);
    return false;
  }

  // Enable/disable buttons based on validation
  $('#add_more_product').prop('disabled', !productAllFieldsFilled);
  $('#submit').prop('disabled', !productAllFieldsFilled);
  return productAllFieldsFilled;
}