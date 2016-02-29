<?php
if (isset($header_404) && $header_404 == 'Y') {
    $page_title_tag = "The page you requested cannot be displayed - " . WEBSITE_NAME;
    header("HTTP/1.1 404 Not Found");
}
$CI = &get_instance();
$act_page = $CI->uri->segment(1);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo "Google Route Planner"; ?></title>       

        <meta name="robots" content="noindex,nofollow" />
        <meta name="robots" content="noarchive" />

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />

        <!--For Map_routing start-->

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/map_routing/style.css" type="text/css" media="screen">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/map_routing/print.css" type="text/css" media="print">
        <link type="text/css" href="<?php echo base_url(); ?>css/map_routing/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/map_routing/jquery.cookie.js"></script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/map_routing/BpTspSolver.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/map_routing/directions-export.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/map_routing/tsp.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/map_routing/jquery-ui.min.js"></script>

        <!--// For Map_routing end-->

        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.22/jquery-ui.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
<?php if ($this->uri->segment(1) == "") { ?>
                    $(".inline").colorbox({inline: true, width: 290});
                    $('.inline').click();
<?php } ?>
            });
        </script>

    </head>

    <?php //onLoad="onBodyLoad() -- added for map_routing"  ?>

    <body class="dy_body_bg"   onLoad="onBodyLoad()">
        <div id="wrapper">
            <section class="container">
                <div class="content_wrap">
