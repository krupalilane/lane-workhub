 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<?php if($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php } ?>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light ">
  <div class="portlet-title">
      <div class="caption font-dark">
          <i class="fa fa-cubes font-dark"></i>
          <span class="caption-subject bold capitalize">All announcements details</span>
      </div>
      <div class="tools" id="buttons-container">
        <a href="<?php echo site_url('announcements/add');?>" type="button" class="btn red add-button"><i class="fa fa-plus pr-5"></i> Add</a>
      </div>
  </div>
  <div class="portlet-body">
    <table class="table table-striped table-bordered dt-responsive display responsive" width="100%" id="announcement_list_tbl">
      <thead>
        <tr>
          <th>
            <label class="mt-checkbox mt-checkbox-outline">
              <input type="checkbox" name="active_user_list" id="active_list" checked> 
              <span></span>                        
            </label>
          </th>
          <th>Id</th>
          <th>Header</th>
          <th>Details</th>
          <th class="min-desktop">Date</th> 
          <th>Action</th> 
        </tr>
      </thead>
      <tbody>
            
      </tbody>
    </table>
  </div>
</div>
<script>
  var get_announcement_form_list_url = "<?php echo site_url('announcements/get_all_announcements_data');?>";
  var delete_announcements_url = "<?php echo site_url('announcements/delete_announcements');?>";
  var announcements_admin_url  = "<?php echo site_url('announcements');?>";
</script>
<!-- END EXAMPLE TABLE PORTLET-->                                    
<!-- END PAGE CONTENT INNER -->