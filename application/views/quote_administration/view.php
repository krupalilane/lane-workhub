<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <?php if (isset($quote_data)) { ?>
                    <?php if ($status == 1) { ?>
                        <div class="portlet light portlet-fit portlet-datatable ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-info font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Something went wrong!... The project is in progress. Please check back later for updates.</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <a class="btn red" href="<?php echo site_url('quote_administration');?>">Back To Quote Admin</a>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    <?php }else{?>
                        <div class="portlet light portlet-fit portlet-datatable ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase"> <?php echo $project_id;?> | <?php echo $quote_data['Name'];?></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs nav-tabs-lg">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab"> Details </a>
                                        </li>
                                        <li>
                                            <a href="#tab_2" data-toggle="tab"> Attached Files
                                                <span class="badge badge-danger"><?php echo count($product_file_data); ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="portlet red box">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-user"></i>User Details </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> User Name: </div>
                                                                <div class="col-md-7 value">  <?php echo $quote_data['UserName'];?></div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Company Name: </div>
                                                                <div class="col-md-7 value"> <?php echo $quote_data['CompanyName'];?></div>
                                                            </div>                                                                                    
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Email: </div>
                                                                <div class="col-md-7 value"> <a href="mailto:<?php echo $quote_data['Email'];?>"> <?php echo $quote_data['Email'];?></a> </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Local Office: </div>
                                                                <div class="col-md-7 value">  <?php echo $quote_data['OfficeName'];?> </div>
                                                            </div>                                                                                 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="portlet red box">
                                                        <div class="portlet-title">
                                                            <div class="caption"><i class="fa fa-cubes"></i>Project Details </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Project #: </div>
                                                                <div class="col-md-7 value"> <?php echo 'P'.str_pad($quote_data['QuoteId'], 5, '0', STR_PAD_LEFT); ?> </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Project Name: </div>
                                                                <div class="col-md-7 value">  <?php echo $quote_data['Name'];?> </div>
                                                            </div>                                                         
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Project Created: </div>
                                                                <div class="col-md-7 value"> <?php echo date('M d,Y h:i a',strtotime($quote_data['CreatedOn']));?> </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Project Status: </div>
                                                                <div class="col-md-7 value">
                                                                    <span class="label label-danger">
                                                                        <i class="fa fa-check-square-o"></i>&nbsp;Build Complete 
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Product: </div>
                                                                <div class="col-md-7 value"> <?php echo $product_data['ConfiguredProductName']; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="portlet red box">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-cube"></i>Product Details </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Volume Needed (cf): </div>
                                                                <div class="col-md-7 value"> <?php echo $product_data['VolumeNeeded']; ?>  </div>
                                                            </div>
                                                            <?php if ($product_data['SoilBearing']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name"> Soil Bearing (ksf): </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['SoilBearing']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Maximum Burial Depth (ft): </div>
                                                                <div class="col-md-7 value"> <?php echo $product_data['MaxBuryDepth']; ?> </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Length (ft): </div>
                                                                <div class="col-md-7 value"> <?php echo $product_data['Length']; ?> </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Width (ft): </div>
                                                                <div class="col-md-7 value"> <?php echo $product_data['Width']; ?> </div>
                                                            </div>
                                                            <?php if ($product_data['Invert']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name"> Invert of System: </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['Invert']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($product_data['ChamberSelect']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name"> Chamber Size: </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['ChamberSelect']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> Manifold: </div>
                                                                <div class="col-md-7 value"> <?php echo $product_data['Mainfold']; ?> </div>
                                                            </div>
                                                            <?php if ($product_data['ManHeaderSize']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">Manifold Header Size: </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['ManHeaderSize']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($product_data['ManHeaderSize']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">Manifold Stub Size: </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['ManStubSize']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($product_data['ManifoldSide']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">Manifold Side: </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['ManifoldSide']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($product_data['Perforated']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">Perforated: </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['Perforated']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if ($product_data['PipeDiamSelection']) { ?>
                                                                <div class="row static-info">
                                                                    <div class="col-md-5 name">Pipe Selection: </div>
                                                                    <div class="col-md-7 value"> <?php echo $product_data['PipeDiamSelection']; ?> </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <a class="btn red" href="<?php echo site_url('quote_administration');?>">Back To Quote Admin</a>
                                                </div>
                                            </div>                                                                   
                                        </div>
                                        <div class="tab-pane" id="tab_2">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">                                                                    
                                                    <div class="portlet box red">
                                                        <div class="portlet-title">
                                                            <div class="caption"><i class="fa fa-file-o"></i>Attached Files </div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> File Name </th>
                                                                            <th> File Type </th>
                                                                            <th> File Created </th>
                                                                            <th> Actions </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                        if ($product_file_data) {
                                                                            foreach ($product_file_data as $key => $file_data) { ?>

                                                                                    <tr>
                                                                                        <td><?php echo $file_data->name; ?></td>
                                                                                        <td>
                                                                                            <?php if(pathinfo($file_data->filePath, PATHINFO_EXTENSION) == 'dwg') { ?>
                                                                                                <i class='fa fa-file-o'></i>&nbsp DWG Drawing 
                                                                                            <?php }else{ ?>
                                                                                                <i class='fa fa-file-pdf-o'></i>&nbsp Adobe PDF 
                                                                                            <?php } ?>
                                                                                        </td>
                                                                                        <td><?php echo date('M d,Y h:i a',strtotime($file_data->createdDate)); ?></td>
                                                                                        <td> <a class="btn btn-xs red" target="_blank" href="<?php echo site_url('quote_administration/download_file/'.$file_data->id); ?>">Download File</a> </td>
                                                                                    </tr>
                                                                            <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <a class="btn red" href="<?php echo site_url('quote_administration');?>">Back To Quote Admin</a>
                                                </div>
                                            </div>                                                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
            <?php } else{ ?>
                <div class="portlet light portlet-fit portlet-datatable ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-info font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Something went wrong!... The ID may not exist in our system!</span>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <a class="btn red" href="<?php echo site_url('quote_administration');?>">Back To Quote Admin</a>
                            </div>
                        </div> 
                    </div>
                </div>
            <?php }?>
            <!-- End: life time stats -->
        </div>
    </div>
</div>
<!-- END PAGE CONTENT INNER -->                                    