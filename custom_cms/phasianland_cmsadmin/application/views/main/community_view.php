<?php $this->load->view('default/header'); ?>

<div class="content-frame">  

    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?php echo $pageInfo->header?></h2>
        </div>                             
        <div class="pull-right">  
            <!--?php if($this->uri->segment(2) != 'create' && $this->uri->segment(2) != 'houses' && $this->uri->segment(2) != 'createHouses' && $this->uri->segment(2) != 'modifyHouses' && $this->uri->segment(2) != 'gallery') : ?>
                <a href="<?php echo base_url(); ?>community/create"  class="btn btn-primary">Create Community</a>
            <?php /*endif*/ ?> -->  

            <?php if($this->uri->segment(2) == 'houses' && $this->uri->segment(2) != 'createHouses') : ?>
                <a href="<?php echo base_url(); ?>community/createHouses/comid/<?php echo $this->uri_segments['id']?>"  class="btn btn-primary">Create House</a>
            <?php endif ?>   
        </div>                 
    </div> 

<?php if($pageInfo->code == 'list') : ?>
    <div class="content-frame-body content-frame-body-left">        
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th width="8%">Community ID#</th>
                            <th width="13%">Last Modified</th>
                            <th>Name</th>
                            <th width="13%">Date Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result) : ?>
                            <tr>
                                <td><?=$result->CommunityID?></td> 
                                <td><?=$this->mgeneral->timeAgo($result->DateModified)?></td> 
                                <td>
                                    <li class="dropdown no-decoration">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$result->Name?></a>                                            
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url(); ?>community/modify/id/<?=$result->CommunityID?>">Modify</a></li>
                                            <li><a href="#" id="remove-<?=$result->CommunityID?>" data-id="<?=$result->CommunityID?>" data-community="<?=$result->Name?>">Remove</a></li>
                                        </ul>                                   
                                    </li>
                                </td>
                                <td><?=$this->mgeneral->dateFormat($result->DateCreated)?></td> 
                                <td><?= ($result->Status == 0) ? 'Active':'Inactive' ?></td>  
                                <td>
                                    <a href="<?php echo base_url('community/houses/id/' . $result->CommunityID); ?>"   class="btn-sm btn-info">Houses</a>
                                    <a href="<?php echo base_url('community/gallery/id/' . $result->CommunityID); ?>"   class="btn-sm btn-info">Gallery</a>
                                </td> 
                            </tr>

                            <script type="text/javascript">
                                $('#remove-'+<?=$result->CommunityID?>).click(function(){
                                    var id = $(this).data('id');
                                    var community = encodeURI($(this).data('community'));

                                    $('.load-content').load('<?php echo base_url(); ?>community/remove/id/'+id+'/cname/'+community,function(result){
                                        $('#db-modal').modal({show:true});
                                    });
                                });
                            </script>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 

