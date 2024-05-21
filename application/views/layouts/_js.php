<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo asset_url();?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<script src="<?php echo asset_url();?>global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo asset_url();?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo asset_url();?>layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>    
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143718260-2"></script>
<script src="<?php echo asset_url();?>js/toastr.min.js"></script>
<script type="text/javascript">
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
</script>   
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config',UA-143718260-2);
</script>   
<!-- END THEME LAYOUT SCRIPTS -->        <!-- Include Page-Specific Scripting -->
<script src="https://lane.kbmax.com/js-bundles/embed"></script>
<script src="<?php echo asset_url();?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<?php if (isset($active_menu) && $active_menu == 'contact') { ?>
<script src="//maps.googleapis.com/maps/api/js?senson=true&v=3&key=AIzaSyAXtrz-TkYuwJ6CdZwKOBfGWbORHyhWrNI" type="text/javascript"></script>
<?php } ?>
<?php
if (isset($js_links) && is_array($js_links)) {
    foreach ($js_links as $js_link) {
        echo js_link($js_link);
    }
}
if (isset($javascripts) && is_array($javascripts)) {
    foreach ($javascripts as $javascript) {
        echo js($javascript);
    }
}
?>
<script type="text/javascript">
    var logout_url = "<?php echo site_url('login/logout'); ?>";
    jQuery(document).ready(function() {          
        $('#logout_confirm').click(function(){
            bootbox.confirm({
                title: "<i class='fa fa-question-circle'></i>&nbsp;Log Out?",
                message: "Are you sure that you want to log out of the Storm-Storage Portal?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel',
                        className: 'btn dark'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm',
                        className: 'btn red'
                    }
                },
                callback: function (result) {
                    if(result === true) {
                        window.location.href = logout_url;
                    }
                    else {
                        $('.bootbox.modal').modal('hide');
                    }
                }
            });
        }); 
    });
</script>   