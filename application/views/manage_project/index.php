 <!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
</div>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="fa fa-cubes font-dark"></i>
            <span class="caption-subject bold uppercase">Manage Projects</span>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover dt-responsive display responsive" width="100%" id="projects">
            <thead>
                <tr>
                    <th class="min-tablet">Project #</th>
                    <th class="all">Name</th>
                    <th class="min-desktop">Date/Time</th>                                         
                    <th class="min-tablet">Status</th>
                    <th class="all">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($quotes)){
                    foreach($quotes as $index => $quote){ ?>
                        <tr id="<?php echo $quote['QuoteId'];?>">
                            <td><?php echo (!empty($quote['QuoteId'])) ? 'P'.str_pad($quote['QuoteId'], 5, '0', STR_PAD_LEFT) : '-'; ?></td>
                            <td><?php echo (!empty($quote['Name'])) ? $quote['Name'] : '-'; ?></td>
                            <td><?php echo (!empty($quote['CreatedOn'])) ? $quote['CreatedOn'] : '-'; ?></td>
                            <td>
                                <?php if($quote['Status'] == 2){ ?>
                                    <i class="fa fa-check-square-o"></i>&nbsp;<?php echo QUOTES_BUILD_COMPLETE; ?>
                                <?php }else{ ?>
                                    <i class="fa fa-spin fa-spinner"></i>&nbsp;<?php echo QUOTES_IN_PROGRESS; ?>
                                <?php }?>
                            </td>
                            <td>
                                <?php if($quote['Status'] == 2){ ?>
                                    <a href="<?php echo site_url('manage_project/view/'.$quote['QuoteId']);?>" type="button" class="btn red">View/Download</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    var get_project_list_url = "<?php echo site_url('manage_project/get_all_project');?>";
</script>
<!-- END EXAMPLE TABLE PORTLET-->                                    
<!-- END PAGE CONTENT INNER -->