<?php elseif($pageInfo->code == 'create') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo (empty($this->uri_segments['id'])) ? base_url('community/add'):base_url('community/add/id/' . $this->uri_segments['id']);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-community-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Community:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="cname" value="<?php echo (!empty($results)) ? $results->Name:'';?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 200 charaters.)</em></label>
                            </div>

                            <textarea id="description" name="description" style="display: none;"><?php echo (!empty($results)) ? $results->Description:''; ?></textarea>
                            <textarea id="description_wo_tags" name="description_wo_tags" style="display: none;"><?php echo (!empty($results)) ? strip_tags($results->Description):''; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo (!empty($results)) ? $results->Description:''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Amenities:</label>  
                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->

                            <textarea id="amenities" name="amenities" style="display: none;"><?php echo (!empty($results)) ? $results->Amenities:''; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_2" id="summernote_2" style="resize:none; width:100%; height:100px;"><?php echo (!empty($results)) ? $results->Amenities:''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Latitude:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="latitude" value="<?php echo (!empty($results)) ? $results->Latitude:'';?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Longtitude:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="longtitude" value="<?php echo (!empty($results)) ? $results->Longtitude:'';?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Logo:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($logo_img['error_upload'])) ? '<label class="error">'. $logo_img['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 298px | Height: 107px)</em>'; ?></label>   
                            <input type="file" name="logo_img" id="logo_img" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">White Logo:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($logo_img2['error_upload'])) ? '<label class="error">'. $logo_img2['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 199px | Height: 95px)</em>'; ?></label>   
                            <input type="file" name="logo_img2" id="logo_img2" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($banner['error_upload'])) ? '<label class="error">'. $banner['error_upload'].'</label>':'<em>(JPG format | Width: 2000px | Height: 1500px)</em>'; ?></label>   
                            <input type="file" name="banner" id="banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner Thumbnail:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($thumb_banner['error_upload'])) ? '<label class="error">'. $thumb_banner['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="thumb_banner" id="thumb_banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 1:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image1['error_upload'])) ? '<label class="error">'. $image1['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 558px)</em>'; ?></label>   
                            <input type="file" name="image1" id="image1" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 2:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image2['error_upload'])) ? '<label class="error">'. $image2['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 558px)</em>'; ?></label>   
                            <input type="file" name="image2" id="image2" class="form-control"/>
                        </div>
                    </div>

                <?php if($results->CommunityID == 1 || $results->CommunityID == 2 || $results->CommunityID == 5) : ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Residences Name:</label>  
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <label><em>(Maximum of 200 charaters.)</em></label>
                            </div>

                            <input type="text" class="required form-control" name="residences" value="<?php echo (!empty($results)) ? $results->Residences:'';?>"/>
                        </div>
                    </div>
                <?php endif; ?>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Status:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="status" value="0" <?=((set_value('status') != 1) ? 'checked="checked"' : '')?>/> Active</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="status" value="1" <?=((set_value('status') == 1) ? 'checked="checked"' : '')?>/> Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('community');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modify') : ?>
    <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('community/save/id/' . $results->CommunityID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-community-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Community:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="cname" value="<?= $results->Name; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 200 charaters.)</em></label>
                            </div>

                            <textarea id="description" name="description" style="display: none;"><?php echo $results->Description; ?></textarea>
                            <textarea id="description_wo_tags" name="description_wo_tags" style="display: none;"><?php echo (!empty($results)) ? strip_tags($results->Description):''; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $results->Description; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Amenities:</label>  
                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->

                            <textarea id="amenities" name="amenities" style="display: none;"><?php echo $results->Amenities; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_2" id="summernote_2" style="resize:none; width:100%; height:100px;"><?php echo $results->Amenities; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Latitude:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="latitude" value="<?= $results->Latitude; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Longtitude:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="longtitude" value="<?= $results->Longtitude; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Logo:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-6" src="<?php echo FOLDER_UPLOAD_COMMUNITY . $results->Logo1; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Logo:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($logo_img['error_upload'])) ? '<label class="error">'. $logo_img['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 298px | Height: 107px)</em>'; ?></label>   
                            <input type="file" name="logo_img" id="logo_img" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current White Logo:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-6" src="<?php echo FOLDER_UPLOAD_COMMUNITY . $results->Logo2; ?>" style="background: gray;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">White Logo:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($logo_img2['error_upload'])) ? '<label class="error">'. $logo_img2['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 199px | Height: 95px)</em>'; ?></label>   
                            <input type="file" name="logo_img2" id="logo_img2" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Banner:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_COMMUNITY . $results->Banner; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($banner['error_upload'])) ? '<label class="error">'. $banner['error_upload'].'</label>':'<em>(JPG format | Width: 2000px | Height: 1500px)</em>'; ?></label>   
                            <input type="file" name="banner" id="banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Banner Thumbnail:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-4" src="<?php echo FOLDER_UPLOAD_COMMUNITY . $results->ThumbBanner; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner Thumbnail:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($thumb_banner['error_upload'])) ? '<label class="error">'. $thumb_banner['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="thumb_banner" id="thumb_banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image 1:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY . $results->SubBanner1; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 1:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image1['error_upload'])) ? '<label class="error">'. $image1['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 558px)</em>'; ?></label>   
                            <input type="file" name="image1" id="image1" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image 2:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY . $results->SubBanner2; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 2:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image2['error_upload'])) ? '<label class="error">'. $image2['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 558px)</em>'; ?></label>   
                            <input type="file" name="image2" id="image2" class="form-control"/>
                        </div>
                    </div>

                <?php if($results->CommunityID == 1 || $results->CommunityID == 2 || $results->CommunityID == 5) : ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Residences Name:</label>  
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <label><em>(Maximum of 200 charaters.)</em></label>
                            </div>

                            <input type="text" class="required form-control" name="residences" value="<?= $results->ResidencesName; ?>"/>
                        </div>
                    </div>
                <?php endif; ?>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Status:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="status" value="0" <?=(($results->Status == 0) ? 'checked="checked"' : '')?>/> Active</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="status" value="1" <?=(($results->Status == 1) ? 'checked="checked"' : '')?>/> Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('community');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'houses') : ?>
    <div class="content-frame-body content-frame-body-left">        
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th width="8%">House ID#</th>
                            <th width="13%">Last Modified</th>
                            <th>Type</th>
                            <th>Model Name</th>
                            <th width="13%">Date Created</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result) : ?>
                            <tr>
                                <td><?=$result->HouseID?></td> 
                                <td><?=$this->mgeneral->timeAgo($result->DateModified)?></td> 
                                <td><?= ($result->Type == 1) ? 'Model Houses':'Residences' ?></td> 
                                <td>
                                    <li class="dropdown no-decoration">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$result->ModelName?></a>                                            
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url(); ?>community/modifyHouses/comid/<?php echo $this->uri_segments['id']; ?>/id/<?=$result->HouseID?>">Modify</a></li>
                                            <li><a href="#" id="remove-<?=$result->HouseID?>" data-id="<?=$result->HouseID?>" data-model="<?=$result->ModelName?>">Remove</a></li>
                                        </ul>                                   
                                    </li>
                                </td>
                                <td><?=$this->mgeneral->dateFormat($result->DateCreated)?></td> 
                                <td><?= ($result->Status == 0) ? 'Active':'Inactive' ?></td>  
                            </tr>

                            <script type="text/javascript">
                                $('#remove-'+<?=$result->HouseID?>).click(function(){
                                    var id = $(this).data('id');
                                    var model = encodeURI($(this).data('model'));

                                    $('.load-content').load('<?php echo base_url(); ?>community/removeHouse/id/'+id+'/model/'+model,function(result){
                                        $('#db-modal').modal({show:true});
                                    });
                                });
                            </script>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 

