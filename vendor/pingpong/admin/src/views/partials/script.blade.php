<script src="{{ admin_asset('components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ admin_asset('components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('components/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- Sparkline -->
<script src="{{ admin_asset('adminlte/js/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<!-- jvectormap -->
<script src="{{ admin_asset('adminlte/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
<script src="{{ admin_asset('adminlte/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="{{ admin_asset('adminlte/js/plugins/jqueryKnob/jquery.knob.js') }}" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="{{ admin_asset('adminlte/js/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<!-- datepicker -->
<script src="{{ admin_asset('adminlte/js/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ admin_asset('adminlte/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ admin_asset('adminlte/js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{ admin_asset('adminlte/js/AdminLTE/app.js') }}" type="text/javascript"></script>

{{-- all scripts --}}
<script src="{{ admin_asset('js/all.js') }}" type="text/javascript"></script>

{{-- Jquery date picker --}}
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker();
  });

  $("#datepicker").removeClass('hasDatepicker').datepicker({
    onSelect: function() { 
        var dateObject = $(this).datepicker('getDate');
        $(this).datepicker('hide');
        $('#datepicker').val(getDate(dateObject));
    }
});

$("#datepicker2").removeClass('hasDatepicker').datepicker({
    onSelect: function() { 
        var dateObject = $(this).datepicker('getDate');
        $(this).datepicker('hide');
        $('#datepicker2').val(getDate(dateObject));
    }
});

function getDate(dateObject){
        var date = new Date(dateObject),
        yr = date.getFullYear(),
        month = (date.getMonth()+1) < 10 ? '0' + (date.getMonth()+1) : (date.getMonth()+1) ,
        day = +date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
        newDate = yr + '-' + month + '-' + day;   
        return newDate;
}

</script>

