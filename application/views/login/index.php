<!-- BEGIN LOGIN FORM -->
<?php if($this->session->flashdata('error')) { ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<?php if($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php } ?>
<form id="login-form" action="<?php echo site_url('login/check_login');?>" method="post">
    <h3 class="form-title"><i class="fa fa-lock"></i>&nbsp;Sign In</h3>              
    <div class="form-group">
        <label class="control-label" for="email">Email</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" id="email" /> </div>
    <div class="form-group">
        <label class="control-label" for="password">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" /> </div>
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