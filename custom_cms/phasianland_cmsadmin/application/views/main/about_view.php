<?php $this->load->view('default/header'); ?>

<div class="content-frame">  
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?php echo $pageInfo->header?></h2>
        </div>                             
        <div class="pull-right">
        </div>                 
    </div> 

<?php if($pageInfo->code == 'modify') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('about/save/aboutid/' . $about_page->AboutID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-about-validate">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Asianland Description:</label>  
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label><em>(Maximum of 500 charaters.)</em></label>
                            </div>

                            <textarea id="description" name="description" style="display: none;"><?php echo $about_page->Description; ?></textarea>
                            <textarea id="description_wo_tags" name="description_wo_tags" style="display: none;"><?php echo strip_tags($about_page->Description); ?></textarea>
                            <div class="col-md-12">
                                <textarea class="summernote_1" id="summernote_1" style="resize:none; width:100%; height:100px;"><?php echo $about_page->Description; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Image 1 -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image 1:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_ABOUT . $about_page->Image1; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 1:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image1['error_upload'])) ? '<label class="error">'. $image1['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 400px)</em>'; ?></label>   
                            <input type="file" name="image1" id="image1" class="form-control"/>
                        </div>
                    </div>
                    <!-- End Image 1 -->

                    <!-- Image 2 -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image 2:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_ABOUT . $about_page->Image2; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 2:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image2['error_upload'])) ? '<label class="error">'. $image2['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 400px)</em>'; ?></label>   
                            <input type="file" name="image2" id="image2" class="form-control"/>
                        </div>
                    </div>
                    <!-- End Image 2 -->

                    <!-- Image 3 -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image 3:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_ABOUT . $about_page->Image3; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 3:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image3['error_upload'])) ? '<label class="error">'. $image3['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 400px)</em>'; ?></label>   
                            <input type="file" name="image3" id="image3" class="form-control"/>
                        </div>
                    </div>
                    <!-- End Image 3 -->

                    <!-- Image 4 -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image 4:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_ABOUT . $about_page->Image4; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 4:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image4['error_upload'])) ? '<label class="error">'. $image4['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 400px)</em>'; ?></label>   
                            <input type="file" name="image4" id="image4" class="form-control"/>
                        </div>
                    </div>
                    <!-- End Image 4 -->

                    <!-- Image 5 -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Image 5:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_ABOUT . $about_page->Image5; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Image 5:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?= (!empty($image5['error_upload'])) ? '<label class="error">'. $image5['error_upload'].'</label>':'<em>(JPG format | Width: 600px | Height: 800px)</em>'; ?></label>   
                            <input type="file" name="image5" id="image5" class="form-control"/>
                        </div>
                    </div>
                    <!-- End Image 5 -->
                    
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" name="upload-btn">Update</button>
                    </div> 
                </div>                                               
            </form>
        </div>
     </div>

<?php elseif($pageInfo->code == 'modify_banner') : ?>
     <div class="content-frame-body content-frame-body-left">
        <div class="block">        
            <form action="<?php echo base_url('about/saveBanner/pageid/' . $results->PageID . '/aboutid/' . $about_page->AboutID);?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="form-about-validate">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Current Main Banner:</label>                                       
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo FOLDER_UPLOAD_PAGES . $results->Image; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Main Banner:</label>                                       
                        <div class="col-md-4">
                            <label class="col-md-12"><?php echo (!empty($about_banner['error_upload'])) ? '<label class="error">'. $about_banner['error_upload'].'</label>':'<em>(JPG format | Width: 2000px | Height: 1004px)</em>'; ?></label>   
                            <input type="file" name="about_banner" id="about_banner" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banner Title:</label>  
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <label><em>(Maximum of 100 charaters.)</em></label>
                            </div>

                            <input type="text" class="required form-control" name="title" value="<?= $about_page->MainTitle; ?>"/>
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
                $("#description").val(value);
                $("#description_wo_tags").val(value);
            } else {
                $("#description").val(value_tag);
                $("#description_wo_tags").val(value);
            }
        },                           
    });
</script>