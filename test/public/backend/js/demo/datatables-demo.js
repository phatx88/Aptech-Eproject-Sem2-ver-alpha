// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    // flipping horizontal scroll bar in datatables refer to admin.css line 94
    order: [[ 0, "desc" ]],
    autoWidth: 'TRUE',
    scrollX : 'TRUE', 
    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    columnDefs: [ {
      targets: 2,
      render: $.fn.dataTable.render.ellipsis( 15, true )
    } ],
  });

  $('#dataTable_2').DataTable({
    // flipping horizontal scroll bar in datatables refer to admin.css line 94
    order: [[ 0, "desc" ]],
    autoWidth: 'TRUE',
    scrollX : 'TRUE', 
    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    columnDefs: [ {
      targets: 2,
      render: $.fn.dataTable.render.ellipsis( 15, true )
    } ],
  });
});
