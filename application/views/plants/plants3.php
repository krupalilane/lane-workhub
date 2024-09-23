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
          <span class="caption-subject bold capitalize">Plants details</span>
      </div>
      <div class="tools" id="buttons-container">
        <a href="<?php echo site_url('plants/add');?>" type="button" class="btn red add-button"><i class="fa fa-plus pr-5"></i> Add</a>
        <a href="#" type="button" class="btn dark"><i class="fa fa-download"></i> Export</a>
      </div>
  </div>
  <div class="portlet-body">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">Select year</label>
          <select class="form-control" name="year" id="year">
            <option>2024</option>
            <option>2023</option>
            <option>2022</option>
            <option>2021</option>
            <option>2020</option>
            <option>2019</option>
            <option>2018</option>
            <option>2017</option>
            <option>2016</option>
            <option>2015</option>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="portlet-body">
          <div class="tabbable-line">
            <ul class="nav nav-tabs nav-tabs-lg">
              <li class="active">
                <a href="#all_plants" data-toggle="tab" class="tab-border"> All Plants </a>
              </li>
              <li>
                <a href="#all_plants_ppo" data-toggle="tab" class="tab-border">All Plants - Plastic Pipe Only</a>
              </li>
              <li>
                <a href="#dublin" data-toggle="tab" class="tab-border">Dublin</a>
              </li>
              <li>
                <a href="#bealeton" data-toggle="tab" class="tab-border">Bealeton</a>
              </li>
              <li>
                <a href="#bedford" data-toggle="tab" class="tab-border">Bedford</a>
              </li>
              <li>
                <a href="#bath" data-toggle="tab" class="tab-border">Bath</a>
              </li>
              <li>
                <a href="#carlisle" data-toggle="tab" class="tab-border">Carlisle</a>
              </li>
              <li>
                <a href="#pulaski" data-toggle="tab" class="tab-border">Pulaski</a>
              </li>
              <li>
                <a href="#king_of_prussia" data-toggle="tab" class="tab-border">King of Prussia</a>
              </li>
              <li>
                <a href="#ballston_spa" data-toggle="tab" class="tab-border">Ballston Spa</a>
              </li>
              <li>
                <a href="#shippensburg" data-toggle="tab" class="tab-border">Shippensburg</a>
              </li>
              <li>
                <a href="#statesville" data-toggle="tab" class="tab-border">Statesville</a>
              </li>
              <li>
                <a href="#wytheville" data-toggle="tab" class="tab-border">Wytheville</a>
              </li>
              <li>
                <a href="#temple" data-toggle="tab" class="tab-border">Temple</a>
              </li>
              <li>
                <a href="#alachua" data-toggle="tab" class="tab-border">Alachua</a>
              </li>
              <li>
                <a href="#casa_grande" data-toggle="tab" class="tab-border">Casa Grande</a>
              </li>
              <li>
                <a href="#eugene" data-toggle="tab" class="tab-border">Eugene</a>
              </li>
              <li>
                <a href="#scramento" data-toggle="tab" class="tab-border">Scramento</a>
              </li>
              <li>
                <a href="#fontana" data-toggle="tab" class="tab-border">Fontana</a>
              </li>
              <li>
                <a href="#longview" data-toggle="tab" class="tab-border">Longview</a>
              </li>

            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="all_plants">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <table class="table table-striped table-bordered table-hover dt-responsive display responsive">
                        <thead>
                          <tr>
                            <th class="text-center" rowspan="3"></th>
                            <th class="text-center" colspan="8">2023</th>
                            <th class="text-center" colspan="8">2024</th>
                          </tr>
                          <tr>
                            <th class="text-center" colspan="2">Q1</th>
                            <th class="text-center" colspan="2">Q2</th>
                            <th class="text-center" colspan="2">Q3</th>
                            <th class="text-center" colspan="2">Q4</th>
                            <th class="text-center" colspan="2">Q1</th>
                            <th class="text-center" colspan="2">Q2</th>
                            <th class="text-center" colspan="2">Q3</th>
                            <th class="text-center" colspan="2">Q4</th>
                          </tr>
                          <tr>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Actual</th>
                            <th class="text-center">Plan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><b>VOLUME/SHIPMENTS - NT</b></td>
                            <td colspan="16"></td>
                          </tr>
                          <tr>
                            <td>Pipe (CMP & Misc)</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          <tr>
                            <td>Plastic Pipe</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          <tr>
                            <td>Chambers</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          <tr>
                            <td><b>REVENUE - $</b></td>
                            <td colspan="16"></td>
                          </tr>
                          <tr>
                            <td>Pipe (CMP & Misc)</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Plastic Pipe</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Chambers</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td><b>REVENUE PER NT</b></td>
                            <td colspan="16"></td>
                          </tr>
                          <tr>
                            <td>Pipe (CMP & Misc)</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Plastic Pipe</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Chambers</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Overall</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td><b>GROSS PROFIT - $</b></td>
                            <td colspan="16"></td>
                          </tr>
                          <tr>
                            <td>Pipe (CMP & Misc)</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Plastic Pipe</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Chambers</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td><b>GROSS PROFIT PER NT</b></td>
                            <td colspan="16"></td>
                          </tr>
                          <tr>
                            <td>Pipe (CMP & Misc)</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Plastic Pipe</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Chambers</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Overall</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td><b>GROSS PROFIT - %</b></td>
                            <td colspan="16"></td>
                          </tr>
                          <tr>
                            <td>Pipe (CMP & Misc)</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                          </tr>
                          <tr>
                            <td>Plastic Pipe</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                          </tr>
                          <tr>
                            <td>Chambers</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                          </tr>
                          <tr>
                            <td>Overall</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                            <td>0.00%</td>
                          </tr>
                          <tr>
                            <td><b>G & A</b></td>
                            <td colspan="16"></td>
                          </tr>
                          <tr>
                            <td>Selling</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Depreciation</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Other</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                            <td>$0.00</td>
                          </tr>
                          <tr>
                            <td><b>IBIT</b></td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          <tr>
                            <td><b>IBITDA</b></td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                          <tr>
                            <td><b>CMP Produced - NT</b></td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>0.00</td>
                          </tr>
                        </tbody>          
                      </table>
                    </div>
                  </div>                                                                  
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END EXAMPLE TABLE PORTLET--> 