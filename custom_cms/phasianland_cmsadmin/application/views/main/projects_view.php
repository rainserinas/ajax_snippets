<?php $this->load->view('default/header'); ?>

<div class="content-frame">  

    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?php echo $pageInfo->header?></h2>
        </div>              

        <div class="pull-right">   
        </div>                 
    </div> 

<?php if($pageInfo->code == 'contents') : ?>
    <div class="content-frame-body content-frame-body-left">
        <!-- <div class="col-md-12">
            <h4 class="text-warning push-up-5">Modify Project Page.</h4>
        </div> -->

        <div class="block">        
            <form action="<?php echo base_url('projects/saveContent');?>" method="POST" class="form-horizontal" id="form-project-content-validate">
                <div class="panel-body">
                    <?php
                        $results = $this->mtables->getContents('project_content');
                        $project_content = $this->mtables->flatten_array($results);
                    ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Projects Content:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 200 charaters.)</em></label>
                            </div>

                            <textarea id="project_content" name="project_content" style="display: none;"><?php echo $project_content->Content; ?></textarea>
                            <textarea id="project_content_wo_tags" name="project_content_wo_tags" style="display: none;"><?php echo strip_tags($project_content->Content); ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $project_content->Content; ?></textarea>
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

<?php endif; ?>
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
                $("#project_content").val(value);
                $("#project_content_wo_tags").val(value);
            } else {
                $("#project_content").val(value_tag);
                $("#project_content_wo_tags").val(value);
            }
        },                           
    });
</script>