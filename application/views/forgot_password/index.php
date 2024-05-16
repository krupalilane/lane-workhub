<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form" action="login-forgot.php" method="post">
    <h3 class="form-title"><i class="fa fa-unlock"></i>&nbsp;Reset Password ?</h3>
    <p> Enter your e-mail address below to reset your password. </p>
    <div class="form-group">
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
    <div class="form-actions">
        <a href="<?php echo site_url('login');?>" id="back-btn" class="btn red">Back</a>
        <button type="submit" class="btn btn-red uppercase pull-right">Submit</button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->