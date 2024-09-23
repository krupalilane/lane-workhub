$(document).ready(function() {
    var table = $('#holiday_list_tbl').DataTable({
        dom: 'Blfrtip',
        buttons: [],
        "lengthChange": true,
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No holidays to list",
            "info": "Showing _START_ to _END_ of _TOTAL_ holidays",
            "infoEmpty": "No holidays found",
            "infoFiltered": "(filtered1 from _MAX_ total holidays)",
            "lengthMenu": "_MENU_ Number of records",
            "search": "Search:",
            "zeroRecords": "No matching holidays found"
        },
        "lengthMenu": [
            [5, 10, 15, 20, 50, 100],
            [5, 10, 15, 20, 50, 100] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,
        "ajax": {
            "url": get_holiday_form_list_url,
            "type": "POST",
            'data': function(data){
                data.search_text = $('#holiday_list_tbl input[type="text"]').val();
                data.active = $('#active_list').is(':checked') ? '1' : '0';
                $("#holiday_list_tbl input[type='search']").focus();
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [0,6] }
        ],
        "order": [1, "asc"],
        "processing": true,
        "serverSide": true,
        "columns": [
            { "data": "Checkbox"},
            { "data": "Id"},
            { "data": "Year"},
            { "data": "HolidayDate"},
            { "data": "WeekDay"},
            { "data": "HolidayName"},
            { "data": "Action"},
        ]
    });

    // Append custom button to the buttons container
    table.buttons().container().appendTo('.buttons-container');
    $('#active_list').change(function() {
        table.ajax.reload(); // Reload the table data when toggle changes
    });
});
$(document).ready(function() {
    $('#holiday_date').on('change', function() {
        var dateValue = $(this).val();
        if (dateValue) {
            var date = new Date(dateValue);
            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var dayOfWeek = days[date.getUTCDay()];
            var year = date.getFullYear();

            $('#week_year').val(year);
            $('#week_day').val(dayOfWeek);
        }
    });
    $(document).on('click', 'a.delete_holiday_button', function() {
        var holidayId      = $(this).data('holiadyid');
        var holidayActive  = $(this).data('activedata');
        if (holidayActive == 0) {
            var message = "Are you sure that you want to In-active the holiday?<br>";
        }else{
            var message = "Are you sure that you want to Active the holiday?<br>";
        }
        bootbox.confirm({
            title: "<i class='fa fa-user-times'></i>&nbsp;Delete holiday?",
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
                        url: delete_holiday_url,
                        type: 'POST',
                        data: { holiday_id: holidayId ,holidayActive:holidayActive},
                        success: function (result) {
                            if (holidayActive == 0) {
                                toastr.success('holiday In-actived successfully.');
                            }else{
                                toastr.success('holiday Actived successfully.');
                            }
                            setTimeout(() => {
                                window.location.href = holiday_admin_url;
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
$(document).on('click', '.edit_holiday', function(){
    var id = $(this).data('holiadyid');
    $("#overlay").fadeIn(300);　
    $.ajax({
        url : get_holiday_data_url,
        type: "POST",
        data: {"id":id},
         success : function(data){
            $('#Id').val(data.Id);
            $('#holiday_date').val(data.HolidayDate);
            $('#holiday_name').val(data.HolidayName);
            $('#week_day').val(data.WeekDay);
            $('#week_year').val(data.Year);
            $("#overlay").fadeOut(300);
        }
    });
});
$.validator.addMethod("holidayExists", function(value, element) {
    var response = false;
    var id = $('#Id').val();
    $.ajax({
        type: "POST",
        url: check_holiday_duplicate_url, // URL to your server-side script
        data: { HolidayDate: value, HolidayId : id },
        dataType: "json",
        async: false,
        success: function(data) {
            response = !data.exists;
        }
    });
    return response;
}, "Holiday already exists in active or in-active list.");
$('#add_holiday_form').validate({
    debug: false,
    ignore: [],
    rules: {
        holiday_date: {
            required: true,
            holidayExists: true
        },
        week_year: {
            required: true
        },
        week_day: {
            required: true
        },
        holiday_name: {
            required: true
        }
    },
    messages: {
        holiday_date: {
            required: "Please select holiday date!"
        },
        week_year: {
            required: "Please Select holiday date!"
        },
        week_day: {
            required: "Please Select holiday date!"
        },
        holiday_name: {
            required: "Please provide holiday name!"
        }
    },
    submitHandler: function(form) {
        $('#submit').prop('disabled', true);
        $('#submit').val('Submitting...');
        form.submit();
    }
});