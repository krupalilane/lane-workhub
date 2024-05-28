<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="<?php echo asset_url();?>images/avatar.png" class="img-responsive" alt=""> </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name font-dark"> <?php echo $user_details['FirstName'].' '.$user_details['LastName']; ?> </div>
                        <div class="profile-usertitle-job font-dark"> </div><br>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                </div>
                <!-- END PORTLET MAIN -->
                <!-- PORTLET MAIN -->
                <div class="portlet light ">
                    <!-- STAT -->
                    <div class="row list-separated profile-stat">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title font-dark"> <?php echo $user_details['TotalProjects']; ?> </div>
                            <div class="uppercase profile-stat-text font-dark"> Projects </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title font-dark"> <?php echo $user_details['TotalProducts']; ?> </div>
                            <div class="uppercase profile-stat-text font-dark"> Product </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title font-dark"> <?php echo $user_details['TotalDownloads']; ?> </div>
                            <div class="uppercase profile-stat-text font-dark"> Downloads </div>
                        </div>
                    </div>
                    <!-- END STAT -->
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption font-dark">
                                    <i class="fa fa-user font-dark"></i>
                                    <span class="caption-subject bold uppercase">Edit User</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <?php if($this->session->flashdata('error')) { ?>
                                            <div class="alert alert-warning alert-dismissible">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                              <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if($this->session->flashdata('success')) { ?>
                                            <div class="alert alert-success alert-dismissible">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                              <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php } ?>
                                        <form role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url('edit_profile/update_user_profile');?>"  id="profile_form">
                                            <input type="hidden" name="user_id" name="user_id" value="<?php echo $user_details['ID']; ?>">                  
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <input type="text" name="firstname" value="<?php echo $user_details['FirstName']; ?>" class="form-control input-xlarge" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" value="<?php echo $user_details['LastName']; ?>" name="lastname" class="form-control input-xlarge" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Local Office</label>
                                                <select name="localoffice" class="form-control input-xlarge">
                                                    <option value="" >Choose Local Lane Office</option>
                                                    <?php
                                                        if (!empty($office_details)) {
                                                            foreach ($office_details as $key => $office_data) { ?>
                                                                <option <?php if ($user_details['OfficeId'] == $office_data['ID'] ) { echo "selected";} ?> value="<?php echo $office_data['ID']; ?>"><?php echo $office_data['OfficeName']; ?></option>   
                                                        <?php    }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Company Name</label>
                                                <input type="text" placeholder="" class="form-control input-xlarge" name="company_name" value="<?php echo $user_details['CompanyName']; ?>" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" placeholder="" class="form-control input-xlarge" name="phone" value="<?php echo $user_details['Phone']; ?>" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address 1</label>
                                                <input type="text" placeholder="" class="form-control input-xlarge" name="address1" value="<?php echo $user_details['Address1']; ?>" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address 2</label>
                                                <input type="text" class="form-control input-xlarge" placeholder="" name="address2" value="<?php echo $user_details['Address2']; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <input type="text" class="form-control input-large" placeholder="" name="city" value="<?php echo $user_details['City']; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">State</label>                                                                                    
                                                <select name="state" class="form-control input-large" />
                                                    <option value="">Choose State</option>
                                                    <?php
                                                        if (!empty($state)) {
                                                            foreach ($state as $key => $state_data) { ?>
                                                                <option <?php if ($user_details['StateId'] == $state_data['ID'] ) { echo "selected";} ?> value="<?php echo $state_data['ID']; ?>"><?php echo $state_data['State']; ?></option>   
                                                        <?php    }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Zip/Postal Code</label>                                                                                    
                                                <input type="text" class="form-control input-large" name="zip" value="<?php echo $user_details['ZipCode']; ?>">
                                            </div>
                                            <div class="margin-top-10">
                                                <input type="submit" class="btn red" value="Update Profile">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
<!-- END PAGE CONTENT INNER -->
