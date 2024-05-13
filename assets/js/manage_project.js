var TableDatatablesResponsive = function () {

    var initProjectsTable = function () {
        var table = $('#projects');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No projects to list",
                "info": "Showing _START_ to _END_ of _TOTAL_ projects",
                "infoEmpty": "No projects found",
                "infoFiltered": "(filtered1 from _MAX_ total projects)",
                "lengthMenu": "_MENU_ projects",
                "search": "Search:",
                "zeroRecords": "No matching projects found"
            },
            buttons: [

            ],
            "order": [
                [3, 'desc']
            ],
            
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
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