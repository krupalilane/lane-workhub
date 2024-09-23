$(document).on('click', 'a.delete_user_button', function() {
    var userId      = $(this).data('userid');
    var userName    = $(this).data('username');
    var userActive  = $(this).data('activedata');
    if (userActive == 0) {
        var message = "Are you sure that you want to In-active the user <strong>"+userName+"</strong>?<br>";
    }else{
        var message = "Are you sure that you want to Active the user <strong>"+userName+"</strong>?<br>";
    }
    bootbox.confirm({
        title: "<i class='fa fa-user-times'></i>&nbsp;Delete User?",
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
                    url: delete_user_url,
                    type: 'POST',
                    data: { user_id: userId ,userActive:userActive},
                    success: function (result) {
                        toastr.success('User deleted successfully.');
                        setTimeout(() => {
                            window.location.href = user_admin_url;
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
$(document).ready(function() {
    var table = $('#user_tbl').DataTable({
        dom: 'Blfrtip',
        buttons: [],
        "lengthChange": true,
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No user to list",
            "info": "Showing _START_ to _END_ of _TOTAL_ user",
            "infoEmpty": "No user found",
            "infoFiltered": "(filtered1 from _MAX_ total user)",
            "lengthMenu": "_MENU_ Number of records",
            "search": "Search:",
            "zeroRecords": "No matching user found"
        },
        "lengthMenu": [
              [5, 10, 15, 20, 50, 100],
              [5, 10, 15, 20, 50, 100] // change per page values here
          ],
        // set the initial value
        "pageLength": 5,
        "ajax": {
            "url": get_user_list_url,
            "type": "POST",
            'data': function(data){
                console.log(data);
                data.search_text = $('#user_tbl input[type="text"]').val();
                data.active_user = $('#active_user_list').is(':checked') ? '1' : '0';
                $("#user_tbl input[type='search']").focus();
            }
        },
        "columnDefs": [
            { "orderable": false, "targets":  [0,5] }
        ],
        "order": [1, "asc"],
        "processing": true,
        "serverSide": true,
        'columns': [
            { data: 'checkbox'},
            { data: 'FirstName'},
            { data: 'LastName' }, 
            { data: 'UserName' },
            { data: 'Email' },
            { data: 'Action' }
        ]
    });

    // Append custom button to the buttons container
    table.buttons().container().appendTo('.buttons-container');
    $('#active_user_list').change(function() {
        table.ajax.reload(); // Reload the table data when toggle changes
    });
});