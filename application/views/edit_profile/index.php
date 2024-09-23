<form role="form" method="post" autocomplete="off" enctype="multipart/form-data" action="<?php echo site_url('edit_profile/update_user_password');?>" id="password_form">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Change Password:</span>
      </div>
    </div>
    <div class="panel-body">
        <div class="note note-danger">
         <p> Passwords MUST be <strong>between 8 and 20 characters in length</strong> and MUST contain <strong>lowercase letters</strong>, <strong>uppercase letters</strong> and <strong>digits</strong>.</p><br>
         <p> Trouble choosing a password?  Here are some randomly generated examples that meet the requirements:</p><br>
         <?php if ($passwords) {
             foreach ($passwords as $key => $password) { ?>
                 <p><strong><?php echo $password; ?></strong></p>
             <?php }
         } 
         ?>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">New Password</label>
                <input type="password" autocomplete="off" name="newpassword" id="newpassword" class="form-control input-xlarge" /> </div>
            <div class="form-group">
                <label class="control-label">Re-type New Password</label>
                <input type="password" autocomplete="off" name="rnewpassword" id="rnewpassword" class="form-control input-xlarge" /> </div>
            <div class="margin-top-10">
                <input type="submit" class="btn red" value="Change Password">
            </div>
        </div>
    </div>
</div>
</form>
