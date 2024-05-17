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
                        <div class="profile-usertitle-name font-dark"> Kevin Miller</div>
                        <div class="profile-usertitle-job font-dark"> Admin </div><br>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                </div>
                <!-- END PORTLET MAIN -->
                <!-- PORTLET MAIN -->
                <div class="portlet light ">
                    <!-- STAT -->
                    <div class="row list-separated profile-stat">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title font-dark"> 87 </div>
                            <div class="uppercase profile-stat-text font-dark"> Projects </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title font-dark"> 1 </div>
                            <div class="uppercase profile-stat-text font-dark"> Product </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title font-dark"> 529 </div>
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
                                <span class="caption-subject bold uppercase">Edit Profile</span>
                            </div>
                                <ul class="nav nav-tabs red">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Change Email</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form role="form" method="post" enctype="multipart/form-data" action="profile-update.php" id="profile_form">
                                        <input type="hidden" name="auth_id" value="12">                               
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <input type="text" name="first_name" value="Kevin" class="form-control input-xlarge" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" value="Miller" name="last_name" class="form-control input-xlarge" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Local Office</label>
                                                <select name="local_office" class="form-control input-xlarge">
                                                    <option value="" >Choose Local Lane Office</option>
                                                    <?php
                                                        if (!empty($office_details)) {
                                                            foreach ($office_details as $key => $office_data) { ?>
                                                                <option value="<?php echo $office_data['ID']; ?>"><?php echo $office_data['OfficeName']; ?></option>   
                                                        <?php    }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Company Name</label>
                                                <input type="text" placeholder="" class="form-control input-xlarge" name="company_name" value="Lane Enterprises" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" placeholder="" class="form-control input-xlarge" name="phone" value="" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address 1</label>
                                                <input type="text" placeholder="" class="form-control input-xlarge" name="address1" value="" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address 2</label>
                                                <input type="text" class="form-control input-xlarge" placeholder="" name="address2" value="" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">City</label>
                                                <input type="text" class="form-control input-large" placeholder="" name="city" value="" />
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">State</label>                                                                                    
                                                <select name="state" class="form-control input-large" />
                                                    <option value="">Choose State</option>
                                                    <?php
                                                        if (!empty($state)) {
                                                            foreach ($state as $key => $state_data) { ?>
                                                                <option value="<?php echo $state_data['ID']; ?>"><?php echo $state_data['State']; ?></option>   
                                                        <?php    }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Zip/Postal Code</label>                                                                                    
                                                <input type="text" class="form-control input-large" name="zip" value="">
                                            </div>
                                            <div class="margin-top-10">
                                                <input type="submit" class="btn red" value="Update Profile">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <div class="note note-danger">
                                            <p> Because your email address is your username, changing the email requires us to log you out and will require you to validate the new address before you can log in again.</p>
                                        </div>
                                        <form role="form" method="post" enctype="multipart/form-data" action="profile-update-email.php" id="email_form">
                                        <input type="hidden" name="e_formkey" value="2012edad105ccb1f5de1f6a17cccf53b">
                                        <input type="hidden" name="auth_id" value="12">                                                                          
                                            <div class="form-group">
                                                <label class="control-label">Current Email Address</label>
                                                <input type="text" name="currentemail" class="form-control input-xlarge " value="kmiller@lane-enterprises.com" disabled/> </div>
                                            <div class="form-group">
                                                <label class="control-label">New Email Address</label>
                                                <input type="text" name="emailnew" id="emailnew" class="form-control input-xlarge " /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Email</label>
                                                <input type="text" name="remailnew" id="remailnew" class="form-control input-xlarge " /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Acknowledgement</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox"> I understand I must verify this new email address before I can log in again.
                                                    <input type="checkbox" value="1" name="understand" />
                                                    <span></span>
                                                    </label>
                                                    <div id="understand_error"></div> 
                                                </div>
                                            </div>       
                                            <div class="margin-top-10">
                                                <input type="submit" class="btn red" value="Change Email">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                       <div class="note note-danger">
                                            <p> Passwords MUST be <strong>between 8 and 20 characters in length</strong> and MUST contain <strong>lowercase letters</strong>, <strong>uppercase letters</strong> and <strong>digits</strong>.</p><br>
                                            <p> Trouble choosing a password?  Here are some randomly generated examples that meet the requirements:</p><br>
                                            <?php if ($passwords) {
                                                foreach ($passwords as $key => $password) { ?>
                                                    <p><strong><?php echo $password; ?></strong></p>
                                                <?php }
                                            } 
                                            ?>
                                        </div>
                                        <form role="form" method="post" autocomplete="off" enctype="multipart/form-data" action="profile-update-password.php" id="password_form">
                                        <input type="hidden" name="pw_formkey" value="2012edad105ccb1f5de1f6a17cccf53b">
                                        <input type="hidden" name="auth_id" value="12">
                                            <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                <input type="password" autocomplete="off" name="currentpassword" class="form-control input-xlarge" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" autocomplete="off" name="newpassword" id="newpassword" class="form-control input-xlarge" /> </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" autocomplete="off" name="rnewpassword" id="rnewpassword" class="form-control input-xlarge" /> </div>
                                            <div class="margin-top-10">
                                                <input type="submit" class="btn red" value="Change Password">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                    <!-- PRIVACY SETTINGS TAB -->
                                    <div class="tab-pane" id="tab_1_4">
                                        <div class="note note-danger">
                                            <p> Note: Unsubscribing from Notification Emails will not prevent you from receiving Forgot Password or Validation messages.</p>
                                        </div>                                                                        
                                        <form role="form" method="post" enctype="multipart/form-data" action="profile-update-privacy.php" id="privacy_form">
                                        <input type="hidden" name="pv_formkey" value="2012edad105ccb1f5de1f6a17cccf53b">
                                        <input type="hidden" name="auth_id" value="12">                                                                          
                                            <table class="table table-light table-hover">
                                                <tr>
                                                    <td> I agree to receive promotional emails from Lane / Storm-Storage.com </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="subscribe_promo" value="1" /> Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="subscribe_promo" value="0" checked/> No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> I agree to receive notification emails from Lane / Storm-Storage.com </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="subscribe_notify" value="1" /> Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="subscribe_notify" value="0" checked/> No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> I agree to receive a monthly newsletter email from Lane / Storm-Storage.com </td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="subscribe_news" value="1" /> Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="subscribe_news" value="0" checked/> No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--end profile-settings-->
                                            <div class="margin-top-10">
                                                <input type="submit" class="btn red" value="Save Preferences">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PRIVACY SETTINGS TAB -->
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