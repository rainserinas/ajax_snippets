<?php $this->load->view('default/header'); ?>

<div class="content-frame">  
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?php echo $pageInfo->header?></h2>
        </div>                             
        <div class="pull-right">            
            <?php if($this->uri->segment(2) == 'lists' || $this->uri->segment(2) == 'modify') : ?>
                <a href="<?php echo base_url(); ?>news_events/create"  class="btn btn-primary">Create News & Events</a>
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
                            <th width="8%">News ID#</th>
                            <th width="13%">Last Modified</th>
                            <th>Title</th>
                            <!-- <th>Schedule</th> -->
                            <th>Location</th>
                            <th width="13%">Date Created</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result) : ?>
                            <tr>
                                <td><?=$result->NewsID?></td> 
                                <td><?=$this->mgeneral->timeAgo($result->DateModified)?></td> 
                                <td>
                                    <li class="dropdown no-decoration">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$result->Title?></a>                                            
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url(); ?>news_events/modify/id/<?=$result->NewsID?>">Modify</a></li>
                                            <li><a href="#" id="remove-<?=$result->NewsID?>" data-id="<?=$result->NewsID?>" data-title="<?=$result->Title?>">Remove</a></li>
                                        </ul>                                   
                                    </li>
                                </td>
                                <!-- <td><?=$result->Schedule?></td>  -->
                                <td><?=$result->Location?></td> 
                                <td><?=$this->mgeneral->dateFormat($result->DateCreated)?></td> 
                                <td><?= ($result->Status == 0) ? 'Active':'Inactive' ?></td>   
                            </tr>

                            <script type="text/javascript">
                                $('#remove-'+'<?=$result->NewsID?>').click(function(){
                                    var id = $(this).data('id');
                                    var title = encodeURI($(this).data('title'));

                                    $('.load-content').load('<?php echo base_url(); ?>news_events/remove/id/'+id+'/title/'+title, function(result){
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
            <!-- <div class="col-md-12">
                <h4 class="text-warning push-up-5">Create News</h4>
                <ol>
                    <li>For Description it will be displayed on how you arranged it in the editor.</li>
                    <li>Select Status of News & Events, if active it will be displayed in the site.</li>
                </ol>
            </div> -->
        
            <form action="<?php echo (empty($this->uri_segments['id'])) ? base_url('news_events/add'):base_url('news_events/add/id/' . $this->uri_segments['id']);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-news-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Title:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="title" value="<?php echo (!empty($results)) ? $results->Title:'';?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description:</label>  
                        <div class="col-md-6">
                            <textarea id="description" name="description" style="display: none;"><?php echo (!empty($results)) ? $results->Description:''; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo (!empty($results)) ? $results->Description:''; ?></textarea>
                            </div>
                        </div>
                    </div>

                   <!--  <div class="form-group">
                        <label class="col-md-2 control-label">Schedule:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="schedule" value="<?php echo (!empty($results)) ? $results->Schedule:'';?>"/>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="col-md-2 control-label">Location:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="location" value="<?php echo (!empty($results)) ? $results->Location:'';?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner:</label>                                       
                        <div class="col-md-6">
                            <label class="col-md-12"><?= (!empty($banner['error_upload'])) ? '<label class="error">'. $banner['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 1000px | Height: 800px)</em>'; ?></label>   
                            <input type="file" name="banner" id="banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Thumbnail Banner:</label>                                       
                        <div class="col-md-6">
                            <label class="col-md-12"><?= (!empty($thumb_banner['error_upload'])) ? '<label class="error">'. $thumb_banner['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 310px | Height: 310px)</em>'; ?></label>   
                            <input type="file" name="thumb_banner" id="thumb_banner" class="form-control"/>
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
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('news_events/lists');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modify') : ?>
    <div class="content-frame-body content-frame-body-left">
        <div class="block">
            <!-- <div class="col-md-12">
                <h4 class="text-warning push-up-5">Modify News</h4>
                <ol>
                    <li>For Description it will be displayed on how you arranged it in the editor.</li>
                    <li>Select Status of News & Events, if active it will be displayed in the site.</li>
                </ol>
            </div> -->
        
            <form action="<?php echo base_url('news_events/save/id/' . $results->NewsID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-news-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Title:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="title" value="<?= $results->Title; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description:</label>  
                        <div class="col-md-6">
                            <textarea id="description" name="description" style="display: none;"><?php echo $results->Description?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $results->Description?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label class="col-md-2 control-label">Schedule:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="schedule" value="<?= $results->Schedule; ?>"/>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="col-md-2 control-label">Location:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="location" value="<?= $results->Location; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Banner:</label>                                       
                        <div class="col-md-8">
                            <img class="col-md-6" src="<?php echo FOLDER_UPLOAD_NEWS . $results->Banner; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner:</label>                                       
                        <div class="col-md-6">
                            <label class="col-md-12"><?= (!empty($banner['error_upload'])) ? '<label class="error">'. $banner['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 1000px | Height: 800px)</em>'; ?></label>   
                            <input type="file" name="banner" id="banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Thumbnail Banner:</label>                                       
                        <div class="col-md-4">
                            <img class="col-md-6" src="<?php echo FOLDER_UPLOAD_NEWS . $results->ThumbBanner; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Thumbnail Banner:</label>                                       
                        <div class="col-md-6">
                            <label class="col-md-12"><?= (!empty($thumb_banner['error_upload'])) ? '<label class="error">'. $thumb_banner['error_upload'].'</label>':'<em>(JPG|PNG format | Width: 310px | Height: 310px)</em>'; ?></label>   
                            <input type="file" name="thumb_banner" id="thumb_banner" class="form-control"/>
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
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('news_events/lists');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modify_banner') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('news_events/saveBanner/id/' . $results->PageID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_PAGES . $results->Image; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($news_banner['error_upload'])) ? '<label class="error">'. $news_banner['error_upload'].'</label>':'<em>(JPG format | Width: 2000px | Height: 1004px)</em>'; ?></label>   
                            <input type="file" name="news_banner" id="news_banner" class="form-control"/>
                        </div>
                        <!-- <a href="<?php echo FOLDER_UPLOAD_PAGES . $results->Image; ?>" class="col-md-2 control-label" rel="shadowbox">View Current Image</a> -->
                    </div>
                    
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" name="upload-btn">Modify</button>
                    </div> 
                </div>                                               
            </form>
        </div>
     </div>
<?php endif ?>
</div>

<?php $this->load->view('default/footer'); ?>

<script type="text/javascript">
    $('#summernote_1').summernote({
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
            var value_tag = $('#summernote_1').code();
            var value = $('#summernote_1').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) 
                $("#description").val(value);
            else
                $("#description").val(value_tag);
        },                           
    });
</script>