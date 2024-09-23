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
                                <div class="page-logo second-stite-logo-icon">
                                    <img src="<?php echo asset_url();?>site-logo/weekly_territory_report.png" alt="logo" class="logo-default">
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
                                        <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'dashboard') ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url('Weekly_territory_report'); ?>">West Coast Weekly Territory Report
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
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