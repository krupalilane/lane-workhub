<!-- BEGIN REGISTRATION FORM -->
<?php if($this->session->flashdata('error')) { ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('announcements/edit/'.$announcements_details['Id']);?>"  id="announcements_add_form">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="pull-right">
        <a href="<?php echo site_url('announcements');?>" type="button" class="btn red"><i class="fa fa-undo pr-5"></i> Back</a>
      </div>
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Edit Announcement Form</span>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label"><b>Annoucement Header</b> <span class="text-danger">*</span></label>
          <input type="text" placeholder="Enter Annoucement Header" autocomplete="off" name="header" id="header" class="form-control" value="<?php echo (set_value('header')) ? set_value('header') : $announcements_details['AnnoucementHeader'];?>" />
          <input type="hidden" name="ID" id="Id" class="form-control" value="<?php echo $announcements_details['Id'];?>" />
        </div>
        <div class="form-group">
          <label class="control-label"><b>To Be Announced On</b> <span class="text-danger">*</span></label>
          <input type="date" autocomplete="off" name="date" id="date" class="form-control" value="<?php echo (set_value('date')) ? set_value('date') : $announcements_details['AnnoucementDate'];?>"  /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Attachment 1</b><span class="text-danger">*</span></label>
           <input type="file" name="attachment1" id="attachment1" />
           <img id="previewImage1" class="w-100" style="display:none;" alt="Image Preview">
           <p id="noImageText1" style="display:block;">No image selected.</p>
           <div id="filePreview1" style="display:none;"></div>
           <div id="videoPreview1" style="display:none;"></div>
           <input type="hidden" name="old_image1" id="old_image1" value="<?php echo $announcements_details['FirstImageUrl']; ?>">
        </div>
        <div class="form-group">
          <label class="control-label"><b>Attachment 2</b><span class="text-danger">*</span></label>
           <input type="file" name="attachment2" id="attachment2" />
           <img id="previewImage2" class="w-100" style="display:none;" alt="Image Preview">
           <p id="noImageText2" style="display:block;">No image selected.</p>
           <div id="filePreview2" style="display:none;"></div>
           <div id="videoPreview2" style="display:none;"></div>
           <input type="hidden" name="old_image2" id="old_image2" value="<?php echo $announcements_details['SecondImageUrl']; ?>">
        </div>
        <div class="form-group">
          <label class="control-label"><b>Attachment 3</b><span class="text-danger">*</span></label>
           <input type="file" name="attachment3" id="attachment3" />
           <img id="previewImage3" class="w-100" style="display:none;" alt="Image Preview">
           <p id="noImageText3" style="display:block;">No image selected.</p>
           <div id="filePreview3" style="display:none;"></div>
           <div id="videoPreview3" style="display:none;"></div>
           <input type="hidden" name="old_image3" id="old_image3" value="<?php echo $announcements_details['ThirdImageUrl']; ?>">
        </div>
      </div>
       <div class="col-md-6">
        <div class="form-group">
          <label class="control-label"><b>Announcement Content</b> <span class="text-danger">*</span></label>
          <textarea rows="15" placeholder="Your answer" autocomplete="off" name="Content" id="Content" class="form-control editor"><?php echo (set_value('Content')) ? set_value('Content') : $announcements_details['AnnouncementContent'];?></textarea>
        </div>
       </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
      <a href="<?php echo site_url('announcements');?>" type="button" class="btn red"><i class="fa fa-times pr-5"></i> Cancel</a>
    </div>
  </div>
</form>
<script>
   var check_email_url = "<?php echo site_url('users/check_email');?>";
   var check_user_name_url = "<?php echo site_url('users/check_user_name');?>";
   var asset_base_url = "<?php echo asset_url();?>";
</script>
