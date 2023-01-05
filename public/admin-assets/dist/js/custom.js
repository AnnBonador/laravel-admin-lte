$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Date picker
    $('#dob').datetimepicker({
        format: 'L',
        maxDate: 'now'
    });

    $('#apptDay').datetimepicker({
        format: 'L',
        minDate:new Date(),
        disabledDates: [new Date()],
        defaultDate: moment().add(1, 'day')
    });
    $('#schedDay').datetimepicker({
        format: 'L',
        minDate: new Date()
    });
    $('#pres_date').datetimepicker({
        format: 'L'
    });

     //Timepicker
     $('#startTime').datetimepicker({
        format: 'LT'
      });
     $('#endTime').datetimepicker({
        format: 'LT'
      });

      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )
//Phone Format
jQuery(document).ready(function($){
    $(".js-phone").inputmask({
        mask: ["+639999999999"],
        jitMasking: 3,
        showMaskOnHover: false,
        autoUnmask: true,
    });
});

});

//num only
$("#num").on("keypress keyup blur",function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
     if ((event.which < 48 || event.which > 57)) {
         event.preventDefault();
     }
 });

 function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)&&(charCode!=46)) {
        return false;
    }
    return true;
}

 //datatable
 $(document).ready(function() {
    $('#table1').DataTable( {
        // lengthMenu: [
        //     [10, 25, 50, -1],
        //     [10, 25, 50, 'All'],
        // ],
        "dom": "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "responsive": true,
        "searching": true,
        "paging": true,
        "ordering":true,
        "buttons": [{
            extend: 'copyHtml5',
            className: 'btn btn-secondary btn-sm',
            text: '<i class="fas fa-clipboard"></i>  Copy',
          },
          {
            extend: 'csvHtml5',
            className: 'btn btn-secondary btn-sm',
            text: '<i class="fas fa-file-csv"></i>  CSV',
          },
          {
            extend: 'excel',
            className: 'btn btn-secondary btn-sm',
            text: '<i class="far fa-file-excel"></i>  Excel',
          },
          {
            extend: 'pdfHtml5',
            className: 'btn btn-secondary btn-sm',
            text: '<i class="far fa-file-pdf"></i>  PDF',
          },
          {
            extend: 'print',
            className: 'btn btn-secondary btn-sm',
            text: '<i class="fas fa-print"></i>  Print',
          }
        ],
    } );
} );

