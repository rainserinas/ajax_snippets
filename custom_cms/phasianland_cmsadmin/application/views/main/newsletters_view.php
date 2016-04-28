<?php $this->load->view('default/header'); ?>

<div class="content-frame">  
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?php echo $pageInfo->header?></h2>
        </div>                             
        <div class="pull-right">            
            <?php if($this->uri->segment(2) != 'create') : ?>
                <a href="<?php echo base_url(); ?>newsletters/create"  class="btn btn-primary">Create Newsletters</a>
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
                            <th width="8%">Newsletter ID#</th>
                            <th width="13%">Last Modified</th>
                            <th>Subject</th>
                            <th width="13%">Date Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result) : ?>
                            <tr>
                                <td><?=$result->NewsletterID?></td> 
                                <td><?=$this->mgeneral->timeAgo($result->DateModified)?></td> 
                                <td>
                                    <li class="dropdown no-decoration">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$result->Subject?></a>                                            
                                        <ul class="dropdown-menu">
                                            <?php if($result->Status == 0) : ?>
                                                <li><a href="<?php echo base_url(); ?>newsletters/modify/id/<?=$result->NewsletterID?>">Modify</a></li>
                                            <?php endif; ?>

                                            <li><a href="#" id="remove-<?=$result->NewsletterID?>" data-id="<?=$result->NewsletterID?>" data-subject="<?=$result->Subject?>">Remove</a></li>
                                        </ul>                                   
                                    </li>
                                </td>
                                <td><?=$this->mgeneral->dateFormat($result->DateCreated)?></td> 
                                <td><?= ($result->Status == 0) ? 'Not Sent':'Sent' ?></td>   
                                <td>
                                    <?php if($result->Status == 0) : ?>
                                        <a href="<?php echo base_url('newsletters/send/id/' . $result->NewsletterID);?>" class="btn-sm btn-info">Send to subscribers</a>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <script type="text/javascript">
                                $('#remove-'+<?=$result->NewsletterID?>).click(function(){
                                    var id = $(this).data('id');
                                    var subject = encodeURI($(this).data('subject'));

                                    $('.load-content').load('<?php echo base_url(); ?>newsletters/remove/id/'+id+'/subject/'+subject, function(result){
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
                <h4 class="text-warning push-up-5">Create a Newsletter</h4>
                <ol>
                    <li>Created Newsletters are automatically send to all subscribers.</li>
                </ol>
            </div> -->
        
            <form action="<?php echo base_url('newsletters/save');?>" method="POST" class="form-horizontal" id="form-newsletter-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Subject:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="subject"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Message:</label>  
                        <div class="col-md-6">
                            <textarea id="message" name="message" style="display: none;"><?php echo set_value('message'); ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo set_value('message'); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('newsletters');?>">Cancel</a>
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
                <h4 class="text-warning push-up-5">Modify Newsletter</h4>
                <ol>
                    <li>Created Newsletters are automatically send to all subscribers.</li>
                </ol>
            </div> -->
        
            <form action="<?php echo base_url('newsletters/save/id/' . $results->NewsletterID);?>" method="POST" class="form-horizontal" id="form-newsletter-validate">
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Subject:</label>  
                        <div class="col-md-3">
                            <input type="text" class="required form-control" name="subject" value="<?= $results->Subject; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Message:</label>  
                        <div class="col-md-6">
                            <textarea id="message" name="message" style="display: none;"><?php echo $results->Message ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $results->Message ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <a class="btn btn-primary" type="button" href="<?php echo base_url('newsletters');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div> 

                </div>                                                             
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modify_banner') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('newsletters/saveBanner/id/' . $results->PageID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-newsletter-banner-validate">
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
                            <label class="col-md-12"><?= (!empty($newsletter_banner['error_upload'])) ? '<label class="error">'. $newsletter_banner['error_upload'].'</label>':'<em>(JPG format | Width: 800px | Height: 1000px)</em>'; ?></label>   
                            <input type="file" name="newsletter_banner" id="newsletter_banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Description:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 200 charaters.)</em></label>
                            </div>

                            <textarea id="description" name="description" style="display: none;"><?php echo $results->Description; ?></textarea>
                            <textarea id="description_wo_tags" name="description_wo_tags" style="display: none;"><?php echo strip_tags($results->Description); ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_2" id="summernote_2" style="resize:none; width:100%; height:100px;"><?php echo $results->Description; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" name="upload-btn">Update</button>
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
                $("#message").val(value);
            else
                $("#message").val(value_tag);
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

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) {
            var value_tag = $('#summernote_2').code();
            var value = $('#summernote_2').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

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