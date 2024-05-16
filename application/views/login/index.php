<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="login-proc.php" method="post">
    <input type="hidden" name="formkey" id="formkey1" value="5f7d99d1d77285454d4e3fb788756f5a">
    <h3 class="form-title"><i class="fa fa-lock"></i>&nbsp;Sign In</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter your email and password. </span>
    </div>                                                                                         
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
    <div class="form-actions">
        <button type="submit" class="btn red uppercase">Login</button>
        <a href="<?php echo site_url('forgot_password');?>" id="forget-password" class="forget-password">Forgot Password?</a>
    </div>
     <div class="create-account">
        <p>
            <a href="<?php echo site_url('register');?>" id="register-btn" class="uppercase">Create an account</a>
        </p>
    </div>
</form>
<!-- END LOGIN FORM -->