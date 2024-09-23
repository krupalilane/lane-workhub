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
          <span class="caption-subject bold">All West Coast Weekly Territory Report</span>
      </div>
      <div class="tools" id="buttons-container">
        <?php if ($this->permission_for_site != 'view') { ?>
          <a href="<?php echo site_url('weekly_territory_report/add');?>" type="button" class="btn red add-button"><i class="fa fa-plus pr-5"></i> Add</a>
        <?php } ?>
      </div>
  </div>
    <div class="row">
      <div class='col-md-3'>
          <div class="form-group">
            <label><b>Date Range</b></label>
             <div class='input-group date' id='datetimepicker6'>
                <input type='text' class="form-control" id="daterange" />
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
             </div>
          </div>
       </div>
       <div class="col-md-4">
         <label><b>Select Employee</b></label>
         <?php
         $people = [1,2];
          if(in_array($this->session->userdata('user')['Role'], $people)) { ?>  
            <select class="form-control" id="employee">
              <option value="0">Select Employee</option>
              <?php 
                if (!empty($user_data)) {
                  foreach ($user_data as $key => $user) { ?>
                    <option value="<?php echo $user['UserId']; ?>"><?php echo $user['UserName']; ?></option>
                  <?php }
                }
              ?>
            </select>
          <?php }else{ ?>
            <select class="form-control" id="employee" readonly>
              <option value="<?php echo $this->session->userdata('user')['id']; ?>"><?php echo $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname']; ?></option>
            </select>
          <?php } ?>
       </div>
    </div>
    <table class="table table-striped table-bordered dt-responsive display responsive weekly-tbl" width="100%" id="complaint_list_tbl">
      <thead>
        <tr>
          <th></th>
          <th>Week Ending</th>
          <th>Name</th>
          <th>General Overview</th>
          <th>Goals For This Week</th>
          <th>Key Sales Calls</th>
          <th>Insights & Accomplishments</th>
          <th>Competitive Insights</th>
          <th>Next Week Plans/Goals</th>
          <th></th> 
        </tr>
      </thead>
      <tbody>
            
      </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div class="modal fade modal-xl" id="report_view_modal" tabindex="-1" role="dialog" aria-labelledby="ComplaintModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 class="modal-title" id="ComplaintModalLabel">Weekly Territory Report Details</h3>
      </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label capitalize"><b>Week Ending</b></label>
                  <input type="text" readonly id="WeekEnding" name="WeekEnding" class="form-control" />
                </div>
                <div class="form-group">
                  <label class="control-label capitalize"><b> Name</b></label>
                  <input type="text" readonly name="Name" id="Name" class="form-control" placeholder="Please Enter Name">
                </div>
                <div class="form-group">
                  <label class="control-label capitalize"><b> General Overview</b></label>
                  <textarea readonly rows="5" autocomplete="off" name="GeneralOverview" id="GeneralOverview" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label capitalize"><b> Goal For This Week</b></label>
                  <textarea readonly rows="5" autocomplete="off" name="GoalforthisWeek" id="GoalforthisWeek" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label capitalize"><b>Key Sales Calls</b></label>
                  <textarea readonly rows="5" autocomplete="off" name="KeySalesCalls" id="KeySalesCalls" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label capitalize"><b> Insights Accomplishments</b></label>
                  <textarea readonly rows="5" autocomplete="off" name="InsightsAccomplishments" id="InsightsAccomplishments" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label capitalize"><b> Competitive Insights</b></label>
                  <textarea readonly rows="5" autocomplete="off" name="CompetitiveInsights" id="CompetitiveInsights" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label capitalize"><b> Next Week Plans Goals</b></label>
                  <textarea readonly rows="5" autocomplete="off" name="NextWeekPlansGoals" id="NextWeekPlansGoals" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <div id="imageContainer"></div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script>
  var get_all_weekly_report = "<?php echo site_url('Weekly_territory_report/get_all_weekly_report');?>";
  var get_report_data_url = "<?php echo site_url('Weekly_territory_report/get_report_data');?>";
</script>
<!-- END EXAMPLE TABLE PORTLET-->                                    
<!-- END PAGE CONTENT INNER -->