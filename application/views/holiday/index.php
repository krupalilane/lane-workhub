 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<?php if($this->session->flashdata('success')) { ?>
     <div class="alert alert-success alert-dismissible">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <?php echo $this->session->flashdata('success'); ?>
     </div>
<?php } ?>
<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('holiday/form_submit');?>"  id="add_holiday_form">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Holiday Form</span>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label"><b>Holiday Date</b> <span class="text-danger">*</span></label>
          <input type="date" autocomplete="off" name="holiday_date" id="holiday_date" class="form-control" value="<?php echo set_value('holiday_date');?>" /> 
          <input type="hidden"  name="Id" id="Id" class="form-control" value="0" /> 
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label"><b>Holiday Year</b> <span class="text-danger">*</span></label>
          <input type="text" readonly autocomplete="off" name="week_year" id="week_year" class="form-control" value="<?php echo set_value('week_year');?>" /> 
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label"><b>Holiday Week Day</b> <span class="text-danger">*</span></label>
          <input type="text" readonly autocomplete="off" name="week_day" id="week_day" class="form-control" value="<?php echo set_value('week_day');?>" /> 
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label"><b>Holiday Name</b> <span class="text-danger">*</span></label>
          <input type="text" autocomplete="off" name="holiday_name" id="holiday_name" class="form-control" value="<?php echo set_value('holiday_name');?>" /> 
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
    </div>
  </div>
</form>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light ">
  <div class="portlet-title">
      <div class="caption font-dark">
          <i class="fa fa-cubes font-dark"></i>
          <span class="caption-subject bold capitalize">All holiday details</span>
      </div>
  </div>
  <div class="portlet-body">
    <table class="table table-striped table-bordered dt-responsive display responsive" width="100%" id="holiday_list_tbl">
      <thead>
        <tr>
          <th><label class="mt-checkbox mt-checkbox-outline">
              <input type="checkbox" name="active_user_list" id="active_list" checked> 
              <span></span>                        
            </label> </th>
          <th>Id</th>
          <th>Year</th>
          <th>Holiday Date</th>
          <th>Week Day</th>
          <th class="min-desktop">Holiday Name</th> 
          <th>Action</th> 
        </tr>
      </thead>
      <tbody>
            
      </tbody>
    </table>
  </div>
</div>
<script>
  var get_holiday_form_list_url = "<?php echo site_url('holiday/get_all_holiday_data');?>";
  var get_holiday_data_url = "<?php echo site_url('holiday/get_holiday_data');?>";
  var delete_holiday_url = "<?php echo site_url('holiday/delete_holiday');?>";
  var holiday_admin_url  = "<?php echo site_url('holiday');?>";
  var check_holiday_duplicate_url  = "<?php echo site_url('holiday/check_duplicate_date');?>";
</script>
<!-- END EXAMPLE TABLE PORTLET-->                                    
<!-- END PAGE CONTENT INNER -->