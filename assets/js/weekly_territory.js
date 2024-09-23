$(function() {
  var startOfYear = moment().startOf('year');
  var today = moment();
  get_weekly_report(startOfYear.format('YYYY-MM-DD'), today.format('YYYY-MM-DD'));
  $('#daterange').daterangepicker({
      locale: {
          format: 'YYYY-MM-DD'
      },
      startDate: startOfYear,  // Set January 1st of the current year as the start date
      endDate: today,          // Set today's date as the end date
      opens: 'right'
  }, function(start, end, label) {
    get_weekly_report(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
  });
});
$('#employee').change(function() {
  // Get selected dates
  var start_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
  var end_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');

  // Call the function with selected employee and date range
  get_weekly_report(start_date, end_date);
});
function get_weekly_report(start_date,end_date) {
  var employee = $('#employee').val();
  if ($.fn.DataTable.isDataTable('#complaint_list_tbl')) {
      $('#complaint_list_tbl').DataTable().destroy();
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
          "url": get_all_weekly_report,
          "type": "POST",
          'data': function(data){
              data.search_text = $('#complaint_list_tbl input[type="text"]').val();
              data.employee = employee;
              data.start_date = start_date;
              data.end_date = end_date;
              $("#complaint_list_tbl input[type='search']").focus();
          }
      },
      "columnDefs": [
          { "orderable": false, "targets": [0,9] }
      ],
      "processing": true,
      "serverSide": true,
      'order': [[1, 'desc']],
      "columns": [
          { "data": "Checkbox"},
          { "data": "WeekEnding"},
          { "data": "Name"},
          { "data": "GeneralOverview"},
          { "data": "GoalforthisWeek"},
          { "data": "KeySalesCalls"},
          { "data": "InsightsAccomplishments"},
          { "data": "CompetitiveInsights"},
          { "data": "NextWeekPlansGoals"},
          { "data": "Action"}
      ],
      "createdRow": function(row, data, dataIndex) {
          $(row).find('td:eq(1)').attr('style', 'background-color: ' + data.ColorCode + ' !important');
      }
  });

  // Append custom button to the buttons container
  table.buttons().container().appendTo('.buttons-container');
}
$(document).on('click', '.view_report', function(e) {
  var id = $(this).data('id');
  get_report_data(id);
  $('#report_view_modal').modal('show');
});
function get_report_data(id) {
  $("#overlay").fadeIn(300);
  $.ajax({
    url : get_report_data_url,
    type: "POST",
    data: {'id':id},
    success : function(data){
      // console.log(data.report_data);
      $("#WeekEnding").val(data.report_data.WeekEnding);
      $("#Name").val(data.report_data.Name);
      $("#GeneralOverview").val(data.report_data.GeneralOverview);
      $("#GoalforthisWeek").val(data.report_data.GoalforthisWeek);
      $("#KeySalesCalls").val(data.report_data.KeySalesCalls);
      $("#InsightsAccomplishments").val(data.report_data.InsightsAccomplishments);
      $("#CompetitiveInsights").val(data.report_data.CompetitiveInsights);
      $("#NextWeekPlansGoals").val(data.report_data.NextWeekPlansGoals);
      var userImageUrl = data.image_url;
         
         // Create img element
         var imgElement = $('<img>', {
             id: 'previewImage',
             class: 'w-100',
             src: userImageUrl,
             alt: 'User Image Preview',
             css: {
                 display: userImageUrl ? 'block' : 'none'
             }
         });
         
         // Create span element for "No image selected"
         var noImageText = $('<span>', {
             id: 'noImageText',
             text: 'No image selected',
             css: {
                 display: userImageUrl ? 'none' : 'block'
             }
         });

         // Append the elements to a container (for example #imageContainer)
         $('#imageContainer').html(imgElement).append('<br>').append(noImageText);
      $("#overlay").fadeOut(300);
    }
  });
}