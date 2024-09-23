$(document).ready(function() {
    function getQueryParam(param) {
        var urlParams = new RegExp('[?&]' + param + '=([^&#]*)').exec(window.location.href);
        return urlParams ? urlParams[1] : null;
    }
    
    // Get the value of 'complaint_id'
    var complaintId = getQueryParam('complaint_id');
    if (complaintId !== null) {
        get_all_complaint_data(complaintId);
        $('#complaint_view_modal').modal('show');
    }
    var table = $('#complaint_list_tbl').DataTable({
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
                data.search_text = $('#complaint_list_tbl input[type="text"]').val();
                $("#complaint_list_tbl input[type='search']").focus();
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [0,8] }
        ],
        "processing": true,
        "serverSide": true,
        "columns": [
            { "data": "checkbox"},
            { "data": "DateOfSubmittal"},
            { "data": "AssociatedLoggingNumber"},
            { "data": "SeverityLevel"},
            { "data": "ComplaintCategory"},
            { "data": "DateOfIssue"},
            { "data": "SubmitedBy"},
            { "data": "ShippingSiteOrCustomerLocation"},
            { "data": "Action"}
        ],
        "createdRow": function(row, data, dataIndex) {
            $(row).find('td:eq(1)').attr('style', 'background-color: ' + data.ColorCode + ' !important');
        }
    });

    // Append custom button to the buttons container
    table.buttons().container().appendTo('.buttons-container');
});
$(document).on('click', '.view_complaint', function(e) {
  var complaint_id = $(this).data('complaint_id');
  get_all_complaint_data(complaint_id);
  $('#complaint_view_modal').modal('show');
});
function get_all_complaint_data(complaint_id) {
  $("#overlay").fadeIn(300);
  $.ajax({
    url : get_complaint_data_url,
    type: "POST",
    data: {'complaint_id':complaint_id},
    success : function(data){
        var complaint_details  = data.complaint_details;
        $('#AssociatedLoggingNumber').html(complaint_details.AssociatedLoggingNumber);
        $('#DateOfSubmittal').html(complaint_details.DateOfSubmittal);
        $('#DateOfIssue').html(complaint_details.DateOfIssue);
        $('#ComplaintCategory').html(complaint_details.ComplaintCategory);
        $('#SeverityLevel').html(complaint_details.SeverityLevel);
        $('#ShippingSiteOrCustomerLocation').html(complaint_details.ShippingSiteOrCustomerLocation);
        $('#HowFailureNonconformanceIdentified').html(complaint_details.HowFailureNonconformanceIdentified);
        $('#ComplaintSummary').html(complaint_details.ComplaintSummary);
        $('#NextStepsTaken').html(complaint_details.NextStepsTaken);
        $('#RootCause').html(complaint_details.RootCause);
        $('#PreventativeAction').html(complaint_details.PreventativeAction);
        $('#CorrectiveAction').html(complaint_details.CorrectiveAction);
        $('#ResolvedBy').html(complaint_details.ResolvedBy);
        $('#ResolvedDate').html(complaint_details.ResolvedDate);
        $('#ShipmentDeliveryTNumber').html(complaint_details.ShipmentDeliveryTNumber);
        var tbody = '';
        $.each(data.product_details, function(key, items) {
            tbody += '<tr>';
            tbody += '<td>'+items.Location+'</td>';
            tbody += '<td>'+items.LineNumberName+'</td>';
            if (items.FittingDescription != null) {
                tbody += '<td>'+items.FittingDescription+'</td>';
            }else{
                tbody += '<td></td>';
            }
            tbody += '<td>'+items.ProductDiameter+'</td>';
            tbody += '<td>'+items.ProductFlavour+'</td>';
            tbody += '<td>'+items.ProductLength+'</td>';
            tbody += '<td>'+items.ProductType+'</td>';
            tbody += '<td>'+items.BellType+'</td>';
            tbody += '<td>'+items.ProductPerf+'</td>';
            tbody += '<td>'+items.ProductShift+'</td>';
            tbody += '</tr>';
        });
        $('#tbl_product_details').html(tbody);
        $('#complaint_image').html(data.photos);
        $("#overlay").fadeOut(300);
    }
  });
}
$(document).ready(function() {
  $(document).on('click', '.zoom_complaint_image', function() {
    var image_url = $(this).data('imageurl');
    $('#zoom_complaint_image_big').attr('src', image_url);
    $('#complaint_image_modal').modal('show');
  });
});