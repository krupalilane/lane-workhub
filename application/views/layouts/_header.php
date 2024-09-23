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
                                <div class="page-logo">
                                    <a href="<?php echo site_url('dashboard'); ?>">
                                        <img src="<?php echo asset_url();?>images/logo-work-hub.png" alt="logo" class="logo-default">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 work-center-logo">
                                <div class="page-logo">
                                    <img src="<?php echo asset_url();?>images/lane-corporate-logo_55px.png" alt="logo" class="lane-logo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:;" class="menu-toggler"></a>
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
                                            <a href="<?php echo site_url('dashboard'); ?>"> Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'projects') ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url('projects'); ?>"> Projects
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'web-site') ? 'active' : ''; ?>">
                                            <a href="<?php echo site_url('websites'); ?>"> Web sites
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                        <?php if ($this->session->userdata('user')['Role'] == '1') { ?>
                                            <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'settings') ? 'active' : ''; ?>">
                                                <a href="#"> Admin
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu pull-left">
                                                    <li aria-haspopup="true">
                                                        <a href="<?php echo site_url('announcements'); ?>" class="nav-link">
                                                            Announcements
                                                        </a>
                                                    </li> 
                                                    <li aria-haspopup="true">
                                                        <a href="<?php echo site_url('holiday'); ?>" class="nav-link">
                                                            Holiday
                                                        </a>
                                                    </li> 
                                                    <li aria-haspopup="true">
                                                        <a href="<?php echo site_url('users'); ?>" class="nav-link">
                                                            Users
                                                        </a>
                                                    </li>                                          

                                                </ul>
                                            </li>
                                        <?php }else{ ?>
                                            <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'user-edit-profile') ? 'active' : ''; ?>">
                                                <a href="<?php echo site_url('user_edit_profile'); ?>"> Edit Profile
                                                    <span class="arrow"></span>
                                                </a>
                                            </li>
                                        <?php } ?>
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