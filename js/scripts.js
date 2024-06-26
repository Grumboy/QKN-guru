jQuery(document).ready(function($) {
    // Alert message when adding a new system
    $('#add-new-system').on('submit', function() {
        alert('New system is being added...');
    });

    // Alert message when adding a new fix
    $('#add-new-fix').on('submit', function() {
        alert('New fix is being added...');
    });

    // Initialize DataTables for both systems and fixes tables
    $('#systemsTable, #fixesTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 20, 50, 100, "All"],
        "order": [[0, "asc"]],
        "dom": 'lfrtip', // This adds the option for search and pagination
        "initComplete": function () {
            this.api().columns().every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });

    // Change the number of displayed systems and fixes
    $('select[name="posts_per_page"]').on('change', function() {
        $(this).closest('form').submit();
    });

    // Highlight row on hover
    $('.systems-table tr, .fixes-table tr').hover(function() {
        $(this).css('background-color', '#f4be34');
        $(this).css('color', '#ffffff');
    }, function() {
        $(this).css('background-color', '');
        $(this).css('color', '');
    });

    // Ensure even rows have a background color
    $('.systems-table tr:nth-child(even), .fixes-table tr:nth-child(even)').css('background-color', '#f2f2f2');
});
