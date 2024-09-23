<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
<div class="page-wrapper-row">
    <div class="page-wrapper-top">
        <!-- BEGIN HEADER -->
            <div class="page-header">
                <!-- BEGIN HEADER TOP -->
                <div class="page-header-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="page-logo work-hub-logo-icon">
                                    <a href="<?php echo site_url('dashboard'); ?>">
                                        <img src="<?php echo asset_url();?>images/work-hub-icon.png" alt="logo" class="logo-default">
                                    </a>
                                </div>
                                <div class="page-logo">
                                    <img src="<?php echo asset_url();?>images/bp-logo.png" alt="logo" class="logo-default mt-0">
                                </div>
                            </div>
                            <div class="col-md-4 work-center-logo">
                                <div class="page-logo">
                                    <img src="<?php echo asset_url();?>images/lane-corporate-logo_55px.png" alt="logo" class="lane-logo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="top-menu">
                                    <ul class="nav navbar-nav pull-right">
                                        <span class="username username-hide-mobile">Logged In:&nbsp;&nbsp;<?php echo $this->session->userdata('user')['firstname'].' '.$this->session->userdata('user')['lastname'];?></span>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END HEADER TOP -->
                <!-- BEGIN HEADER MENU -->
                <div class="page-header-menu">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="hor-menu  ">
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'plants') ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url('plants'); ?>"> Plants
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true">
                                                    <a href="<?php echo site_url('plants'); ?>" class="nav-link">
                                                        Plants demo 1
                                                    </a>
                                                </li> 
                                                <li aria-haspopup="true">
                                                    <a href="<?php echo site_url('plants/plants2'); ?>" class="nav-link">
                                                        Plants demo 2
                                                    </a>
                                                </li> 
                                                <li aria-haspopup="true">
                                                    <a href="<?php echo site_url('plants/plants3'); ?>" class="nav-link">
                                                        Plants demo 3
                                                    </a>
                                                </li>                                          

                                            </ul>
                                        </li>
                                        <!-- <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'per_ton') ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url('per_ton'); ?>"> Per Ton
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'lane_qtr') ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url('lane_qtr'); ?>"> Lane Qtr
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'lane_year') ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url('lane_year'); ?>">  Lane Year
                                                <span class="arrow"></span>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="hor-menu right-menu">
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown">
                                            <a id="logout_confirm"> Log Out
                                                <span class="arrow"></span>
                                            </a>
                                        </li> 
                                    </ul>
                                </div>
                            </div>                           
                        </div>
                        <!-- END MEGA MENU -->
                    </div>
                </div>
                <!-- END HEADER MENU -->
            </div>
        <!-- END HEADER -->                
    </div>
</div>