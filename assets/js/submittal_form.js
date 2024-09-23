/* Formatting function for row details - modify as you need */
function format ( d ) {
    var sub_child_row = '<table class="table table-striped table-bordered table-hover dt-responsive display responsive">';
        sub_child_row += '<tbody>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Where was failure found, shipped via Lane Truck? Please provide T-number if yes. :</b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Who found the failure? :</b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Time when failure was found and when was the product produced? :</b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Description of defective product :</b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Description of issue :</b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Complaint Number - Plant Location :</b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Complaint Number - ID :</b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>QA Severity : </b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Category : </b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Root Cause : </b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Corrective Action(s) : </b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Preventative Measures or Resolutions : </b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Date Closed : </b></td>';
                sub_child_row += '<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</td>';
            sub_child_row += '</tr>';
        sub_child_row += '</tbody>';
    sub_child_row += '</table>';
    return sub_child_row;
}
$(document).ready(function() {
    var table = $('#submittal_form_tbl').DataTable({
        dom: 'Blfrtip',
        buttons: [
            { extend: 'print', className: 'btn dark' },
            { extend: 'pdf', className: 'btn red' },
            { extend: 'excel', className: 'btn grey-mint' }
        ],
        "lengthChange": true,
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No submittal form to list",
            "info": "Showing _START_ to _END_ of _TOTAL_ submittal form",
            "infoEmpty": "No submittal form found",
            "infoFiltered": "(filtered1 from _MAX_ total submittal form)",
            "lengthMenu": "_MENU_ Number of records",
            "search": "Search:",
            "zeroRecords": "No matching submittal form found"
        },
        "lengthMenu": [
          [5, 10, 15, 20, 50, 100],
          [5, 10, 15, 20, 50, 100] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,
        "ajax": {
            "url": get_submittal_form_list_url,
            "type": "POST",
            'data': function(data){
                data.search_text = $('#submittal_form_tbl input[type="text"]').val();
                data.active_user = $('#active_user_list').is(':checked') ? '1' : '0';
                $("#submittal_form_tbl input[type='search']").focus();
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [0,8] }
        ],
        "order": [1, "asc"],
        "processing": true,
        "serverSide": true,
        "columns": [
            {
                "class":          'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "Timestamp"},
            { "data": "ComplaintNumber"},
            { "data": "CompanyName"},
            { "data": "Location"},
            { "data": "EmailId"},
            { "data": "UserName"},
            { "data": "SeverityLevel"},
            { "data": "Action"}
        ]
    });

    // Append custom button to the buttons container
    table.buttons().container().appendTo('.buttons-container');


    // Add event listener for opening and closing details
   $('#submittal_form_tbl tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
        }
        else {
          // Open this row
          row.child( format(row.data()) ).show();
          tr.addClass('shown');
        }
    });

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
//start code for add sku and check division is selectd or not in product
$(document).on("click", "#add_form_details", function () {
    $('#add_form_details_modal').modal('show');
});