jQuery(document).ready(function($) {
    $('#add-new-system').on('submit', function() {
        alert('New system is being added...');
    });

    $('#add-new-fix').on('submit', function() {
        alert('New fix is being added...');
    });

    $('#systemsTable, #fixesTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 20, 50, 100, "All"],
        "order": [[0, "asc"]]
    });
});
