<form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form/save_complain');?>" class="complaint_form"  id="add_complaint_form">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="pull-right">
        <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form');?>" type="button" class="btn red"><i class="fa fa-undo pr-5"></i> Back</a>
      </div>
      <div class="caption font-dark pt-5 h-35">
        <i class="fa fa-cube font-dark"></i>
        <span class="caption-subject bold capitalize">Add Complaint Details:</span>
        <span class="caption-subject bold capitalize">(Complaint Submitted by: <?php echo $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'];?>)</span>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>Date Of Submit <span class="text-danger">*</span></b></label>
          <input type="date" readonly id="date_submit" name="date_submit" min="<?php echo date('Y-m-d'); ?>" class="form-control" value="<?php echo date('Y-m-d'); ?>" /> 
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Associated logging number</b></label>
          <input type="text" readonly name="associated_num" id="associated_num" class="form-control" /> 
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Complaint category <span class="text-danger">*</span></b></label>
          <select class="form-control" name="complaint_category" id="complaint_category">
            <?php foreach ($ComplaintCategory as $key => $category) {  ?>
              <option value="<?php echo $category['ComplaintCategory']; ?>"><?php echo $category['ComplaintCategory']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group mb-0">
          <label class="control-label capitalize"><b>Location Submitting for <span class="text-danger">*</span></b></label>
            <div class="mt-radio-inline">
              <label class="mt-radio">
                <input type="radio" name="location_submitting" value="Shipping Site" />Shipping Site
                <span></span>
              </label>
              <label class="mt-radio">
                <input type="radio" name="location_submitting" value="Customer Location" />Customer Location<span></span>
              </label>
              <p class="location_submitting_error_message m-0"></p>
            </div>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b>Shipment or delivery T-number: </b> </label>
          <input type="text" name="shipment_number" id="shipment_number" placeholder="N/A" class="form-control" /> 
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>Date of issue/occurrence <span class="text-danger">*</span></b></label>
          <input type="date" id="date_issue" name="date_issue" max="<?php echo date('Y-m-d'); ?>" class="form-control" value="<?php echo date('Y-m-d'); ?>" /> 
        </div>
        <div class="form-group mb-0">
          <label for="severityLevel capitalize"><b>Severity Level <span class="text-danger">*</span></b></label>
          <div class="mt-radio-inline">
            <label class="mt-radio">
              <input type="radio" name="severity_level" value="1 - Cosmetic damage to outer appearance: forklift damage." /> 1 - Cosmetic damage to outer appearance: forklift damage.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" name="severity_level" value="2 - Holes gouges, strapping damage, shipping damage." /> 2 - Holes gouges, strapping damage, shipping damage.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" name="severity_level" value="3 - Defects found during pre-installation / installation: radial gap issues, bell liners, gasket issues, etc." /> 3 - Defects found during pre-installation / installation: radial gap issues, bell liners, gasket issues, etc.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" name="severity_level" value="4 - Post installation non-conformance." /> 4 - Post installation non-conformance.
              <span></span>
            </label>
            <br>
            <label class="mt-radio">
              <input type="radio" name="severity_level" value="5 - Failure found in the field, structural issue requiring removal." /> 5 - Failure found in the field, structural issue requiring removal.
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
              <th class="capitalize">Location <span class="text-danger">*</span></th>
              <th class="capitalize">Line Number And Name <span class="text-danger">*</span></th>
              <th class="capitalize">Product Diameter <span class="text-danger">*</span></th>
              <th class="capitalize">Product Flavour <span class="text-danger">*</span></th>
              <th class="capitalize">Product Length <span class="text-danger">*</span></th>
              <th class="capitalize">Product Type <span class="text-danger">*</span></th>
              <th class="capitalize">Bell Type <span class="text-danger">*</span></th>
              <th class="capitalize">Product Perf <span class="text-danger">*</span></th>
              <th class="capitalize">Product Shift <span class="text-danger">*</span></th>
              <th class="capitalize"></th>
            </tr>
          </thead>
          <tr id="row1">
            <td>
              <select class="form-control dropdown_location product_location add_more_validation" name="location[]" id="location_1" data-rowid="1">
                <option value="">Select Location</option>
                <?php foreach ($location as $key => $location_data) {  ?>
                  <option value="<?php echo $location_data['Location']; ?>"><?php echo $location_data['Location']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select class="form-control lane-dropdown add_more_validation" name="line_number_and_name[]" id="line_number_and_name_1">
                <option value="">Select line</option>
              </select>
            </td>
            <td>
              <select class="form-control add_more_validation" name="product_diameter[]" id="product_diameter_1">
                <option value="">Select Diameter</option>
                <?php foreach ($ProductDiameter as $key => $diameter) {  ?>
                  <option value="<?php echo $diameter['ProductDiameter']; ?>"><?php echo $diameter['ProductDiameter']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select class="form-control add_more_validation" name="product_flavour[]" id="product_flavour_1">
                <option value="">Select Flavour</option>
                <?php foreach ($ProductFlavour as $key => $flavour) {  ?>
                  <option value="<?php echo $flavour['ProductFlavour']; ?>"><?php echo $flavour['ProductFlavour']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select class="form-control add_more_validation" name="product_length[]" id="product_length_1">
                <option value="">Select Length</option>
                <?php foreach ($ProductLength as $key => $length) {  ?>
                  <option value="<?php echo $length['ProductLength']; ?>"><?php echo $length['ProductLength']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select class="form-control add_more_validation" name="product_type[]" id="product_type_1">
                <option value="">Select Product Type</option>
                <?php foreach ($ProductType as $key => $product_type) {  ?>
                  <option value="<?php echo $product_type['ProductType']; ?>"><?php echo $product_type['ProductType']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select class="form-control add_more_validation" name="bell_type[]" id="bell_type_1">
                <option value="">Select Bell Type</option>
                <?php foreach ($BellType as $key => $bell_type) {  ?>
                  <option value="<?php echo $bell_type['BellType']; ?>"><?php echo $bell_type['BellType']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select class="form-control add_more_validation" name="product_perf[]" id="product_perf_1">
                <option value="">Select Product Perf</option>
                <?php foreach ($ProductPerf as $key => $perf) {  ?>
                  <option value="<?php echo $perf['ProductPerf']; ?>"><?php echo $perf['ProductPerf']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td>
              <select class="form-control" name="product_shift[]" id="product_shift_1">
                <?php foreach ($ProductShift as $key => $shift) {  ?>
                  <option <?php if ($shift['ProductShift'] == 'Unknown') echo 'selected'; ?> value="<?php echo $shift['ProductShift']; ?>"><?php echo $shift['ProductShift']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td><button type="button" name="add" id="add_more_product" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
          </tr>
        </table>
        <table class="table table-bordered" id="fitting_dynamic_field">
          <thead>
            <tr>
              <th class="capitalize">Location <span class="text-danger">*</span></th>
              <th class="capitalize">Line Number And Name <span class="text-danger">*</span></th>
              <th class="capitalize">Fitting Description<span class="text-danger">*</span></th>
              <th class="capitalize"></th>
            </tr>
          </thead>
          <tr id="row1">
            <td width="15%">
              <select class="form-control dropdown_location fitting_add_more_validation" name="FabricationLocation[]" id="fabrication_location_1" data-rowid="1">
                <option value="">Select Location</option>
                <?php foreach ($location as $key => $location_data) {  ?>
                  <option value="<?php echo $location_data['Location']; ?>"><?php echo $location_data['Location']; ?></option>
                <?php } ?>
              </select>
            </td>
            <td width="15%">
              <select readonly disabled class="form-control lane-dropdown">
                <option value="Fabrication">Fabrication</option>
              </select>
            </td>
            <td>
              <textarea class="form-control fitting_add_more_validation" name="FittingDescription[]" id="FittingDescription_1"></textarea>
            </td>
            <td width="5%"><button type="button" name="add" id="add_more_fitting_description" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
          </tr>
        </table>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>Next Steps Taken <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="next_step" id="next_step" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"> <b>Ability to upload photos</b></label>
          <div class="upload__box">
            <div class="upload__btn-box">
              <label class="upload__btn">
                <p>Upload photos</p>
                <input type="file" multiple="" data-max_length="10" name="images[]" id="image_data" class="upload__inputfile">
              </label>
            </div>
            <div class="upload__img-wrap"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label capitalize"><b>How was Failure / nonconformance identified? <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="how_failure" id="how_failure" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label class="control-label capitalize"><b> Complaint Summary <span class="text-danger">*</span></b></label>
          <textarea rows="5" placeholder="Your answer" autocomplete="off" name="complaint_summary" id="complaint_summary" class="form-control"></textarea>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <input type="submit" id="submit" class="btn dark" value="Submit">
      <a href="<?php echo site_url('Plastic_pipe_quality_issue_submittal_form');?>" type="button" class="btn red"><i class="fa fa-times pr-5"></i> Cancel</a>
    </div>
  </div>
</form>
<script type="text/javascript">
  // Storing the PHP options as JavaScript variables
  var locationOptions = '<?php echo "<option value=\"\">Select Location</option>"; ?>';
  locationOptions += '<?php foreach ($location as $location_data) { echo "<option value=\"{$location_data["Location"]}\">{$location_data["Location"]}</option>"; } ?>';
  var diameterOptions = '<?php echo "<option value=\"\">Select Diameter</option>"; ?>';
  diameterOptions += '<?php foreach ($ProductDiameter as $diameter) { echo "<option value=\"{$diameter["ProductDiameter"]}\">{$diameter["ProductDiameter"]}</option>"; } ?>';
  var flavourOptions = '<?php echo "<option value=\"\">Select Flavour</option>"; ?>';
  flavourOptions += '<?php foreach ($ProductFlavour as $flavour) { echo "<option value=\"{$flavour["ProductFlavour"]}\">{$flavour["ProductFlavour"]}</option>"; } ?>';
  var lengthOptions = '<?php echo "<option value=\"\">Select Length</option>"; ?>';
  lengthOptions += '<?php foreach ($ProductLength as $length) { echo "<option value=\"{$length["ProductLength"]}\">{$length["ProductLength"]}</option>"; } ?>';
  var typeOptions = '<?php echo "<option value=\"\">Select Product Type</option>"; ?>';
  typeOptions += '<?php foreach ($ProductType as $product_type) { echo "<option value=\"{$product_type["ProductType"]}\">{$product_type["ProductType"]}</option>"; } ?>';
  var bellTypeOptions = '<?php echo "<option value=\"\">Select Bell Type</option>"; ?>';
  bellTypeOptions += '<?php foreach ($BellType as $bell_type) { echo "<option value=\"{$bell_type["BellType"]}\">{$bell_type["BellType"]}</option>"; } ?>';
  var perfOptions = '<?php echo "<option value=\"\">Select Product Perf</option>"; ?>';
  perfOptions += '<?php foreach ($ProductPerf as $perf) { echo "<option value=\"{$perf["ProductPerf"]}\">{$perf["ProductPerf"]}</option>"; } ?>';
  var shiftOptions = '';
   <?php foreach ($ProductShift as $shift) { ?>
        shiftOptions += '<option value="<?php echo $shift['ProductShift']; ?>" <?php if ($shift['ProductShift'] == 'Unknown') echo 'selected'; ?>><?php echo $shift['ProductShift']; ?></option>';
    <?php } ?>
  var lineNumberJson = '<?php echo json_encode($linenumberandname); ?>';
  var check_duplicate_complaint_url = "<?php echo site_url('plastic_pipe_quality_issue_submittal_form/check_duplicate_complaint');?>";
</script>
