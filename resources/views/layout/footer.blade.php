<!-- jQuery 3 -->
<script src="{{ url('theme') . '/bower_components/' }}jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('theme') . '/bower_components/' }}jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('theme') . '/bower_components/' }}bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="{{ url('theme') . '/bower_components/' }}raphael/raphael.min.js"></script>
<script src="{{ url('theme') . '/bower_components/' }}morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="{{ url('theme') . '/bower_components/' }}jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{ url('theme') . '/plugins/' }}/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ url('theme') . '/plugins/' }}/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('theme') . '/bower_components/' }}jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ url('theme') . '/bower_components/' }}moment/min/moment.min.js"></script>
<script src="{{ url('theme') . '/bower_components/' }}bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{ url('theme') . '/bower_components/' }}bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('theme') . '/plugins/' }}/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{ url('theme') . '/bower_components/' }}jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ url('theme') . '/plugins/' }}/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="{{ url('theme') . '/bower_components/' }}fastclick/lib/fastclick.js"></script>
<!-- Select2 -->
<script src="{{ url('theme') . '/bower_components/' }}/select2/dist/js/select2.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('theme') . '/dist/' }}/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ url('theme') . '/dist/' }}/js/pages/dashboard.js"></script>--}}
<!-- AdminLTE for demo purposes -->
    <div align="center">

                    <i class="fa fa-spinner"></i> <span>Quick Links</span><br>
        
                   <a href="https://umojamagharibi.eazzyrent.com/index.jsp"target="_blank" >
                     <i class="fa fa-edge"></i><span>EazzyRent</span></a><br>
                
                   <a href="https://system.loanspur.com/?tenantIdentifier=umoja#/"target="_blank">
                     <i class="fa fa-cc-amex"></i><span>Loanspur</span><br>
                  </a>

    </div>
 <div align="center">
        <p class="copyright">&copy; <?php echo date ('Y'); ?> Umoja Magharibi</p>
    </div>

<script src="{{ url('theme') . '/dist/' }}/js/demo.js"></script>
<!-- Custom script for initializing widgets -->
<script src="{{ url('theme') }}/custom.js"></script>
