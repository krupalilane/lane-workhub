 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<?php if($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php } ?>
<?php if($this->session->flashdata('error')) { ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light ">
  <div class="portlet-title">
      <div class="caption font-dark">
          <i class="fa fa-cubes font-dark"></i>
          <span class="caption-subject bold capitalize">Plants details</span>
      </div>
      <div class="tools" id="buttons-container">
        <a href="<?php echo site_url('plants/add');?>" type="button" class="btn red add-button"><i class="fa fa-plus pr-5"></i> Add</a>
        <a href="#" type="button" id="export_plan_excel" class="btn dark"><i class="fa fa-download"></i> Export Excel</a>
        <a href="#" type="button" class="btn red add-button"><i class="fa fa-file-pdf-o pr-5"></i>Export PDF</a>
      </div>
  </div>
  <div class="portlet-body">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label"><b>Select Division</b></label>
          <select class="form-control" name="plant_name" id="plant_name">
            <?php foreach ($all_division_db as $key => $division) {  ?>
              <option value="<?php echo $division['Plant']; ?>"><?php echo $division['Plant']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label"><b>Select year</b></label>
          <select class="form-control" name="year" id="year">
            <?php foreach ($all_year_db as $key => $year) {  ?>
              <option value="<?php echo $year['Year']; ?>"><?php echo $year['Year']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="plant-table table-responsive">
            <table class="table table-striped table-bordered table-hover dt-responsive display responsive">
                <thead id="plants_thead">
                    
                </thead>
                <tbody id="plants_tbody">
                    <!-- Dynamic rows will be appended here -->
                </tbody>          
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit_plan_details_modal" tabindex="-1" role="dialog" aria-labelledby="planModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="planModalLabel">Edit Plan Details</h3>
      </div>
      <form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('plants/edit');?>"  id="edit_plants_form">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label"><b>Division: </b></span></label>
                <input type="text" id="edit_plan_division" name="edit_plan_division" readonly class="form-control" />
                <input type="hidden" id="edit_plan_id" name="edit_plan_id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label"><b>Category: </b></span></label>
                <input type="text" id="edit_plan_category" name="edit_plan_category" readonly class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label"><b>Sub Category: </b></span></label>
                <input type="text" id="edit_plan_sub_category" name="edit_plan_sub_category" readonly class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label"><b>Year: </b></span></label>
                <input type="text" id="edit_plan_year" name="edit_plan_year" readonly class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label"><b>Quarter: </b></span></label>
                <input type="text" id="edit_plan_quarter" name="edit_plan_quarter" readonly class="form-control" /> 
              </div>
              <div class="form-group">
                <label class="control-label"><b>Actual/Planned: </b></span></label> 
                <input type="text" id="edit_plan_actual" name="edit_plan_actual" readonly class="form-control" /> 
              </div>
              <div class="form-group">
                <label class="control-label"><b>Value:</b> <span class="text-danger">*</span></label>
                <input type="text" id="edit_plan_value" name="edit_plan_value" class="form-control" /> 
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id="EditplanButton" class="btn red">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END EXAMPLE TABLE PORTLET--> 
<script type="text/javascript">
  var get_plants_details_url = "<?php echo site_url('Plants/get_all_plants_data');?>";
  var export_excle_plants_url = "<?php echo site_url('Export/exportExcel');?>";
</script>