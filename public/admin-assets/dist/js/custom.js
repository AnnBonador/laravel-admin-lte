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
        minDate: new Date()
    });
    $('#schedDay').datetimepicker({
        format: 'L',
        minDate: new Date()
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



