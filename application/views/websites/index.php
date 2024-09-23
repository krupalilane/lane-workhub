 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="fa fa-cubes font-dark"></i>
            <span class="caption-subject bold capitalize">All Sites</span>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <?php if (!empty($website_data)) { 
            $counter = 0; // Counter to keep track of the column index
            foreach ($website_data as $key => $website_value) { 
                if ($counter % 4 == 0) { ?>
                    <div class="row mb-20">
                <?php } ?>

                <div class="col-md-3 dashboard-site-div">
                    <div class="box">
                        <a target="_blank" href="<?php echo $website_value['SiteURL']; ?>">
                            <img src="<?php echo asset_url();?>site-logo/<?php echo $website_value['LogoName']; ?>" alt="logo" class="logo-default w-50">
                            <h4><?php echo $website_value['SiteName']; ?></h4>
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
        }else{ ?>
        	<p>No website Found!</p>
        <?php } ?>
    </div>
</div>