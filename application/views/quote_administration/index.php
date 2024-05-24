<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="fa fa-cubes font-dark"></i>
            <span class="caption-subject bold uppercase">Quote Administration (Global)</span>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover dt-responsive display responsive" width="100%" id="quotes">
            <thead>
                <tr>
                    <th class="min-tablet">Project #</th>
                    <th class="all">Name</th>
                    <th class="min-tablet">User</th>
                    <th class="min-tablet">Company</th>
                    <th class="min-desktop">Local Office
                    <th class="min-desktop">Date/Time</th>                   
                    <th class="min-tablet">Status</th>
                    <th class="all">Actions</th>                                                                        
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($quotes)){
                    foreach($quotes as $index => $quote){ ?>
                        <tr>
                            <td><?php echo (!empty($quote['QuoteId'])) ? 'P'.str_pad($quote['QuoteId'], 5, '0', STR_PAD_LEFT) : '-'; ?></td>
                            <td><?php echo (!empty($quote['Name'])) ? $quote['Name'] : '-'; ?></td>
                            <td><?php echo (!empty($quote['UserName'])) ? $quote['UserName'] : '-'; ?></td>
                            <td><?php echo (!empty($quote['CompanyName'])) ? $quote['CompanyName'] : '-'; ?></td>
                            <td><?php echo (!empty($quote['OfficeName'])) ? $quote['OfficeName'] : '-'; ?></td>
                            <td><?php echo (!empty($quote['CreatedOn'])) ? $quote['CreatedOn'] : '-'; ?></td>
                            <td>
                                <?php if($quote['Status'] == 2){ ?>
                                    <i class="fa fa-check-square-o"></i>&nbsp;<?php echo QUOTES_BUILD_COMPLETE; ?>
                                <?php }else{ ?>
                                    <i class="fa fa-spin fa-spinner"></i>&nbsp;<?php echo QUOTES_IN_PROGRESS; ?>
                                <?php }?>
                            </td>
                            <td>
                                <div class="btn-group btn-group-xs btn-group-solid">
                                    <?php if($quote['Status'] == 2){ ?>
                                        <a href="<?php echo site_url('quote_administration/view/'.$quote['QuoteId']);?>" type="button" class="btn red">View</a>
                                    <?php } ?>
                                    <a data-quoteid="<?php echo $quote['QuoteId']; ?>" data-quotename="<?php echo $quote['Name'];?>" type="button" class="delete_quote_button btn dark">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    var delete_quote_url = "<?php echo site_url('quote_administration/delete_quote');?>";
    var quote_admin_url  = "<?php echo site_url('quote_administration');?>";
</script>