jQuery(document).ready(function($) {
    // Initialize DataTables for systems table
    var systemsTable = $('#systemsTable');
    if (systemsTable.length) {
        systemsTable.DataTable({
            "pageLength": parseInt(systemsTable.data('page-length')) || 10,
            "lengthMenu": [5, 10, 20, 50, 100],
            "order": [[0, "asc"]],
            "dom": 'lfrtip',
        });
    }

    // Initialize DataTables for fixes table
    var fixesTable = $('#fixesTable');
    if (fixesTable.length) {
        fixesTable.DataTable({
            "pageLength": parseInt(fixesTable.data('page-length')) || 10,
            "lengthMenu": [5, 10, 20, 50, 100],
            "order": [[0, "asc"]],
            "dom": 'lfrtip',
        });
    }
});