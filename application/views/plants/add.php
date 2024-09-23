<!-- BEGIN REGISTRATION FORM -->
<?php if($this->session->flashdata('error')) { ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('plants/add');?>"  id="plants_add_form">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="pull-right">
        <a href="<?php echo site_url('plants');?>" type="button" class="btn red"><i class="fa fa-undo pr-5"></i> Back</a>
      </div>
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Add Plan Details</span>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label"><b>Division </b> <span class="text-danger">*</span></label>
          <select class="form-control" name="plant" id="plant">
            <?php foreach ($all_division_db as $key => $division) {  ?>
              <option value="<?php echo $division['Plant']; ?>"><?php echo $division['Plant']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label class="control-label"><b> Category</b> <span class="text-danger">*</span></label>
          <select class="form-control" name="category" id="category">
            
          </select>
        </div>
        <div class="form-group">
          <label class="control-label"><b>Sub Category </b><span class="text-danger">*</span></label>
          <select class="form-control" name="sub_categories" id="sub_categories">
            
          </select>
        </div>
        <div class="form-group">
          <label class="control-label"><b>Year</b> <span class="text-danger">*</span></label>
          <select class="form-control" name="year" id="year">
            <?php foreach ($all_year_db as $key => $year) {  ?>
              <option value="<?php echo $year['Year']; ?>"><?php echo $year['Year']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group mb-0">
          <label class="control-label"><b>Quarter:</b> <span class="text-danger">*</span></label>
          <div class="mt-radio-inline">
            <label class="mt-radio">
              <input type="radio" name="quater" id="quater" value="Q1" /> Q1
              <span></span>
            </label>
            <label class="mt-radio">
              <input type="radio" name="quater" id="quater" value="Q2" /> Q2
              <span></span>
            </label>
            <label class="mt-radio">
              <input type="radio" name="quater" id="quater" value="Q3" /> Q3
              <span></span>
            </label>
            <label class="mt-radio">
              <input type="radio" name="quater" id="quater" value="Q4" /> Q4
              <span></span>
            </label>
            <p class="quater_error_message m-0"></p>
          </div>
          <span></span>                                                            
        </div>
        <div class="form-group mb-0">
          <label class="control-label"><b>Actual/Planned:</b> <span class="text-danger">*</span></label>
          <div class="mt-radio-inline">
            <label class="mt-radio">
              <input type="radio" name="actual_planned" value="Actual" /> Actual
              <span></span>
            </label>
            <label class="mt-radio">
              <input type="radio" name="actual_planned" value="Planned" /> Planned
              <span></span>
            </label>
            <p class="actual_planned_error_message m-0"></p>
          </div>
          <span></span>                                                            
        </div>
        <div class="form-group">
          <label class="control-label"><b>Value</b> <span class="text-danger">*</span></label>
          <input type="text" placeholder="Enter Value" autocomplete="off" name="plan_value" id="plan_value" class="form-control" /> 
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
      <a href="<?php echo site_url('plants');?>" type="button" class="btn red"><i class="fa fa-times pr-5"></i> Cancel</a>
    </div>
  </div>
</form>
<script>
    var get_category = "<?php echo site_url('plants/get_category');?>";
    var get_sub_category = "<?php echo site_url('plants/get_sub_category');?>";
</script>