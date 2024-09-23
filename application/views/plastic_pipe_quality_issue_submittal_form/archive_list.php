 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light ">
  <div class="portlet-title">
      <div class="caption font-dark">
          <i class="fa fa-cubes font-dark"></i>
          <span class="caption-subject bold capitalize">All Archive List</span>
      </div>
      <div class="tools" id="buttons-container">
        <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form/export_archive_excel'); ?>" type="button" id="export_archive_excel" class="btn dark"><i class="fa fa-download"></i> Export Excel</a>
        <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form/export_archive_pdf'); ?>" type="button" id="export_archive_pdf" class="btn red add-button"><i class="fa fa-file-pdf-o pr-5"></i>Export PDF</a>
      </div>
  </div>
  <div class="portlet-body">
    <table class="table table-striped table-bordered dt-responsive display responsive more_info_table" width="100%" id="archive_list_tbl">
      <thead>
        <tr>
          <th></th>
          <th>Timestamp</th>
          <th>Complaint Number</th>
          <th class="min-desktop">Company Name</th>
          <th class="all">Location</th>
          <th class="min-desktop">Severity Level</th> 
        </tr>
      </thead>
      <tbody>
            
      </tbody>
    </table>
  </div>
</div>
<script>
  var get_submittal_form_list_url = "<?php echo site_url('plastic_pipe_quality_issue_submittal_form/get_all_archive_data');?>";
</script>
<!-- END EXAMPLE TABLE PORTLET-->                                    
<!-- END PAGE CONTENT INNER -->