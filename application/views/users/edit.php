<!-- BEGIN REGISTRATION FORM -->
<?php if($this->session->flashdata('error')) { ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('users/edit/'.$user_details['ID']);?>"  id="user_edit_form">
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_details['ID']; ?>">
  <input type="hidden" name="password" id="password" value="<?php echo $user_details['Password'];?>" /> 
  <input type="hidden" name="old_image" id="old_image" value="<?php echo $user_details['UserImageUrl'];?>" />
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="pull-right">
        <a href="<?php echo site_url('users');?>" type="button" class="btn red"><i class="fa fa-undo pr-5"></i> Back</a>
      </div>
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Edit User Form</span>
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
          <label class="control-label"><b>User Name </b><span class="text-danger">*</span></label>
          <input type="text" placeholder="Enter User Name" autocomplete="off" name="user_name" id="user_name" class="form-control" value="<?php echo (set_value('user_name')) ? set_value('user_name') : $user_details['UserName'];?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Email</b> <span class="text-danger">*</span></label>
          <input type="text" placeholder="Enter Email" autocomplete="off" name="email" id="email" class="form-control" value="<?php echo (set_value('email')) ? set_value('email') : $user_details['Email'];?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" autocomplete="off" name="new_password" id="new_password" class="form-control" value="<?php echo set_value('new_password');?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Role</b> <span class="text-danger">*</span></label>
          <select name="Role" id="Role" class="form-control">
            <option value="3" <?php if (!empty($user_details['Role']) && $user_details['Role'] == 3) { echo 'selected'; } ?>>User</option>
            <option value="2" <?php if (!empty($user_details['Role']) && $user_details['Role'] == 2) { echo 'selected'; } ?>>Admin</option>
          </select>
        </div>
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
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label">Site Permission:</label>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <td></td>
                <td>Site Name</td>
                <td>Site Permission</td>
                <td>Action Permission</td>
                <td>Favorite</td>
              </tr>
            </thead>
            <?php foreach ($site_details as $key => $site_data) {
              if ($site_data['SiteID'] != 1) {
                $site_id = $site_data['SiteID'];
                $site_permission_old_data = '';
                if (!empty($user_site_permission)) {
                  $filtered = array_filter($user_site_permission, function($permission) use ($site_id) {
                      return $permission['SiteId'] == $site_id;
                  });
                  $site_permission_old_data = reset($filtered);
                } 
            ?>
              <tr>
                <td width="10%" class="text-center"><img src="<?php echo asset_url();?>site-logo/<?php echo $site_data['SmallLogoName']; ?>" alt="logo" class="logo-default w-50"></td>
                <td><?php echo $site_data['SiteName']; ?></td>
                <td class="text-center">
                  <label class="mt-checkbox mt-checkbox-outline">
                    <input class="site_permission_list" type="checkbox" name="site_permission_list[<?php echo $key - 1; ?>]" data-id="<?php echo $key; ?>" id="site_permission_list_<?php echo $key; ?>" value="<?php echo $site_data['SiteID']; ?>"  
                    <?php 
                      if (!empty($site_permission_old_data)) {
                        echo 'checked';
                      }
                    ?> />
                   <span></span>                        
                  </label>
                </td>
                <td class="text-center">
                  <select class="form-control" name="site_permission_role[<?php echo $key - 1; ?>]" id="site_permission_role<?php echo $key; ?>">
                    <option value="2" <?php if (!empty($site_permission_old_data) && $site_permission_old_data['SiteRoleId'] == 2) { echo 'selected'; } ?>>View</option>
                    <option value="1" <?php if (!empty($site_permission_old_data) && $site_permission_old_data['SiteRoleId'] == 1) { echo 'selected'; } ?>>All</option>
                    <option value="3" <?php if (!empty($site_permission_old_data) && $site_permission_old_data['SiteRoleId'] == 3) { echo 'selected'; } ?>>Add,Edit</option>
                  </select>
                </td>
                <td class="text-center">
                  <label class="star-checkbox">
                      <input type="checkbox" name="favorite[<?php echo $key - 1; ?>]" id="favorite<?php echo $key; ?>"
                      <?php 
                        if (!empty($site_permission_old_data) && $site_permission_old_data['IsFavorite'] == 1) {
                          echo 'checked';
                        }
                      ?>
                      />
                      <i class="fa fa-star"></i>
                  </label>
                </td>
              </tr>
            <?php } } ?>
          </table>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
      <a href="<?php echo site_url('users');?>" type="button" class="btn red"><i class="fa fa-times pr-5"></i> Cancel</a>
    </div>
  </div>
</form>
<script>
   var check_email_url = "<?php echo site_url('users/edit_check_email');?>";
   var check_user_name_url = "<?php echo site_url('users/edit_check_user_name');?>";
</script>
