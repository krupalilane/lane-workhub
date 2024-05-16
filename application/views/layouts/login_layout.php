<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>StormStorage Online Configuration Tool | Lane Enterprises, Inc.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="StormStorage Online Configuration Tool &copy; Lane Enterprises, Inc." name="description" />
        <meta content="" name="author" />
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo asset_url();?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>pages/css/login.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo asset_url();?>layouts/layout3/css/custom.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="<?php echo site_url('login');?>">
            <img src="<?php echo asset_url();?>images/logo-lane-header_75px.png" alt="" /></a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <?php echo $yield; ?>
        </div>
        <div class="copyright"> <?php echo date("Y"); ?>  &copy;  
            <a target="_blank" href="http://lane-enterprises.com">Lane Enterprises, Inc.</a>&nbsp;&middot;&nbsp;All Rights Reserved 
        </div>
        <script src="<?php echo asset_url();?>global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo asset_url();?>global/scripts/app.min.js" type="text/javascript"></script>
    </body>
</html>