<?php elseif($pageInfo->code == 'createHouses') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo (empty($this->uri_segments['id'])) ? base_url('community/addHouses/comid/' . $this->uri_segments['comid']):base_url('community/addHouses/comid/' . $this->uri_segments['comid'] . '/id/' . $this->uri_segments['id']);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-houses-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Model Name:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="model_name" value="<?php echo (!empty($results)) ? $results->ModelName:'';?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Type:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="type" value="1" <?php echo (!empty($results)) ? ($results->Type == 1) ? 'checked="checked"':'':'checked="checked"';?> /> Model Houses</label>
                                </div>

                                <?php if($this->uri_segments['comid'] == 1 || $this->uri_segments['comid'] == 2 || $this->uri_segments['comid'] == 5) : ?>
                                    <div class="col-md-12">                                    
                                        <label class="check"><input type="radio" class="icheckbox" name="type" value="2" <?php echo (!empty($results)) ? ($results->Type == 2) ? 'checked="checked"':'':'';?> /> Residences</label>
                                    </div>                                
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Model Description:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div>
                            
                            <textarea id="description" name="description" style="display: none;"><?php echo (!empty($results)) ? $results->ModelDescription:''; ?></textarea>
                            <textarea id="description_wo_tags" name="description_wo_tags" style="display: none;"><?php echo (!empty($results)) ? strip_tags($results->ModelDescription):''; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_3" id="summernote_3" style="resize:none; width:100%; height:100px;"><?php echo (!empty($results)) ? $results->ModelDescription:''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Location:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="location" value="1" <?php echo (!empty($results)) ? ($results->Location == 1) ? 'checked="checked"':'':'checked="checked"';?> /> Malolos, Bulacan</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="location" value="2" <?php echo (!empty($results)) ? ($results->Location == 2) ? 'checked="checked"':'':'';?> /> Pulilan, Bulacan</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="location" value="3" <?php echo (!empty($results)) ? ($results->Location == 3) ? 'checked="checked"':'':'';?> /> San Ildefonso, Bulacan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Estimated Price:</label>  
                        <div class="col-md-2">
                            <input type="text" class="required form-control" name="estimated_price" id="estimated_price" value="<?php echo (!empty($results)) ? $results->EstimatedPrice:'';?>" placeholder="___,___,___.__"/>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#estimated_price").inputmask("decimal",{
                                 radixPoint:".", 
                                 groupSeparator: ",", 
                                 digits: 2,
                                 autoGroup: true,
                                 prefix: '₱'
                             });
                        });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Classification:</label>  
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="classification" value="Bungalow" <?php echo (!empty($results)) ? ($results->Classification == 'Bungalow') ? 'checked="checked"':'':'checked="checked"';?> /> House & Lot (Bungalow)</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="classification" value="Two-Storey" <?php echo (!empty($results)) ? ($results->Classification == 'Two-Storey') ? 'checked="checked"':'':'';?> /> House & Lot (Two-Storey)</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="classification" value="Loft" <?php echo (!empty($results)) ? ($results->Classification == 'Loft') ? 'checked="checked"':'':'';?> /> House & Lot (Loft)</label>
                                </div>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Floor Area (sqm):</label>  
                        <div class="col-md-2">
                            <input type="text" class="required form-control" name="floor_area" id="floor_area" value="<?php echo (!empty($results)) ? $results->FloorArea:'';?>" placeholder="___.__"/>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#floor_area").inputmask("decimal",{
                                 radixPoint:".", 
                                 digits: 2,
                                 autoGroup: true,
                                 suffix: 'sqm'
                             });
                        });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Lot Area (sqm):</label>  
                        <div class="col-md-2">
                            <input type="text" class="required form-control" name="lot_area" id="lot_area" value="<?php echo (!empty($results)) ? $results->LotArea:'';?>" placeholder="___.__"/>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#lot_area").inputmask("decimal",{
                                 radixPoint:".", 
                                 digits: 2,
                                 autoGroup: true,
                                 suffix: 'sqm'
                             });
                        });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Bedroom #:</label>  
                        <div class="col-md-6 col-xs-12"> 
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bedroom" value="2" <?php echo (!empty($results)) ? ($results->Bedroom == 1) ? 'checked="checked"':'':'checked="checked"';?> /> 2</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bedroom" value="3" <?php echo (!empty($results)) ? ($results->Bedroom == 2) ? 'checked="checked"':'':'';?> /> 3</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bedroom" value="4" <?php echo (!empty($results)) ? ($results->Bedroom == 3) ? 'checked="checked"':'':'';?> /> 4</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Bath #:</label>  
                        <div class="col-md-6 col-xs-12"> 
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bath" value="1" <?php echo (!empty($results)) ? ($results->Bath == 1) ? 'checked="checked"':'':'checked="checked"';?> /> 1</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bath" value="2" <?php echo (!empty($results)) ? ($results->Bath == 2) ? 'checked="checked"':'':'';?> /> 2</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bath" value="3" <?php echo (!empty($results)) ? ($results->Bath == 3) ? 'checked="checked"':'':'';?> /> 3</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 1:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image1['error_upload'])) ? '<label class="error">'. $image1['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image1" id="image1" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 2:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image2['error_upload'])) ? '<label class="error">'. $image2['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image2" id="image2" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 3:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image3['error_upload'])) ? '<label class="error">'. $image3['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image3" id="image3" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 4:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image4['error_upload'])) ? '<label class="error">'. $image4['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image4" id="image4" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 5:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image5['error_upload'])) ? '<label class="error">'. $image5['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image5" id="image5" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 6:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image6['error_upload'])) ? '<label class="error">'. $image6['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image6" id="image6" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Status:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="status" value="0" <?=((set_value('status') != 1) ? 'checked="checked"' : '')?>/> Active</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="status" value="1" <?=((set_value('status') == 1) ? 'checked="checked"' : '')?>/> Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('community/houses/id/' . $this->uri_segments['comid']);?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modifyHouses') : ?>
    <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('community/saveHouses/comid/' . $results->CommunityID . '/id/' . $results->HouseID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-house-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Model Name:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="model_name" value="<?php echo $results->ModelName;?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Type:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="type" value="1" <?php echo ($results->Type == 1) ? 'checked="checked"':''; ?> /> Model Houses</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="type" value="2" <?php echo ($results->Type == 2) ? 'checked="checked"':'';?> /> Residences</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Model Description:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div>
                            
                            <textarea id="description" name="description" style="display: none;"><?php echo $results->ModelDescription; ?></textarea>
                            <textarea id="description_wo_tags" name="description_wo_tags" style="display: none;"><?php echo strip_tags($results->ModelDescription); ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_3" id="summernote_3" style="resize:none; width:100%; height:100px;"><?php echo $results->ModelDescription; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Location:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="location" value="1" <?php echo ($results->Location == 1) ? 'checked="checked"':'';?> /> Malolos, Bulacan</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="location" value="2" <?php echo ($results->Location == 2) ? 'checked="checked"':'';?> /> Pulilan, Bulacan</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="location" value="3" <?php echo ($results->Location == 3) ? 'checked="checked"':'';?> /> San Ildefonso, Bulacan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Estimated Price:</label>  
                        <div class="col-md-2">
                            <input type="text" class="required form-control" name="estimated_price" id="estimated_price" value="<?php echo $results->EstimatedPrice; ?>" placeholder="___,___,___.__"/>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#estimated_price").inputmask("decimal",{
                                 radixPoint:".", 
                                 groupSeparator: ",", 
                                 digits: 2,
                                 autoGroup: true,
                                 prefix: '₱'
                             });
                        });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Classification:</label>  
                        <div class="col-md-6 col-xs-12"> 
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="classification" value="Bungalow" <?php echo ($results->Classification == "Bungalow") ? 'checked="checked"':'';?> /> House & Lot (Bungalow)</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="classification" value="Two-Storey" <?php echo ($results->Classification == "Two-Storey") ? 'checked="checked"':'';?> /> House & Lot (Two-Storey)</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="classification" value="Loft" <?php echo ($results->Classification == "Loft") ? 'checked="checked"':'';?> /> House & Lot (Loft)</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Floor Area: (sqm)</label>  
                        <div class="col-md-2">
                            <input type="text" class="required form-control" name="floor_area" id="floor_area" value="<?php echo $results->FloorArea; ?>" placeholder="___.__"/>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#floor_area").inputmask("decimal",{
                                 radixPoint:".", 
                                 digits: 2,
                                 autoGroup: true,
                                 suffix: 'sqm'
                             });
                        });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Lot Area: (sqm)</label>  
                        <div class="col-md-2">
                            <input type="text" class="required form-control" name="lot_area" id="lot_area" value="<?php echo $results->LotArea; ?>" placeholder="___.__"/>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#lot_area").inputmask("decimal",{
                                 radixPoint:".", 
                                 digits: 2,
                                 autoGroup: true,
                                 suffix: 'sqm'
                             });
                        });
                    </script>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Bedroom:</label> 
                        <div class="col-md-6 col-xs-12"> 
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bedroom" value="2" <?php echo ($results->Bedroom == 1) ? 'checked="checked"':'';?> /> 2</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bedroom" value="3" <?php echo ($results->Bedroom == 2) ? 'checked="checked"':'';?> /> 3</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bedroom" value="4" <?php echo ($results->Bedroom == 3) ? 'checked="checked"':'';?> /> 4</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Bath:</label>  
                        <div class="col-md-6 col-xs-12"> 
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bath" value="1" <?php echo ($results->Bath == 1) ? 'checked="checked"':'';?> /> 1</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bath" value="2" <?php echo ($results->Bath == 2) ? 'checked="checked"':'';?> /> 2</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="bath" value="3" <?php echo ($results->Bath == 3) ? 'checked="checked"':'';?> /> 3</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="col-md-2 control-label">Current Image 1:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY_HOUSES . $results->Image1; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 1:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image1['error_upload'])) ? '<label class="error">'. $image1['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image1" id="image1" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="col-md-2 control-label">Current Image 2:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY_HOUSES . $results->Image2; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 2:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image2['error_upload'])) ? '<label class="error">'. $image2['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image2" id="image2" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="col-md-2 control-label">Current Image 3:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY_HOUSES . $results->Image3; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 3:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image3['error_upload'])) ? '<label class="error">'. $image3['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image3" id="image3" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="col-md-2 control-label">Current Image 4:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY_HOUSES . $results->Image4; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 4:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image4['error_upload'])) ? '<label class="error">'. $image4['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image4" id="image4" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="col-md-2 control-label">Current Image 5:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY_HOUSES . $results->Image5; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 5:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image5['error_upload'])) ? '<label class="error">'. $image5['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image5" id="image5" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="col-md-2 control-label">Current Image 6:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-8" src="<?php echo FOLDER_UPLOAD_COMMUNITY_HOUSES . $results->Image6; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 6:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image6['error_upload'])) ? '<label class="error">'. $image6['error_upload'].'</label>':'<em>(JPG format | Width: 1000px | Height: 750px)</em>'; ?></label>   
                            <input type="file" name="image6" id="image6" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Status:</label>
                            <div class="col-md-6 col-xs-12"> 
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="iradio" name="status" value="0" <?=(($results->Status == 0) ? 'checked="checked"' : '')?>/> Active</label>
                                </div>
                                <div class="col-md-12">                                    
                                    <label class="check"><input type="radio" class="icheckbox" name="status" value="1" <?=(($results->Status == 1) ? 'checked="checked"' : '')?>/> Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('community/houses/id/' . $this->uri_segments['comid']);?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code = 'gallery') : ?>
    <div class="content-frame-right">                        
        <div class="block push-up-10">
            <form action="<?php echo base_url() ?>community/uploadGallery/id/<?php echo $this->uri_segments['id'];?>" id="my-awesome-dropzone" class="dropzone dropzone-mini"></form>
        </div>                        
    </div>
    
    <div class="content-frame-body content-frame-body-left">
        <div class="col-md-12">
            <h4 class="text-warning push-up-5">(JPG|PNG format | Width: 1000px | Height: 750px)</h4>
        </div>

        <div class="pull-left push-up-10">
            <button class="btn btn-primary" id="gallery-toggle-items">Toggle All</button>
        </div>
        <div class="pull-right push-up-10">
            <div class="btn-group">
                <button class="btn btn-primary" id="gallery-remove-multiple"><span class="fa fa-trash-o"></span> Remove</button>
            </div>                            
        </div>
        
        <div class="gallery" id="links">
            <?php if(!empty($results)) : ?>
                <input type="hidden" id="comid" value="<?php echo $this->uri_segments['id']; ?>"/>
                <?php foreach ($results as $result) : ?>
                    <a class="gallery-item">
                        <div class="image">
                            <img src="<?php echo FOLDER_UPLOAD_COMMUNITY_GALLERY ?><?=$result->Name?>" alt="<?=$result->Name?>"/>   

                            <ul class="gallery-item-controls">
                                <form id="gallery-form" method="post">
                                  <li><label class="check"><input type="checkbox" class="icheckbox" name="gallery_id[]" value="<?=$result->GalleryID?>" id="gallery-checkbox"/></label></li>
                                  <li><span data-id="<?=$result->GalleryID?>" data-name="<?=$result->Name?>" class="gallery-item-remove"><i class="fa fa-times"></i></span></li>
                                </form>
                            </ul>
                        </div>
                        <div class="meta">
                            <input type="text" value="<?php echo FOLDER_UPLOAD_COMMUNITY_GALLERY  ?><?=$result->Name?>" class="form-control gallery" readonly>
                            <span><?=$this->mgeneral->dateTimeFormat($result->DateCreated)?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-danger push-up-20">
                    <strong>No images to show.</strong>
                </div>
            <?php endif; ?>
        </div>

        <script type="text/javascript">
            //Gallery Remove Button - Added 03/11/2015
            $("#gallery-remove-multiple").on("click",function(){
                if(!$('input[name="gallery_id[]"]:checked').length) {
                    
                } else {
                    var gallery_id = [];
                    $(':checkbox:checked').each(function(i){
                      gallery_id[i] = $(this).val();
                    });

                    $('.load-content').load('<?php echo base_url(); ?>community/galleryRemove/comid/<?php echo $this->uri_segments["id"]; ?>/gallery_id/'+gallery_id,function(result){
                        $('#db-modal').modal({show:true});
                    });
                }
            });

            //Gallery Checkbox - Added 03/10/2015
            $(".gallery-item .iCheck-helper").on("click",function(){
                var gallery = $(this).parent("div");
                if(gallery.hasClass("checked")){
                    $(this).parents(".gallery-item").addClass("active");
                    gallery.find("input").attr("checked",true);
                }else{            
                    $(this).parents(".gallery-item").removeClass("active");
                    gallery.find("input").attr("checked",false);
                }
            });

            //Gallery Toogle All - Added 03/10/2015
            $("#gallery-toggle-items").on("click",function(){
                $(".gallery-item").each(function(){
                    var gallery = $(this).find(".iCheck-helper").parent("div");
                    
                    if(gallery.hasClass("checked")){
                        $(this).removeClass("active");
                        gallery.removeClass("checked");
                        gallery.find("input").prop("checked",false);
                        $(this).find("input").attr("checked",false);
                        // $("#gallery-remove-all").attr('disabled',true);
                    }else{            
                        $(this).addClass("active");
                        gallery.addClass("checked");
                        gallery.find("input").prop("checked",true);
                        $(this).find("input").attr("checked",true);
                        // $("#gallery-remove-all").attr('disabled',false);
                    }
                });
            });

            //Gallery Image Remove - Added 03/10/2015
            $(".gallery-item-remove").on("click",function(){
                var id = $(this).data('id');
                var name = encodeURI($(this).data('name'));
                var comid = document.getElementById('comid').value;

                $('.load-content').load('<?php echo base_url(); ?>community/galleryRemove/comid/'+comid+'/name/'+name+'/id/'+id, function(result){
                    $('#db-modal').modal({show:true});
                });
            });
        </script>
             
    </div>    
