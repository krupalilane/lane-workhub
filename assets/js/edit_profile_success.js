var logout_url = "<?php echo site_url('login/logout'); ?>";
jQuery(document).ready(function() {          
    bootbox.alert({
        title: "<i class='fa fa-question-circle'></i>&nbsp;Success!",
        message: "Your password has been updated successfully <br> Click on Okay button for logged in back!",
        closeButton: false,
        buttons: {
            ok: {
                label: '<i class="fa fa-check"></i> Okay',
                className: 'btn red'
            }
        },
            callback: function () {
                window.location.href = logout_url;
            }
    });
});