<div class="row">
    <form role="form" action="create_project_test.php" method="post" id="stormkeeper_form" enctype="multipart/form-data">
        <input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id; ?>">
    </form>
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-cube font-dark"></i>
                    <span class="caption-subject bold uppercase">Create Project</span>
                </div>
            </div>
            <div class="portlet-body" style="min-height: 940px;">
                <div class="form-group">
                    <label class="control-label">Project Name</label>
                    <input type="text" name="project_name" id="project_name" value="" class="form-control input-sm" />
                    <input type="hidden" name="quoteFields" id="quoteFields" value=""/>                                                        
                    <span></span>                                                            
                </div>
                <div id="viewer" style="min-height: 900px;"></div>
                <div class="margin-top-10">
                    <input type="submit" id="submitQuote" class="btn dark" value="Build Project Plans">                                                       
                </div>
            </div>
        </div>
    </div>
</div>