<?php endif; ?>

</div>

<?php $this->load->view('default/footer'); ?>

<script type="text/javascript">
    var result = null;

    Dropzone.options.myAwesomeDropzone  = {
      paramName: "file", // The name that will be used to transfer the file
      success: function(file, response){
                location.reload();
            }
    };

    $('#summernote_1').summernote({
        height: 250,

        codemirror: { // codemirror options
           theme: 'monokai'
        },

        toolbar: [

          ['font', ['bold', 'italic', 'underline', 'clear']], 

          ['view', ['fullscreen', 'codeview']],    

          ['height', ['height']],   

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) {
            var value_tag = $('#summernote_1').code();
            var value = $('#summernote_1').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) {
                $("#description").val(value);
                $("#description_wo_tags").val(value);
            } else {
                $("#description").val(value_tag);
                $("#description_wo_tags").val(value);
            }
        },                           
    });

    $('#summernote_2').summernote({
        height: 250,

        codemirror: { // codemirror options
           theme: 'monokai'
        },

        toolbar: [

          ['font', ['bold', 'italic', 'underline', 'clear']], 

          ['view', ['fullscreen', 'codeview']],    

          ['height', ['height']],   

          ['paragraph', ['ul']],   

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) {
            var value_tag = $('#summernote_2').code();
            var value = $('#summernote_2').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) 
                $("#amenities").val(value);
            else
                $("#amenities").val(value_tag);
        },                           
    });

    $('#summernote_3').summernote({
        height: 250,

        codemirror: { // codemirror options
           theme: 'monokai'
        },

        toolbar: [

          ['font', ['bold', 'italic', 'underline', 'clear']], 

          ['view', ['fullscreen', 'codeview']],    

          ['height', ['height']],   

          ['paragraph', ['ul']],   

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) {
            var value_tag = $('#summernote_3').code();
            var value = $('#summernote_3').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) {
                $("#description").val(value);
                $("#description_wo_tags").val(value);
            } else {
                $("#description").val(value_tag);
                $("#description_wo_tags").val(value);
            }
        },                           
    });
</script>