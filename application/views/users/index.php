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
          <span class="caption-subject bold capitalize">All User details</span>
      </div>
      <div class="tools" id="buttons-container">
        <a href="<?php echo site_url('users/add');?>" type="button" class="btn red add-button"><i class="fa fa-plus pr-5"></i> Add</a>
      </div>
  </div>
  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dt-responsive display responsive" width="100%" id="user_tbl">
      <thead>
        <tr>
          <th class="min-tablet">
            <label class="mt-checkbox mt-checkbox-outline">
              <input type="checkbox" name="active_user_list" id="active_user_list" checked> 
              <span></span>                        
            </label>
          </th>
          <th class="min-tablet">First Name</th>
          <th class="all">Last Name</th>
          <th class="min-desktop">User Name</th>                                         
          <th class="min-desktop">Email Id</th>  
          <th class="min-desktop">Action</th>                                                                           
        </tr>
      </thead>
      <tbody>
            
      </tbody>
    </table>
  </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->                                    
<!-- END PAGE CONTENT INNER -->
<script>
    var get_user_list_url = "<?php echo site_url('users/get_all_user');?>";
    var delete_user_url = "<?php echo site_url('users/delete_user_url');?>";
    var user_admin_url  = "<?php echo site_url('users');?>";
</script>