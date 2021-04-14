// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    columnDefs: [ {
      targets: 2,
      render: $.fn.dataTable.render.ellipsis( 20, true )
    } ]
  });
});
