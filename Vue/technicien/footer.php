<?php

$footer =
    '<footer>
				<div class="pull-right">
Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
				</div>
				<div class="clearfix"></div>
			</footer>
			
			
	<!-- jQuery -->
	<script src="Vue/assest/vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="Vue/assest/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="Vue/assest/vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="Vue/assest/vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="Vue/assest/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="Vue/assest/vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="Vue/assest/vendors/moment/min/moment.min.js"></script>
	<script src="Vue/assest/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="Vue/assest/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="Vue/assest/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="Vue/assest/vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="Vue/assest/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="Vue/assest/vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="Vue/assest/vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="Vue/assest/vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="Vue/assest/vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="Vue/assest/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="Vue/assest/vendors/starrr/dist/starrr.js"></script>
	
	 <script src="Vue/assest/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="Vue/assest/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="Vue/assest/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
	  <!-- PNotify -->
    <script src="Vue/assest/vendors/pnotify/dist/pnotify.js"></script>
    <script src="Vue/assest/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="Vue/assest/vendors/pnotify/dist/pnotify.nonblock.js"></script>
	
	
	<!-- Custom Theme Scripts -->
	<script src="Vue/assest/build/js/custom.js"></script>

';
$alcolad = '{';
if (isset($_SESSION['message'])){
    $footer .= "<script type='text/javascript'>
$(document).ready(function ()$alcolad
    $('.ui-pnotify').remove();";

    foreach ($_SESSION['message'] as $key=>$value){
        $type =  $value['type'];
        $text = $value['text'];
        $title = $value['title'];
        $footer .=" 
         new PNotify({
            title: '$title',
        type: '$type',
        text: '$text',
        nonblock: {
                nonblock: true,
        },
        styling: 'bootstrap3',
    });";
    }
    $footer .=" 
});
</script>
  
";


}
$footer .= '
</body>
</html>';
echo $footer;

