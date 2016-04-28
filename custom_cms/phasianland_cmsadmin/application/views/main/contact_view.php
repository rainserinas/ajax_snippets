<?php $this->load->view('default/header'); ?>

<div class="content-frame">  

    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?php echo $pageInfo->header?></h2>
        </div>                             
        <div class="pull-right">   
        </div>                 
    </div> 

<?php if($pageInfo->code == 'modify_banner') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('contact/saveBanner/id/' . $results->PageID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                            <label class="col-md-12"><?= (!empty($contact_banner['error_upload'])) ? '<label class="error">'. $contact_banner['error_upload'].'</label>':'<em>(JPG format | Width: 2000px | Height: 1004px)</em>'; ?></label>   
                            <input type="file" name="contact_banner" id="contact_banner" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
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
            <form action="<?php echo base_url('contact/saveContent');?>" method="POST" class="form-horizontal" id="form-contact-content-validate">
                <div class="panel-body">
                    <?php
                        $results = $this->mtables->getContents('contact_content');
                        $contact_content = $this->mtables->flatten_array($results);

                        $results = $this->mtables->getContents('bulacan_content');
                        $bulacan_content = $this->mtables->flatten_array($results);

                        $results = $this->mtables->getContents('caloocan_content');
                        $caloocan_content = $this->mtables->flatten_array($results);
                    ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Contact Content:</label>  

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 500 charaters.)</em></label>
                            </div>

                            <textarea id="contact_content" name="contact_content" style="display: none;"><?php echo $contact_content->Content; ?></textarea>
                            <textarea id="contact_content_wo_tags" name="contact_content_wo_tags" style="display: none;"><?php echo strip_tags($contact_content->Content); ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $contact_content->Content; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Bulacan Content:</label>

                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->

                            <textarea id="bulacan_content" name="bulacan_content" style="display: none;"><?php echo $bulacan_content->Content; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_2" id="summernote_2" style="resize:none; width:100%; height:100px;"><?php echo $bulacan_content->Content; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Caloocan Content:</label>

                        <div class="col-md-6">
                            <!-- <div class="col-md-12">
                                <label><em>(Maximum of 1000 charaters.)</em></label>
                            </div> -->

                            <textarea id="caloocan_content" name="caloocan_content" style="display: none;"><?php echo $caloocan_content->Content; ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_3" id="summernote_3" style="resize:none; width:100%; height:100px;"><?php echo $caloocan_content->Content; ?></textarea>
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

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) {
            var value_tag = $('#summernote_1').code();
            var value = $('#summernote_1').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) {
                $("#contact_content").val(value);
                $("#contact_content_wo_tags").val(value);
            } else {
                $("#contact_content").val(value_tag);
                $("#contact_content_wo_tags").val(value);
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

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) {
            var value_tag = $('#summernote_2').code();
            var value = $('#summernote_2').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) 
                $("#bulacan_content").val(value);
            else
                $("#bulacan_content").val(value_tag);
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

            if (value == null) 
                $("#caloocan_content").val(value);
            else
                $("#caloocan_content").val(value_tag);
        },                           
    });
</script>