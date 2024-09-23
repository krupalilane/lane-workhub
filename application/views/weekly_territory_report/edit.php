<?php if($this->session->flashdata('error')) { ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('weekly_territory_report/edit/'.$report_data['ID']);?>" class="complaint_form"  id="add_weekly_form">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="pull-right">
        <a href="<?php echo site_url('weekly_territory_report');?>" type="button" class="btn red"><i class="fa fa-undo pr-5"></i> Back</a>
      </div>
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Edit West Coast Weekly Territory Report:</span>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <div class="form-group">
          <input type="hidden" name="old_image" id="old_image" value="<?php echo $report_data['ImageUrl'];?>" />
          <label class="control-label capitalize"><b>Week Ending <span class="text-danger">*</span></b></label>
          <input type="date" id="WeekEnding" name="WeekEnding" class="form-control" value="<?php echo $report_data['WeekEnding']; ?>" />
          <input type="hidden" id="ID" name="ID" class="form-control" value="<?php echo $report_data['ID']; ?>" />
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b> Name <span class="text-danger">*</span></b></label>
          <input type="text" readonly name="Name" id="Name" class="form-control" placeholder="Please Enter Name" value="<?php echo $report_data['Name']; ?>">
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b> General Overview <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="GeneralOverview" id="GeneralOverview" class="form-control editor"><?php echo $report_data['GeneralOverview']; ?></textarea>
          <p class="error GeneralOverview_error_message m-0"></p>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b> Goal For This Week <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="GoalforthisWeek" id="GoalforthisWeek" class="form-control editor"><?php echo $report_data['GoalforthisWeek']; ?></textarea>
          <p class="error GoalforthisWeek_error_message m-0"></p>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Key Sales Calls</b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="KeySalesCalls" id="KeySalesCalls" class="form-control editor"><?php echo $report_data['KeySalesCalls']; ?></textarea>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b> Insights Accomplishments</b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="InsightsAccomplishments" id="InsightsAccomplishments" class="form-control editor"><?php echo $report_data['InsightsAccomplishments']; ?></textarea>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b> Competitive Insights <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="CompetitiveInsights" id="CompetitiveInsights" class="form-control editor"><?php echo $report_data['CompetitiveInsights']; ?></textarea>
          <p class="error CompetitiveInsights_error_message m-0"></p>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b> Next Week Plans Goals <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="NextWeekPlansGoals" id="NextWeekPlansGoals" class="form-control editor"><?php echo $report_data['NextWeekPlansGoals']; ?></textarea>
          <p class="error NextWeekPlansGoals_error_message m-0"></p>
        </div>
        <div class="form-group">
          <label class="control-label"><b>Upload photo</b></label>
          <input type="file" name="attachment1" id="attachment1"/>
          <br>
          <img id="previewImage" class="w-100" 
             src="<?php echo !empty($report_data['ImageUrl']) ? asset_url().'images/weekly_territory_report/'.$report_data['ImageUrl'] : ''; ?>"
             alt="User Image Preview" style="display:<?php echo !empty($report_data['ImageUrl']) ? 'block' : 'none'; ?>;">

          <br>
          <span id="noImageText" style="display:<?php echo empty($report_data['ImageUrl']) ? 'block' : 'none'; ?>;">
              No image selected
          </span>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
      <a href="<?php echo site_url('weekly_territory_report');?>" type="button" class="btn red"><i class="fa fa-times pr-5"></i> Cancel</a>
    </div>
  </div>
</form>

