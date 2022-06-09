// Call the dataTables jQuery plugin
$(document).ready(function () {
    $("#dataTable").DataTable({
        dom: '<"top"fB>t<"bottom"lip>r',
        buttons: ["copy", "excel", "csv"],

        responsive: true,
        "paging":   false,
        "ordering": false,
        "info":     false
    });
});
