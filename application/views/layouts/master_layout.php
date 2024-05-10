<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>StormStorage Online Configuration Tool | Lane Enterprises, Inc.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="author" />    
    
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
            <link href="<?php echo asset_url();?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo asset_url();?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo asset_url();?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo asset_url();?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
            <link href="<?php echo asset_url();?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
            <link href="<?php echo asset_url();?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo asset_url();?>global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo asset_url();?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
            <link href="<?php echo asset_url();?>layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo asset_url();?>layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
            <link href="<?php echo asset_url();?>layouts/layout3/css/custom.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="<?php echo asset_url();?>css/toastr.min.css">
        <?php
        if (isset($style_links) && is_array($style_links)) {
            foreach ($style_links as $style_link) {
                echo style_link($style_link);
            }
        }
        ?>
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />

    </head>
    <!-- END HEAD -->
    <body class="page-container-bg-solid">
        <div class="page-wrapper">
           <?php echo $yield_header; ?> 
           <div class="page-wrapper-row full-height">
               <div class="page-wrapper-middle">
                   <!-- BEGIN CONTAINER -->
                   <div class="page-container-fluid">
                       <!-- BEGIN CONTENT -->
                       <div class="page-content-wrapper">
                           <!-- BEGIN CONTENT BODY -->

                           <!-- BEGIN PAGE CONTENT BODY -->
                           <div class="page-content">
                               <div class="container-fluid">
                                   <!-- BEGIN PAGE BREADCRUMBS -->
                                    <ul class="page-breadcrumb breadcrumb">
                                        <?php if(isset($breadcrumb) && !empty($breadcrumb)){ 
                                            foreach ($breadcrumb as $key => $breadcrumb_data) {
                                                ?>
                                                <li>
                                                    <?php if (!empty($breadcrumb_data['url'])) { ?>
                                                       <a href="<?php echo $breadcrumb_data['url']; ?>"><?php echo $breadcrumb_data['name']; ?></a>
                                                    <?php }else{ ?>
                                                      <span><?php echo $breadcrumb_data['name']; ?></span>
                                                    <?php }
                                                    $i = $key + 1;
                                                    if ($i < count($breadcrumb)) { ?>
                                                        <i class="fa fa-circle"></i>
                                                    <?php } ?>
                                                </li>
                                            <?php }
                                        } ?>
                                   </ul>
                                   <!-- END PAGE BREADCRUMBS -->
                                   <!-- BEGIN PAGE CONTENT INNER -->
                                   <div class="page-content-inner">
                                        <?php echo $yield; ?>
                                    </div>
                                </div>
                            <!-- END PAGE CONTENT INNER -->
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                            </div>
                        <!-- END CONTENT -->
                        </div>
                    <!-- END CONTAINER -->
                    </div>
                </div>
            </div>
           <?php echo $yield_footer; ?>
        </div>
        <?php echo $yield_js; ?>
    </body>
</html>