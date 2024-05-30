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
            var api = this.api();

            // Apply the search
            api.columns().every(function () {
                var column = this;
                var input = $('<input type="text" placeholder="Search ' + $(column.header()).text() + '" />')
                    .appendTo($(column.footer()).empty())
                    .on('keyup change clear', function () {
                        if (column.search() !== this.value) {
                            column.search(this.value).draw();
                        }
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
