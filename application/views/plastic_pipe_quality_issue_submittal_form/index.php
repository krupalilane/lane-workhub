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
          <span class="caption-subject bold capitalize">All Quality Issue Form details</span>
      </div>
      <div class="tools" id="buttons-container">
        <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form/add');?>" type="button" class="btn red add-button"><i class="fa fa-plus pr-5"></i> Add</a>
        <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form/export_complaint_excel'); ?>" type="button" id="export_archive_excel" class="btn dark"><i class="fa fa-download"></i> Export Excel</a>
        <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form/export_complaint_pdf'); ?>" type="button" id="export_archive_pdf" class="btn red add-button"><i class="fa fa-file-pdf-o pr-5"></i>Export PDF</a>
      </div>
  </div>
  <div class="portlet-body">
    <table class="table table-striped table-bordered dt-responsive display responsive" width="100%" id="complaint_list_tbl">
      <thead>
        <tr>
          <th></th>
          <th>Date Of Submittal</th>
          <th>Associated Logging Number</th>
          <th>Severity Level</th>
          <th>Complaint Category</th>
          <th>Date Of Issue</th>
          <th>Submited By</th>
          <th>Shipping Site Or Customer Location</th>
          <th></th> 
        </tr>
      </thead>
      <tbody>
            
      </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<div class="modal fade modal-xl" id="complaint_view_modal" tabindex="-1" role="dialog" aria-labelledby="ComplaintModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 class="modal-title" id="ComplaintModalLabel">Complaint Details</h3>
      </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12" id="complaint_image">
                <p class="m-5"><b>Images: </b></p>
              </div>
              <div class="col-md-6">
                <p class="m-5"><b>Associated Logging Number: </b><span id="AssociatedLoggingNumber"></span></p>
                <p class="m-5"><b>Date of Submit: </b><span id="DateOfSubmittal"></span></p>
                <p class="m-5"><b>Date Of Issue: </b><span id="DateOfIssue"></span></p>
                <p class="m-5"><b>Complaint Category: </b><span id="ComplaintCategory"></span></p>
                <p class="m-5"><b>Severity Level: </b><span id="SeverityLevel"></span></p>
                <p class="m-5"><b>Shipping Site Or Customer Location: </b><span id="ShippingSiteOrCustomerLocation"></span></p>
                <p class="m-5"><b>Shipment Delivery T-Number: </b><span id="ShipmentDeliveryTNumber"></span></p>
                <p class="m-5"><b>How Failure Non conformance Identified: </b><span id="HowFailureNonconformanceIdentified"></span></p>
                <p class="m-5"><b>Complaint Summary: </b><span id="ComplaintSummary"></span></p>
                <p class="m-5"><b>Next Steps Taken: </b><span id="NextStepsTaken"></span></p>
              </div>
              <div class="col-md-6">
                <p class="m-5"><b style="color: #b52024;">Root Cause: </b><span id="RootCause"></span></p>
                <p class="m-5"><b style="color: #b52024;">Preventative Action: </b><span id="PreventativeAction"></span></p>
                <p class="m-5"><b style="color: #b52024;">Corrective Action: </b><span id="CorrectiveAction"></span></p>
                <p class="m-5"><b style="color: #b52024;">Resolved By: </b><span id="ResolvedBy"></span></p>
                <p class="m-5"><b style="color: #b52024;">Resolved Date: </b><span id="ResolvedDate"></span></p>
              </div>
              <div class="col-md-12">
                <p class="m-5"><b>Product Details: </b></p>
                <table class="table table-bordered mt-5">
                  <thead>
                    <tr>
                      <th>Location</th>
                      <th>Line Number And Name</th>
                      <th>Fitting Description</th>
                      <th>Product Diameter</th>
                      <th>Product Flavour</th>
                      <th>Product Length</th>
                      <th>Product Type</th>
                      <th>Bell Type</th>
                      <th>Product Perf</th>
                      <th>Product Shift</th>
                    </tr>
                  </thead>
                  <tbody id="tbl_product_details">
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade modal-xl" id="complaint_image_modal" tabindex="-1" role="dialog" aria-labelledby="ComplaintModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 class="modal-title" id="ComplaintModalLabel">Complaint Image</h3>
      </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <img id="zoom_complaint_image_big" src="">
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script>
  var get_submittal_form_list_url = "<?php echo site_url('plastic_pipe_quality_issue_submittal_form/get_all_complaint_data');?>";
  var get_complaint_data_url = "<?php echo site_url('plastic_pipe_quality_issue_submittal_form/get_complaint_details');?>";
</script>
<!-- END EXAMPLE TABLE PORTLET-->                                    
<!-- END PAGE CONTENT INNER -->