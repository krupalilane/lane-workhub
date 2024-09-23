 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light ">
    <div class="portlet-body">
        <?php if (!empty($dashboard_data)) { 
            $counter = 0; // Counter to keep track of the column index
            foreach ($dashboard_data as $key => $dashboard_value) { 
                if ($counter % 4 == 0) { ?>
                    <div class="row mb-20">
                <?php } ?>

                <div class="col-md-3 dashboard-site-div">
                    <div class="box">
                        <a href="<?php echo $dashboard_value['SiteURL']; ?>">
                            <img src="<?php echo asset_url();?>site-logo/<?php echo $dashboard_value['LogoName']; ?>" alt="logo" class="logo-default w-50">
                            <h4><?php echo $dashboard_value['SiteName']; ?></h4>
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