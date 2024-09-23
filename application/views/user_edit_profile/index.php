<!-- BEGIN REGISTRATION FORM -->
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
<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('user_edit_profile');?>"  id="user_edit_form">
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_details['ID']; ?>">
  <input type="hidden" name="password" id="password" value="<?php echo $user_details['Password'];?>" /> 
  <input type="hidden" name="old_image" id="old_image" value="<?php echo $user_details['UserImageUrl'];?>" /> 
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="pull-right">
        <a href="<?php echo site_url('dashboard');?>" type="button" class="btn red"><i class="fa fa-undo pr-5"></i> Back</a>
      </div>
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Edit Profile</span>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label"><b>First Name</b> <span class="text-danger">*</span></label>
          <input type="text" placeholder="Enter First Name" autocomplete="off" name="first_name" id="first_name" class="form-control" value="<?php echo (set_value('first_name')) ? set_value('first_name') : $user_details['FirstName'];?>" />
        </div>
        <div class="form-group">
          <label class="control-label"><b>Last Name</b> <span class="text-danger">*</span></label>
          <input type="text" placeholder="Enter Last Name" autocomplete="off" name="last_name" id="last_name" class="form-control" value="<?php echo (set_value('last_name')) ? set_value('last_name') : $user_details['LastName'];?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>User Name </b></label>
          <input type="text" readonly placeholder="Enter User Name" autocomplete="off" name="user_name" id="user_name" class="form-control" value="<?php echo (set_value('user_name')) ? set_value('user_name') : $user_details['UserName'];?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Email</b> </label>
          <input type="text" readonly placeholder="Enter Email" autocomplete="off" name="email" id="email" class="form-control" value="<?php echo (set_value('email')) ? set_value('email') : $user_details['Email'];?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" autocomplete="off" name="new_password" id="new_password" class="form-control" value="<?php echo set_value('new_password');?>" /> 
        </div>
        
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label"><b>Date of birth</b> <span class="text-danger">*</span></label>
          <input type="date" autocomplete="off" name="DOB" id="DOB" class="form-control" value="<?php echo (set_value('DOB')) ? set_value('DOB') : $user_details['DOB'];?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Date of join</b> <span class="text-danger">*</span></label>
          <input type="date" autocomplete="off" name="DOJ" id="DOJ" class="form-control" value="<?php echo (set_value('DOJ')) ? set_value('DOJ') : date('Y-m-d', strtotime($user_details['DOJ']));?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>User photo</b></label>
          <input type="file" name="attachment1" id="attachment1"/>
          <br>
          <img id="previewImage" class="w-100" 
             src="<?php echo !empty($user_details['UserImageUrl']) ? asset_url().'images/user/'.$user_details['UserImageUrl'] : ''; ?>"
             alt="User Image Preview" style="display:<?php echo !empty($user_details['UserImageUrl']) ? 'block' : 'none'; ?>;">

          <br>
          <span id="noImageText" style="display:<?php echo empty($user_details['UserImageUrl']) ? 'block' : 'none'; ?>;">
              No image selected
          </span>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
      <a href="<?php echo site_url('dashboard');?>" type="button" class="btn red"><i class="fa fa-times pr-5"></i> Cancel</a>
    </div>
  </div>
</form>
<script>
   var check_email_url = "<?php echo site_url('users/edit_check_email');?>";
   var check_user_name_url = "<?php echo site_url('users/edit_check_user_name');?>";
</script>
