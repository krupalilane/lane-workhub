/* Formatting function for row details - modify as you need */
function format ( d ) {
    var sub_child_row = '<table class="table table-striped table-bordered table-hover dt-responsive display responsive">';
        sub_child_row += '<tbody>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Where was failure found, shipped via Lane Truck? Please provide T-number if yes. :</b></td>';
                sub_child_row += '<td>'+d.FailurFoundLocation+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Who found the failure? :</b></td>';
                sub_child_row += '<td>'+d.FailureFoundBy+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Time when failure was found and when was the product produced? :</b></td>';
                sub_child_row += '<td>'+d.FailureFoundOn+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Description of defective product :</b></td>';
                sub_child_row += '<td>'+d.DefectiveProductDescription+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Description of issue :</b></td>';
                sub_child_row += '<td>'+d.IssueDescription+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>QA Severity : </b></td>';
                sub_child_row += '<td>'+d.QASeverityLevel+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Category : </b></td>';
                sub_child_row += '<td>'+d.Category+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Root Cause : </b></td>';
                sub_child_row += '<td>'+d.RootCause+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Corrective Action(s) : </b></td>';
                sub_child_row += '<td>'+d.CorrectiveAction+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Preventative Measures or Resolutions : </b></td>';
                sub_child_row += '<td>'+d.PreventiveMeasuresOrResolution+'</td>';
            sub_child_row += '</tr>';
            sub_child_row += '<tr>';
                sub_child_row += '<td><b>Date Closed : </b></td>';
                sub_child_row += '<td>'+d.DateClosed+'</td>';
            sub_child_row += '</tr>';
        sub_child_row += '</tbody>';
    sub_child_row += '</table>';
    return sub_child_row;
}
$(document).ready(function() {
    var table = $('#archive_list_tbl').DataTable({
        dom: 'Blfrtip',
        buttons: [],
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
                data.search_text = $('#archive_list_tbl input[type="text"]').val();
                data.active_user = $('#active_user_list').is(':checked') ? '1' : '0';
                $("#archive_list_tbl input[type='search']").focus();
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [0] }
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
            { "data": "SeverityLevel"}
        ]
    });

    // Append custom button to the buttons container
    table.buttons().container().appendTo('.buttons-container');


    // Add event listener for opening and closing details
   $('#archive_list_tbl tbody').on('click', 'td.details-control', function () {
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
});