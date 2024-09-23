 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<div class="row">
    <div class="col-md-5">
        <?php if ($this->session->userdata('user')['IsTodayBirthday'] == 1) { ?>
            <div class="portlet light p-3 dashboard-box-shadow">
                <div class="portlet-body p-0">
                    <img class="w-100 h-200" src="<?php echo asset_url();?>images/dashboard/Happy-birthday.jpg" alt="Happy Birthday">
                </div>
            </div>
        <?php } ?>
        <?php if ($this->session->userdata('user')['IsTodayAnniversary'] == 1) { ?>
            <div class="portlet light p-3 dashboard-box-shadow">
                <div class="portlet-body p-0">
                    <img class="w-100 h-200" src="<?php echo asset_url();?>images/dashboard/anny.png" alt="Happy Birthday">
                </div>
            </div>
        <?php } ?>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light p-0 dashboard-box-shadow">
            <div class="portlet-body p-0">
                <section class="carousel-default dashboard-holiday-card">
                  <div id="carousel-default" class="carousel slide">
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($hoilday_list as $holiday_key => $holiday_data) { ?>
                            <div class="item <?php if($holiday_data['ShowAsNearestHoliday'] == 1) { echo  'active'; } ?>">
                              <img src="<?php echo asset_url();?>images/dashboard/holiday_bg.png" alt="Holiday">
                              <div class="carousel-caption">
                                <h3 class="holiday-heading"><?php echo $holiday_data['HolidayName']; ?></h3>
                                <p class="holiday-date"><?php echo $holiday_data['DisplayDate']; ?></p>
                              </div>
                            </div>
                        <?php } ?>
                        <div class="top-left-text">
                            <span>Holidays</span>
                        </div>
                        <div class="top-right-text">
                            <u><span id="view_all_holiday" class="view_holiday">View All</span></u>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-default" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-default" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </section>
            </div>
        </div>
        <div class="portlet light dashboard-weather dashboard-box-shadow">
            <div class="portlet-body">
                <div id="weather-loader" class="weather-loader" style="display:none;"></div> <!-- Loader -->
                <div id="weather_data_time">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light dashboard-box-shadow">
            <div class="portlet-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs nav-tabs-lg">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab"><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcements 
                                <?php if ($count_today_annoucement > 0) { ?>
                                    <span class="badge badge-danger"><?php echo $count_today_annoucement; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab"><i class="fa fa-birthday-cake" aria-hidden="true"></i> Birthday
                                <?php if (count($birthdayToday) > 0) { ?>
                                    <span class="badge badge-danger"><?php echo count($birthdayToday); ?></span>
                                <?php } ?>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_3" data-toggle="tab"><i class="fa fa-trophy" aria-hidden="true"></i>  Work Anniversary
                                <?php if (count($AnniversaryToday) > 0) { ?>
                                    <span class="badge badge-danger"><?php echo count($AnniversaryToday); ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(count($all_annoucement) > 0 ){ ?>
                                        <div id="announcements_carousel" class="announcements_carousel carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php foreach ($all_annoucement as $a_key => $annoucement) { 
                                                    $sentence = $annoucement['AnnouncementContent'];
                                                    $limit = 25;
                                                    $words = explode(' ', $sentence);
                                                    if (count($words) > $limit) {
                                                        $words = array_slice($words, 0, $limit);
                                                        $truncated_sentence = implode(' ', $words) . '...';
                                                    } else {
                                                        $truncated_sentence = $sentence;
                                                    }
                                                ?>
                                                    <div class="item <?php if($a_key == 0) { echo  'active'; } ?>">
                                                        <div>
                                                            <h3><b><?php echo $annoucement['AnnoucementHeader']; ?></b></h3>
                                                            <span><?php echo $truncated_sentence; ?></span>
                                                            <p class="read_more" data-active_id="<?php echo $a_key; ?>"><u>Read more</u></p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                          <!-- Controls -->
                                            <a class="left carousel-control" href="#announcements_carousel" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                            </a>
                                            <a class="right carousel-control" href="#announcements_carousel" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                            </a>
                                        </div> 
                                    <?php }else{ ?>    
                                        <p>There is no annoucement.</p>
                                    <?php } ?>                           
                                </div>
                            </div>                                                                   
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><b>Birthdays today</b></h5>
                                    <?php if (count($birthdayToday) > 0) {
                                        foreach ($birthdayToday as $b_today_key => $today_b_data) { ?>
                                            <div class="col-sm-2 text-center">
                                                <img class="birthday-image" src="<?php echo asset_url();?>images/user/<?php echo $today_b_data['UserImageUrl'];?>">
                                                <p class="birthday-name"><?php echo $today_b_data['UserName'];?></p>
                                                <p class="birthday-date"><?php echo $today_b_data['DOB'];?></p>
                                            </div>
                                    <?php    }
                                    }else{ ?>
                                        <div class="no-one-birthday">
                                            <img class="w-7" src="<?php echo asset_url();?>images/dashboard/cake.png">
                                            <p>No one is having birthday today</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><b>Next 7 Days</b></h5>
                                    <?php if (count($birthdayNotToday) > 0) {
                                        foreach ($birthdayNotToday as $b_nottoday_key => $nottoday_b_data) { ?>
                                            <div class="col-sm-2 text-center">
                                                <img class="birthday-image" src="<?php echo asset_url();?>images/user/<?php echo $nottoday_b_data['UserImageUrl'];?>">
                                                <p class="birthday-name"><?php echo $nottoday_b_data['UserName'];?></p>
                                                <p class="birthday-date"><?php echo $nottoday_b_data['DOB'];?></p>
                                            </div>
                                    <?php    }
                                    }else{ ?>
                                        <div class="no-one-birthday">
                                            <img class="w-7" src="<?php echo asset_url();?>images/dashboard/cake.png">
                                            <p>No one is having birthday in next 7 days.</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>                                                                      
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><b>Work anniversary</b></h5>
                                    <?php if (count($AnniversaryToday) > 0) {
                                        foreach ($AnniversaryToday as $a_today_key => $today_a_data) { ?>
                                            <div class="col-sm-2 text-center">
                                                <img class="birthday-image" src="<?php echo asset_url();?>images/user/<?php echo $today_a_data['UserImageUrl'];?>">
                                                <p class="birthday-name"><?php echo $today_a_data['UserName'];?></p>
                                                <p class="birthday-date"><?php echo $today_a_data['DateofJoining'];?></p>
                                            </div>
                                    <?php    }
                                    }else{ ?>
                                        <div class="no-one-birthday">
                                            <img class="w-7" src="<?php echo asset_url();?>images/dashboard/trophy.png">
                                            <p>No one is having work anniversary today</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5><b>Next 7 Days</b></h5>
                                    <?php if (count($AnniversaryNotToday) > 0) {
                                        foreach ($AnniversaryNotToday as $a_nottoday_key => $nottoday_a_data) { ?>
                                            <div class="col-sm-2 text-center">
                                                <img class="birthday-image" src="<?php echo asset_url();?>images/user/<?php echo $nottoday_a_data['UserImageUrl'];?>">
                                                <p class="birthday-name"><?php echo $nottoday_a_data['UserName'];?></p>
                                                <p class="birthday-date"><?php echo $nottoday_a_data['DateofJoining'];?></p>
                                            </div>
                                    <?php    }
                                    }else{ ?>
                                        <div class="no-one-birthday">
                                            <img class="w-7" src="<?php echo asset_url();?>images/dashboard/trophy.png">
                                            <p>No one is having work anniversary in next 7 days.</p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>                                                                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet light dashboard-box-shadow">
            <div class="portlet-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs nav-tabs-lg">
                        <li class="active">
                            <a href="#fav_project" data-toggle="tab">Favorite Projects
                            </a>
                        </li>
                        <li>
                            <a href="#fav_website" data-toggle="tab">Favorite Websites
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="fav_project">
                            <?php if (!empty($fav_projects)) { 
                                $counter = 0; // Counter to keep track of the column index
                                foreach ($fav_projects as $key => $dashboard_value) { 
                                    if ($counter % 4 == 0) { ?>
                                        <div class="row mb-20">
                                    <?php } ?>

                                    <div class="col-md-3 dashboard-site-div">
                                        <div class="box">
                                            <a href="<?php echo $dashboard_value['SiteURL']; ?>">
                                                <img src="<?php echo asset_url();?>site-logo/<?php echo $dashboard_value['LogoName']; ?>" alt="logo" class="logo-default w-50 fav_image">
                                                <p class="m-0"><?php echo $dashboard_value['SiteName']; ?></p>
                                            </a>
                                        </div>
                                    </div>

                                    <?php 
                                    $counter++;

                                    if ($counter % 4 == 0) { ?>
                                        </div>
                                    <?php }
                                }
                                if ($counter % 4 != 0) { ?>
                                    </div>
                                <?php }
                            } else{ ?>
                                <p>No data Found!</p>
                            <?php } ?>                                                                   
                        </div>
                        <div class="tab-pane" id="fav_website">
                            <?php if (!empty($fav_websites)) { 
                                $counter = 0; // Counter to keep track of the column index
                                foreach ($fav_websites as $key => $website_value) { 
                                    if ($counter % 4 == 0) { ?>
                                        <div class="row mb-20">
                                    <?php } ?>

                                    <div class="col-md-3 dashboard-site-div">
                                        <div class="box">
                                            <a target="_blank" href="<?php echo $website_value['SiteURL']; ?>">
                                                <img src="<?php echo asset_url();?>site-logo/<?php echo $website_value['LogoName']; ?>" alt="logo" class="logo-default w-50 fav_image">
                                                <p class="m-0"><?php echo $website_value['SiteName']; ?></p>
                                            </a>
                                        </div>
                                    </div>

                                    <?php 
                                    $counter++;

                                    if ($counter % 4 == 0) { ?>
                                        </div>
                                    <?php }
                                }
                                if ($counter % 4 != 0) { ?>
                                    </div>
                                <?php }
                            } else{ ?>
                                <p>No data Found!</p>
                            <?php } ?>                                                                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="all_holiday_list" tabindex="-1" role="dialog" aria-labelledby="holidayModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h3 class="modal-title" id="holidayModalLabel">All Holiday List</h3>
          </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <select class="form-control" name="holiday_year" id="holiday_year">
                            <?php foreach ($hoilday_year_list as $key => $year) {  ?>
                              <option value="<?php echo $year['Year']; ?>" <?php if(date("Y") == $year['Year']){ echo "selected"; } ?>><?php echo $year['Year']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <table class="holiday-table">
                        <tbody id="all_holiday_body">

                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="all_annoucement_modal" tabindex="-1" role="dialog" aria-labelledby="annoucementModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title" id="annoucementModalLabel">Annoucement Details</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="modal_announcements_carousel" class="announcements_carousel carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($all_annoucement as $ma_key => $annoucement) {
                                        $image_variable = [
                                            '0' => 'FirstImageUrl',
                                            '1' => 'SecondImageUrl',
                                            '2' => 'ThirdImageUrl'
                                        ];
                                    ?>
                                        <div class="item" id="active_annoucement_<?php echo $ma_key; ?>">
                                            <div>
                                                <h3><b><?php echo $annoucement['AnnoucementHeader']; ?></b></h3>
                                                <?php
                                                    for ($i=0; $i < count($image_variable); $i++) { 
                                                        $file_name = $annoucement[$image_variable[$i]];
                                                        $extension = pathinfo($file_name, PATHINFO_EXTENSION); 
                                                        switch (strtolower($extension)) {
                                                            case 'jpg':
                                                            case 'jpeg':
                                                            case 'png':
                                                            case 'gif':
                                                                // Display image
                                                                echo '<img src="' . asset_url().'images/dashboard/annoucement/'.$annoucement['ID'].'/'.$file_name.'" alt="Image" style="max-width:100%; height:auto;">';
                                                            break;                                                            
                                                            default:
                                                                echo '';
                                                            break;
                                                        }
                                                    }
                                                ?>
                                                 <br>
                                                 <br>
                                                 <br>
                                                <span><?php echo $annoucement['AnnouncementContent']; ?></span>
                                                <br>
                                                <br>
                                                <br>
                                                <b>List of attachment</b>
                                                <br>
                                                <?php
                                                    for ($i=0; $i < count($image_variable); $i++) { 
                                                        $file_name = $annoucement[$image_variable[$i]];
                                                        $extension = pathinfo($file_name, PATHINFO_EXTENSION); 
                                                        switch (strtolower($extension)) {
                                                            case 'xls':
                                                            case 'xlsx':
                                                            case 'pdf':
                                                            case 'txt':
                                                            case 'doc':
                                                            case 'docx':
                                                            case 'mp4':
                                                            case 'webm':
                                                            case 'ogg':
                                                                echo '<i class="fa fa-circle f-8" aria-hidden="true"></i> <a href="' . asset_url().'images/dashboard/annoucement/'.$annoucement['ID'].'/'.$file_name.'" target="_blank">'.$file_name.'</a><br>';
                                                            break;
                                                            
                                                            default:
                                                                echo '';
                                                            break;
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                              <!-- Controls -->
                                <a class="left carousel-control" href="#modal_announcements_carousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#modal_announcements_carousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>                                
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var get_all_holiday_url = "<?php echo site_url('dashboard/get_all_holiday');?>";
  var get_all_weather_url = "<?php echo site_url('dashboard/get_weather_data');?>";
  var weather_baseURL = "<?php echo asset_url(); ?>images/dashboard/weather/";
</script>