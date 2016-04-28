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
            <form action="<?php echo base_url('property_finder/saveBanner/id/' . $results->PageID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-property-validate">
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
                            <label class="col-md-12"><?= (!empty($property_banner['error_upload'])) ? '<label class="error">'. $property_banner['error_upload'].'</label>':'<em>(JPG format | Width: 2000px | Height: 1004px)</em>'; ?></label>   
                            <input type="file" name="property_banner" id="property_banner" class="form-control"/>
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
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $results->Description; ?></textarea>
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

          ['insert', ['link']], 
        ],

        onChange: function(contents, $editable) { 
            var value_tag = $('#summernote_1').code();
            var value = $('#summernote_1').code().replace(/(<([^>]+)>)/ig, "").replace(/( )/, "");

            if (value == null) {
                $("#description").text(value);
                $("#description_wo_tags").text(value);
            } else {
                $("#description").text(value_tag);
                $("#description_wo_tags").text(value);
            }
        },                    
    });
</script>