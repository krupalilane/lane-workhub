<div class="page-wrapper-row">
    <div class="page-wrapper-top">
        <!-- BEGIN HEADER -->
            <div class="page-header">
                <!-- BEGIN HEADER TOP -->
                <div class="page-header-top">
                    <div class="container-fluid">
                        <!-- BEGIN LOGO -->
                        <div class="page-logo">
                            <a href="index.php">
                                <img src="<?php echo asset_url();?>images/logo-lane-header_75px.png" alt="logo" class="logo-default">
                            </a>
                        </div>
                        <!-- END LOGO -->
                        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                        <a href="javascript:;" class="menu-toggler"></a>
                        <!-- END RESPONSIVE MENU TOGGLER -->
                        <!-- BEGIN TOP NAVIGATION MENU -->
                        <div class="top-menu">
                            <ul class="nav navbar-nav pull-right">
                                <span class="username username-hide-mobile">Logged In:&nbsp;&nbsp;<a href="profile.php">Kevin Miller</a></span>
                            </ul>
                        </div>
                        <!-- END TOP NAVIGATION MENU -->
                    </div>
                </div>
                <!-- END HEADER TOP -->
                <!-- BEGIN HEADER MENU -->
                <div class="page-header-menu">
                    <div class="container-fluid">
                        <!-- BEGIN MEGA MENU -->
                        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                        <div class="hor-menu  ">
                            <ul class="nav navbar-nav">
                                <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'manage_project') ? 'active' : ''; ?>">
                                    <a href="<?php echo site_url('manage_project'); ?>"> Manage Projects
                                        <span class="arrow"></span>
                                    </a>
                                </li>
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'project') ? 'active' : ''; ?>">
                                    <a href="<?php echo site_url('project/create_project/').STORMKEEPER; ?>"> Create Project
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <?php 
                                            if (isset($project_lists)) {
                                                foreach ($project_lists as $key => $project) { 
                                                    if ($project->id != 44) { ?>
                                                        <li aria-haspopup="true">
                                                            <a href="<?php echo site_url('project/create_project/').$project->id; ?>" class="nav-link">
                                                                <?php echo $project->name; ?>
                                                            </a>
                                                        </li>
                                                <?php }
                                                }
                                            }
                                        ?>                                           
                                    </ul>
                                </li>
                                <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown ">
                                    <a href="<?php echo site_url('edit_profile'); ?>"> Edit Profile
                                        <span class="arrow"></span>
                                    </a>
                                </li>
                                <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown <?php echo ($active_menu == 'contact') ? 'active' : ''; ?>">
                                    <a href="<?php echo site_url('contact'); ?>"> Contact Us
                                        <span class="arrow"></span>
                                    </a>
                                </li>
                                 
                                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown  ">
                                    <a href="javascript:;"> Administration
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu pull-left">
                                        <li aria-haspopup="true">
                                            <a href="<?php echo site_url('work_in_progress'); ?>" class="nav-link">
                                                User Administration
                                            </a>
                                        </li>
                                        <li aria-haspopup="true" class=" ">
                                            <a href="<?php echo site_url('work_in_progress'); ?>" class="nav-link  ">
                                                Quote Administration
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown  <?php echo ($active_menu == 'support') ? 'active' : ''; ?>">
                                    <a href="<?php echo site_url('support'); ?>"> Help/Support
                                        <span class="arrow"></span>
                                    </a>
                                </li>                                                                          
                                <li aria-haspopup="false" class="menu-dropdown classic-menu-dropdown ">
                                    <a href="<?php echo site_url('work_in_progress'); ?>"> Log Out
                                        <span class="arrow"></span>
                                    </a>
                                </li> 
                            </ul>
                        </div>
                        <!-- END MEGA MENU -->
                    </div>
                </div>
                <!-- END HEADER MENU -->
            </div>
        <!-- END HEADER -->                
    </div>
</div>