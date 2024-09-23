<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form/save_complaint_response');?>" class="complaint_form"  id="edit_complaint_form">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="pull-right">
        <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form');?>" type="button" class="btn red"><i class="fa fa-undo pr-5"></i> Back</a>
      </div>
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Edit Complaint details:</span>
        <span class="caption-subject bold capitalize">(Complaint Submitted by: <?php echo $complaint_details['SubmittedByUser']; ?>)</span>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
      <input type="hidden" name="Id" id="Id" value="<?php echo $complaint_details['ID']; ?>">
        <div class="form-group">
          <label class="control-label capitalize"><b>Date of submit</b></label>
          <input type="text" readonly name="date_submit" class="form-control" value="<?php echo $complaint_details['DateOfSubmittal']; ?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Associated logging number</b></label>
          <input type="text" readonly name="associated_num" class="form-control" value="<?php echo $complaint_details['AssociatedLoggingNumber']; ?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label"><b>Complaint category</b></label>
          <input type="text" readonly name="complaint_category" class="form-control" value="<?php echo $complaint_details['ComplaintCategory']; ?>" /> 
        </div>
        <div class="form-group mb-0">
          <label class="control-label capitalize"><b>Location Submitting for</b></label>
            <div class="mt-radio-inline">
              <input type="hidden" name="location_submitting" value="<?php echo $complaint_details['ShippingSiteOrCustomerLocation']; ?>">
              <label class="mt-radio">
                <input type="radio" disabled <?php if ($complaint_details['ShippingSiteOrCustomerLocation'] == 'Shipping Site'){
                echo 'checked' ; } ?> value="Shipping Site" />Shipping Site
                <span></span>
              </label>
              <label class="mt-radio">
                <input type="radio" disabled <?php if ($complaint_details['ShippingSiteOrCustomerLocation'] == 'Customer Location'){
                echo 'checked' ; } ?> value="Customer Location" />Customer Location<span></span>
              </label>
            </div>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Shipment or delivery T-number: </b> </label>
          <input type="text" placeholder="N/A" class="form-control" name="shipment_number" value="<?php if ($complaint_details['ShipmentDeliveryTNumber'] != 'N/A') { echo $complaint_details['ShipmentDeliveryTNumber']; }  ?>" /> 
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>Date of issue/occurrence</b></label>
          <input type="text" readonly name="date_issue" class="form-control" value="<?php echo $complaint_details['DateOfIssue']; ?>" />  
        </div>
        <div class="form-group mb-0">
          <label for="severityLevel capitalize"><b>Severity Level</b></label>
          <div class="mt-radio-inline">
            <input type="hidden" name="severity_level" value="<?php echo $complaint_details['SeverityLevel']; ?>">
            <label class="mt-radio">
              <input type="radio" disabled <?php if ($complaint_details['SeverityLevel'] == '1 - Cosmetic damage to outer appearance: forklift damage.'){
                echo 'checked' ; } ?> name="severity_level" /> 1 - Cosmetic damage to outer appearance: forklift damage.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" disabled <?php if ($complaint_details['SeverityLevel'] == '2 - Holes gouges, strapping damage, shipping damage.'){
                echo 'checked' ; } ?> name="severity_level" /> 2 - Holes gouges, strapping damage, shipping damage.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" disabled <?php if ($complaint_details['SeverityLevel'] == '3 - Defects found during pre-installation / installation: radial gap issues, bell liners, gasket issues, etc.'){
                echo 'checked' ; } ?> name="severity_level"  /> 3 - Defects found during pre-installation / installation: radial gap issues, bell liners, gasket issues, etc.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" disabled <?php if ($complaint_details['SeverityLevel'] == '4 - Post installation non-conformance.'){
                echo 'checked' ; } ?> name="severity_level" /> 4 - Post installation non-conformance.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" disabled <?php if ($complaint_details['SeverityLevel'] == '5 - Failure found in the field, structural issue requiring removal.'){
                echo 'checked' ; } ?> name="severity_level" /> 5 - Failure found in the field, structural issue requiring removal.
              <span></span>
            </label>
            <p class="severity_level_error_message m-0"></p>
          </div>
        </div>        
      </div>
      <hr>
      <div class="col-md-12">
        <table class="table table-bordered" id="dynamic_field">
          <thead>
            <tr>
              <th class="capitalize">Location</th>
              <th class="capitalize">Line Number And Name</th>
              <th class="capitalize">Fitting Description</th>
              <th class="capitalize">Product Diameter</th>
              <th class="capitalize">Product Flavour</th>
              <th class="capitalize">Product Length</th>
              <th class="capitalize">Product Type</th>
              <th class="capitalize">Bell Type</th>
              <th class="capitalize">Product Perf</th>
              <th class="capitalize">Product Shift</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($product_details)) {
              foreach ($product_details as $key => $product_data) { ?>
                <tr>
                  <td><?php echo $product_data['Location']; ?></td>
                  <td><?php echo $product_data['LineNumberName']; ?></td>
                  <td><?php echo $product_data['FittingDescription']; ?></td>
                  <td><?php echo $product_data['ProductDiameter']; ?></td>
                  <td><?php echo $product_data['ProductFlavour']; ?></td>
                  <td><?php echo $product_data['ProductLength']; ?></td>
                  <td><?php echo $product_data['ProductType']; ?></td>
                  <td><?php echo $product_data['BellType']; ?></td>
                  <td><?php echo $product_data['ProductPerf']; ?></td>
                  <td><?php echo $product_data['ProductShift']; ?></td>
                </tr>
            <?php }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>Next Steps Taken</b></label>
          <textarea readonly rows="5" placeholder="Your answer" autocomplete="off" name="next_step" id="next_step" class="form-control"><?php echo $complaint_details['NextStepsTaken']; ?></textarea>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"> <b>Uploaded photos</b></label>
          <?php if (!empty($photos)) {
            foreach ($photos as $key => $photo) { ?>
            <p class="m-0"></p>
            <img class="complaint_image zoom_complaint_image" data-imageurl="<?php echo asset_url().'images/complaint/'.$photo['QAComplaintId'].'/'.$photo['ImageName']; ?>" src="<?php echo asset_url().'images/complaint/'.$photo['QAComplaintId'].'/'.$photo['ImageName']; ?>">
          <?php } } else{ ?>
            <p class="m-0">No image.</p>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>How was Failure / nonconformance identified?</b></label>
          <textarea readonly rows="5" placeholder="Your answer" autocomplete="off" name="how_failure" id="how_failure" class="form-control"> <?php echo $complaint_details['HowFailureNonconformanceIdentified']; ?></textarea>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b> Complaint Summary</b></label>
          <textarea readonly rows="5" placeholder="Your answer" autocomplete="off" name="complaint_summary" id="complaint_summary" class="form-control"><?php echo $complaint_details['ComplaintSummary']; ?></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <hr>
        <b><h4 class="text-center heading-red">Response</h4></b>
        <hr>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>Root Cause: <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="root_cause" id="root_cause" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Preventive Measures Or Resolution: <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="resolution" id="resolution" class="form-control"></textarea>
        </div>        
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>Corrective Action: <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="corrective_action" id="corrective_action" class="form-control"></textarea> 
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Date Closed: <span class="text-danger">*</span></b></label>
          <input type="date" id="date_colsed" max="<?php echo date('Y-m-d'); ?>"  name="date_colsed" value="<?php echo date('Y-m-d'); ?>" class="form-control" /> 
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
      <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form');?>" type="button" class="btn red"><i class="fa fa-times pr-5"></i> Cancel</a>
    </div>
  </div>
</form>
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