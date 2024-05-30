var TableDatatablesResponsive = function () {
    var initProjectsTable = function () {
        var table = $('#users');
        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No users to list",
                "info": "Showing _START_ to _END_ of _TOTAL_ users",
                "infoEmpty": "No projects found",
                "infoFiltered": "(filtered1 from _MAX_ total users)",
                "lengthMenu": "_MENU_ users",
                "search": "Search:",
                "zeroRecords": "No matching users found"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // setup buttons extentension: http://datatables.net/extensions/buttons/
            buttons: [
                { extend: 'print', className: 'btn dark' },
                { extend: 'pdf', className: 'btn red' },
                { extend: 'excel', className: 'btn grey-mint' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/


            "order": [
                [0, 'asc'],[1,'asc']
            ],
            
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }  

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initProjectsTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesResponsive.init();
});
jQuery(document).ready(function() {          
    $('a.delete_user_button').click(function(){
        var username =  $(this).data('username');
        var userid = $(this).data('userid');
        bootbox.confirm({
            title: "<i class='fa fa-user-times'></i>&nbsp;Delete User?",
            message: "Are you sure that you want to delete the user <strong>"+username+"</strong>?<br><br>This will permanently delete this user and cannot be undone.",
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
                        data: { user_id: userid },
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
});
$('#profile_form').submit(function(e) {
    $('input[type=text]').each(function() {
      $(this).val($.trim($(this).val()));
    });
});
$('#profile_form').validate({
    rules: {
        firstname: {
            required: true
        },
        lastname: {
            required: true
        },
        localoffice: {
            required: true
        },
        phone: {
            phoneUS: true
        }
    },
    messages: {
        firstname: {
            required: "First name is required!"
        },
        lastname: {
            required: "Last name is required!"
        },
        localoffice: {
            required: "Please select local office!"
        }
    },
    submitHandler: function(form) {
        form.submit();
    }
});
