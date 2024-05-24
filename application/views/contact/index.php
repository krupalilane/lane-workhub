<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">                                                                       
	<div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="fa fa-map-marker font-dark"></i>
                <span class="caption-subject bold uppercase">Lane Headquarters</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="c-content-contact-1 c-opt-1">
                <div class="row" data-auto-height=".c-height">
                    <div class="col-lg-8 col-md-6 c-desktop"></div>
                    <div class="col-lg-4 col-md-6">
                        <div class="c-body">
                            <div class="c-section">
                                <h3>Lane Enterprises, Inc.</h3>
                            </div>
                            <div class="c-section">
                                <div class="c-content-label uppercase bg-red">Address</div>
                                <p>Corporate Headquarters
                                	<br/>3905 Hartzdale Drive Suite 514
                                    <br/>Camp Hill, PA 17011
                                    <br/>United States of America</p>
                            </div>
                            <div class="c-section">
                                <div class="c-content-label uppercase bg-red">Contacts</div>
                                <p>
                                    <strong>Toll-Free</strong> <a href="tel:8668647419">866.864.7419</a>
                                    <br/>
                                    <strong>Phone</strong> <a href="tel:7177618175">717.761.8175</a>
                                    <br/>		                                                                
                                    <strong>Fax</strong> <a href="tel:7177615055">717.761.5055</a></p>
                            </div>
                            <div class="c-section">
                                <div class="c-content-label uppercase bg-red">Social</div>
                                <br/>
                                <ul class="c-content-iconlist-1 ">
                                    <li>
                                        <a href="https://www.linkedin.com/company/lane-enterprises-inc./">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div id="gmapbg" class="c-content-contact-1-gmap" style="height: 615px;"></div> -->
                <img src="<?php echo asset_url();?>images/map.png" class="c-content-contact-1-gmap">
            </div>
        </div>
    </div>
	<div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="fa fa-users font-dark"></i>
                <span class="caption-subject bold uppercase">Additional Contacts</span>
            </div>
        </div>
        <div class="portlet-body">
		    <div class="c-content-feedback-1 c-option-1">
		        <div class="row">
		            <div class="col-md-6">
		                <div class="c-container bg-grey-steel">
		                    <div class="c-content-title-1">
		                        <h3 class="uppercase">LOCAL OFFICES</h3>
		                        <div class="c-line-left bg-dark"></div>                                                          
		                        <p>Contact Your Local Lane Office Today:</p><br/>
		                        <p>
									<strong>BALLSTON SPA, NY</strong>
									<a href="tel:5188854385">518.885.4385</a>
								</p><br/>
								<p>
									<strong>BATH, NY</strong>
									<a href="tel:6077763366">607.776.3366</a>
								</p><br/>
								<p>
									<strong>PULASKI, PA</strong>
									<a href="tel:7246527747">724.652.7747</a>
								</p><br/>
								<p>
									<strong>CARLISLE, PA</strong>
									<a href="tel:7172498342">717.249.8342</a>
								</p><br/>
								<p>
									<strong>KING OF PRUSSIA, PA</strong>
									<a href="tel:6102724531">610.272.4531</a>
								</p><br/>
								<p>
									<strong>SHIPPENSBURG, PA</strong>
									<a href="tel:7175325959">717.532.5959</a>
								</p><br/>
								<p>
									<strong>BEDFORD, PA</strong>
									<a href="tel:8146231191">814.623.1191</a>
								</p><br/>
								<p>
									<strong>BEALETON, VA</strong>
									<a href="tel:5404393201">540.439.3201</a>
								</p><br/>
								<p>
									<strong>DUBLIN, VA</strong>
									<a href="tel:5406744645">540.674.4645</a>
								</p><br/>
								<p>
									<strong>STATESVILLE, NC</strong>
									<a href="tel:7048722471">704.872.2471</a>
		                        </p>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="c-contact">
		                    <div class="c-content-title-1">
		                        <h3 class="uppercase">NEED SUPPORT?</h3>
		                        <div class="c-line-left bg-dark"></div>
		                        <p class="c-font-lowercase">Please submit questions and feedback via this form.  We will respond within 1 business day to your request.  For faster service, please contact your local office.</p>
		                    </div>
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
		                    <form action="<?php echo site_url('contact/send_contact_details'); ?>" method="post" enctype="multipart/form-data" id="contact_form">
		                    	<input type="hidden" name="user_id" value="<?php echo $user_details['ID'];?>">
		                        <div class="form-group">
		                            <input type="text" name="name" placeholder="Your Name" class="form-control input-md" value="<?php echo $user_details['FirstName'].' '.$user_details['LastName'];?>"> </div>
		                        <div class="form-group">
		                            <input type="text" name="email" placeholder="Your Email" class="form-control input-md" value="<?php echo $user_details['Email'];?>"> </div>
		                        <div class="form-group">
		                            <input type="text" name="company_name" placeholder="Company Name" class="form-control input-md" value="<?php echo $user_details['CompanyName'];?>"> </div>                                                                
		                        <div class="form-group">
		                            <input type="text" name="phone" placeholder="Contact Phone" class="form-control input-md" value="<?php echo $user_details['Phone'];?>"> </div>
		                        <div class="form-group">
		                            <textarea rows="8" name="message" placeholder="Write comment here ..." class="form-control input-md"></textarea>
		                        </div>
		                        <input type="submit" class="btn red" value="Send Message">
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT INNER -->