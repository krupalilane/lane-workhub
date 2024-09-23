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
        <label class="control-label" for="username">Username<span class="text-danger"> *</span></label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username" /> </div>
    <div class="form-group">
        <label class="control-label" for="password">Password<span class="text-danger"> *</span></label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" /> </div>
    <div class="form-actions">
        <button type="submit" class="btn red-btn capitalize">Login</button>
    </div>
</form>
<!-- END LOGIN FORM -->