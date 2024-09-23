$(document).ready(function() {
    var table = $('#announcement_list_tbl').DataTable({
        dom: 'Blfrtip',
        buttons: [],
        "lengthChange": true,
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No announcements to list",
            "info": "Showing _START_ to _END_ of _TOTAL_ announcements",
            "infoEmpty": "No announcements found",
            "infoFiltered": "(filtered1 from _MAX_ total announcements)",
            "lengthMenu": "_MENU_ Number of records",
            "search": "Search:",
            "zeroRecords": "No matching announcements found"
        },
        "lengthMenu": [
              [5, 10, 15, 20, 50, 100],
              [5, 10, 15, 20, 50, 100] // change per page values here
          ],
        // set the initial value
        "pageLength": 5,
        "ajax": {
            "url": get_announcement_form_list_url,
            "type": "POST",
            'data': function(data){
                data.search_text = $('#announcement_list_tbl input[type="text"]').val();
                data.active = $('#active_list').is(':checked') ? '1' : '0';
                $("#announcement_list_tbl input[type='search']").focus();
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [0,5] }
        ],
        "order": [1, "asc"],
        "processing": true,
        "serverSide": true,
        "columns": [
            { "data": "Checkbox"},
            { "data": "Id"},
            { "data": "AnnoucementHeader"},
            { "data": "AnnouncementContent"},
            { "data": "AnnoucementDate"},
            { "data": "Action"}
        ]
    });

    // Append custom button to the buttons container
    table.buttons().container().appendTo('.buttons-container');
    $('#active_list').change(function() {
        table.ajax.reload(); // Reload the table data when toggle changes
    });
    $(document).on('click', 'a.delete_announcement_button', function() {
        var announcementId      = $(this).data('annoucementid');
        var announcementActive  = $(this).data('activedata');
        if (announcementActive == 0) {
            var message = "Are you sure that you want to In-active the announcement?<br>";
        }else{
            var message = "Are you sure that you want to Active the announcement?<br>";
        }
        bootbox.confirm({
            title: "<i class='fa fa-user-times'></i>&nbsp;Delete Announcement?",
            message: message,
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel',
                    className: 'btn dark'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm',
                    className: 'btn red'
                }
            },
            callback: function (result) {
                if(result === true) {
                    $.ajax({
                        url: delete_announcements_url,
                        type: 'POST',
                        data: { announcement_id: announcementId ,announcementActive:announcementActive},
                        success: function (result) {
                            if (announcementActive == 0) {
                                toastr.success('Announcement In-actived successfully.');
                            }else{
                                toastr.success('Announcement Actived successfully.');
                            }
                            setTimeout(() => {
                                window.location.href = announcements_admin_url;
                            }, 2000)
                        }
                    });
                }
                else {
                    $('.bootbox.modal').modal('hide');
                }
             }
        });
    });
});