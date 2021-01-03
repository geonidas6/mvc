<?php
$msgs =   '<script src="Vue/assest/vendors/jquery/dist/jquery.min.js"></script>
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
    <!-- PNotify -->
    <script src="Vue/assest/vendors/pnotify/dist/pnotify.js"></script>
    <script src="Vue/assest/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="Vue/assest/vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="Vue/assest/build/js/custom.min.js"></script>';
if (isset($_SESSION['message'])){
    $msgs .= "<script type='text/javascript'>
$(document).ready(function (){
    $('.ui-pnotify').remove();";

    foreach ($_SESSION['message'] as $key=>$value){
        $type =  $value['type'];
        $text = $value['text'];
        $title = $value['title'];
      $msgs .="  new PNotify({
            title: '$title',
        type: '$type',
        text: '$text',
        nonblock: {
                nonblock: true
        },
        styling: 'bootstrap3'
    });";
    }
    $msgs .=" 
});
</script>
  
";


}
$msgs .= '</body>
</html>';
echo $msgs;
//unset($_SESSION['message']);