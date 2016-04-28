<?php $this->load->view('default/header'); ?>

<div class="content-frame">  

    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?php echo $pageInfo->header?></h2>
        </div>                             
        <div class="pull-right">            
            <?php if($this->uri->segment(2) != 'create' && $this->uri->segment(2) != 'contents' && $this->uri->segment(2) != 'modifyBanner') : ?>
                <a href="<?php echo base_url(); ?>careers/create"  class="btn btn-primary">Create Position</a>
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
                            <th width="8%">Career ID#</th>
                            <th width="13%">Last Modified</th>
                            <th>Position</th>
                            <th width="13%">Date Created</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result) : ?>
                            <tr>
                                <td><?=$result->CareerID?></td> 
                                <td><?=$this->mgeneral->timeAgo($result->DateModified)?></td> 
                                <td>
                                    <li class="dropdown no-decoration">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$result->Position?></a>                                            
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url(); ?>careers/modify/id/<?=$result->CareerID?>">Modify</a></li>
                                            <li><a href="#" id="remove-<?=$result->CareerID?>" data-id="<?=$result->CareerID?>" data-position="<?=$result->Position?>">Remove</a></li>
                                        </ul>                                   
                                    </li>
                                </td>
                                <td><?=$this->mgeneral->dateFormat($result->DateCreated)?></td> 
                                <td><?= ($result->Status == 0) ? 'Active':'Inactive' ?></td>   
                            </tr>

                            <script type="text/javascript">
                                $('#remove-'+<?=$result->CareerID?>).click(function(){
                                    var id = $(this).data('id');
                                    var position = encodeURI($(this).data('position'));

                                    $('.load-content').load('<?php echo base_url(); ?>careers/remove/id/'+id+'/position/'+position,function(result){
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
            <div class="col-md-12">
                <h4 class="text-warning push-up-5">Create a Position</h4>
                <ol>
                    <li>For Responsibilities and Requirements it will be displayed on how you arranged it in the editor.</li>
                    <li>Select Status of Position, if active it will be displayed in the site.</li>
                </ol>
            </div>
        
            <form action="<?php echo base_url('careers/save');?>" method="POST" class="form-horizontal" id="form-career-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Position:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="position"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Responsibilities:</label>  
                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->
                            
                            <textarea id="responsibilities" name="responsibilities" style="display: none;"></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"></textarea>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Requirements:</label>
                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->
                            
                            <textarea id="requirements" name="requirements" style="display: none;"></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_2" id="summernote_2" style="resize:none; width:100%; height:100px;"></textarea>
                            </div>
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
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('careers/vacancies');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modify') : ?>
    <div class="content-frame-body content-frame-body-left">
        <div class="block">
            <div class="col-md-12">
                <h4 class="text-warning push-up-5">Modify Position</h4>
                <ol>
                    <li>For Responsibilities and Requirements it will be displayed on how you arranged it in the editor.</li>
                    <li>Select Status of Position if active it will be displayed in the site.</li>
                </ol>
            </div>
        
            <form action="<?php echo base_url('careers/save/id/' . $results->CareerID);?>" method="POST" class="form-horizontal" id="form-career-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Position:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="position" value="<?= $results->Position; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Responsibilities:</label>  
                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->
                            
                            <textarea id="responsibilities" name="responsibilities" style="display: none;"><?php echo $results->Responsibilities; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $results->Responsibilities; ?></textarea>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Requirements:</label>
                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->
                            
                            <textarea id="requirements" name="requirements" style="display: none;"><?php echo $results->Requirements; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_2" id="summernote_2" style="resize:none; width:100%; height:100px;"><?php echo $results->Requirements; ?></textarea>
                            </div>
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
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('careers/vacancies');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modify_banner') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('careers/saveBanner/id/' . $results->PageID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                            <label class="col-md-12"><?= (!empty($career_banner['error_upload'])) ? '<label class="error">'. $career_banner['error_upload'].'</label>':'<em>(JPG format | Width: 2000px | Height: 1004px)</em>'; ?></label>   
                            <input type="file" name="career_banner" id="career_banner" class="form-control"/>
                        </div>
                        <!-- <a href="<?php echo FOLDER_UPLOAD_PAGES . $results->Image; ?>" class="col-md-2 control-label" rel="shadowbox">View Current Image</a> -->
                    </div>
                    
                    <div class="panel-footer">
                        <!-- <a class="btn btn-primary" type="button" href="<?php echo base_url('careers');?>">Cancel</a> -->
                        <button class="btn btn-primary" type="submit" name="upload-btn">Update</button>
                    </div> 
                </div>                                               
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'contents') : ?>
    <div class="content-frame-body content-frame-body-left">
        <!-- <div class="col-md-12">
            <h4 class="text-warning push-up-5">Modify Project Page.</h4>
        </div> -->

        <div class="block">        
            <form action="<?php echo base_url('careers/saveContent');?>" method="POST" class="form-horizontal" id="form-careers-content-validate">
                <div class="panel-body">
                    <?php
                        $results = $this->mtables->getContents('careers_content');
                        $careers_content = $this->mtables->flatten_array($results);
                    ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Careers Content:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 500 charaters.)</em></label>
                            </div>

                            <textarea id="careers_content" name="careers_content" style="display: none;"><?php echo $careers_content->Content; ?></textarea>
                            <textarea id="careers_content_wo_tags" name="careers_content_wo_tags" style="display: none;"><?php echo strip_tags($careers_content->Content); ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_3" id="summernote_3" style="resize:none; width:100%; height:100px;"><?php echo $careers_content->Content; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
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

            if (value == null) {
                $("#responsibilities").val(value);
            } else {
                $("#responsibilities").val(value_tag);
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

            if (value == null) {
                $("#requirements").val(value);
            } else {
                $("#requirements").val(value_tag);
            }
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

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) {
            var value_tag = $('#summernote_3').code();
            var value = $('#summernote_3').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) {
                $("#careers_content").val(value);
                $("#careers_content_wo_tags").val(value);
            } else {
                $("#careers_content").val(value_tag);
                $("#careers_content_wo_tags").val(value);
            }
        },                           
    });
</script>