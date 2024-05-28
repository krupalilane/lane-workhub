<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="fa fa-cubes font-dark"></i>
            <span class="caption-subject bold uppercase">User Administration (Global)</span>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover dt-responsive display responsive" width="100%" id="users">
            <thead>
                <tr>
                    <th class="all">Last Name</th>
                    <th class="all">First Name</th>
                    <th class="min-desktop">Company</th>
                    <th class="min-tablet">Local Office</th>                                
                    <th class="min-tablet">Email</th>
                    <th class="min-desktop">User Class</th>
                    <th class="min-desktop">Status</th>  
                    <th class="all">Last Login</th>  
                    <th class="all">Actions</th>                                                                        
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($users)){
                    foreach($users as $index => $user){ ?>
                        <tr>
                            <td><?php echo (!empty($user['LastName'])) ? $user['LastName'] : '-'; ?></td>
                            <td><?php echo (!empty($user['FirstName'])) ? $user['FirstName'] : '-'; ?></td>
                            <td><?php echo (!empty($user['CompanyName'])) ? $user['CompanyName'] : '-'; ?></td>
                            <td><?php echo (!empty($user['OfficeName'])) ? $user['OfficeName'] : '-'; ?></td>
                            <td><?php echo (!empty($user['Email'])) ? $user['Email'] : '-'; ?></td>
                            <td><?php echo (!empty($user['UserClass'])) ? $user['UserClass'] : '-'; ?></td>
                            <td><?php echo (!empty($user['StatusName'])) ? $user['StatusName'] : '-'; ?></td>
                            <td><?php echo (!empty($user['LastLogin'])) ? $user['LastLogin'] : '-'; ?></td>
                            <td>
                                <div class="btn-group btn-group-xs btn-group-solid">
                                    <?php if($user['ID'] != $this->session->userdata('user')['id']){ ?>
                                        <a href="<?php echo site_url('user_administration/edit/'.$user['ID']);?>" type="button" class="btn red">Edit</a>
                                        <a data-userid="<?php echo $user['ID'];?>" data-username="<?php echo $user['FirstName'].' '.$user['LastName']; ?>" type="button" class="delete_user_button btn dark">Delete</a>
                                    <?php } ?>
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
    var delete_user_url = "<?php echo site_url('user_administration/delete_user');?>";
    var user_admin_url  = "<?php echo site_url('user_administration');?>";
</script>