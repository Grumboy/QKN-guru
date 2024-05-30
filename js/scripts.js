jQuery(document).ready(function($) {
    $('#add-new-system').on('submit', function() {
        alert('New system is being added...');
    });

    $('#systemsTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 20, 50, 100, "All"],
        "order": [[0, "asc"]]
    });
    
    $('#fixesTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [10, 20, 50, 100, "All"],
        "order": [[0, "asc"]]
    });
});
