// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    // flipping horizontal scroll bar in datatables refer to admin.css line 94
    scrollX : 'TRUE', 
    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    columnDefs: [ {
      targets: 2,
      render: $.fn.dataTable.render.ellipsis( 20, true )
    } ],
  });
});
