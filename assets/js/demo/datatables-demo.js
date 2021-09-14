// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({

    "order": []
  }); 

  $('#dataTable1').DataTable({
    dom: 'Bfrtip',
    "pagingType": "full_numbers",
        buttons: [
          {
            title : "Laporan Penjualan",
            extend: 'excelHtml5',
            exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
          },
          {
            title : "Laporan Penjualan",
              extend: 'pdfHtml5',
              exportOptions: {
                  columns: [0,1,2,3,4,5,6]
              }
          },
        ],
    "order": []
  }); 
});



