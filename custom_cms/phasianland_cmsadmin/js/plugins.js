$(function() {

    var formElements = function(){                
        // Bootstrap datepicker
        var feDatepicker = function(){                        
            if($(".datepicker").length > 0){
                $(".datepicker").datepicker({format: 'yyyy-mm-dd'});                
                $("#dp-2,#dp-3,#dp-4").datepicker(); // Sample
            }           
            
        }// END Bootstrap datepicker
        
        //Bootstrap timepicker
        var feTimepicker = function(){
            // Default timepicker
            if($(".timepicker").length > 0)
                $('.timepicker').timepicker();
            
            // 24 hours mode timepicker
            if($(".timepicker24").length > 0)
                $(".timepicker24").timepicker({minuteStep: 5,showSeconds: true,showMeridian: false});
            
        }// END Bootstrap timepicker
        
        //Daterangepicker 
        var feDaterangepicker = function(){
            if($(".daterange").length > 0)
               $(".daterange").daterangepicker({format: 'YYYY-MM-DD',startDate: '2013-01-01',endDate: '2013-12-31'});
        }
        // END Daterangepicker
        
        //Bootstrap colopicker        
        var feColorpicker = function(){
            // Default colorpicker hex
            if($(".colorpicker").length > 0)
                $(".colorpicker").colorpicker({format: 'hex'});
            
            // RGBA mode
            if($(".colorpicker_rgba").length > 0)
                $(".colorpicker_rgba").colorpicker({format: 'rgba'});
            
            // Sample
            if($("#colorpicker").length > 0)
                $("#colorpicker").colorpicker();
            
        }// END Bootstrap colorpicker
        
        //Bootstrap select
        var feSelect = function(){
            if($(".select").length > 0){
                $(".select").selectpicker();
                
                $(".select").on("change", function(){
                    if($(this).val() == "" || null === $(this).val()){
                        if(!$(this).attr("multiple"))
                            $(this).val("").find("option").removeAttr("selected").prop("selected",false);
                    }else{
                        $(this).find("option[value="+$(this).val()+"]").attr("selected",true);
                    }
                });
            }
        }//END Bootstrap select
        
        
        //Validation Engine
        var feValidation = function(){
            if($("form[id^='validate']").length > 0){
                
                // Validation prefix for custom form elements
                var prefix = "valPref_";
                
                //Add prefix to Bootstrap select plugin
                $("form[id^='validate'] .select").each(function(){
                   $(this).next("div.bootstrap-select").attr("id", prefix + $(this).attr("id")).removeClass("validate[required]");
                });
                
                // Validation Engine init
                $("form[id^='validate']").validationEngine('attach', {promptPosition : "bottomLeft", scroll: false,
                                                                        onValidationComplete: function(form, status){
                                                                            form.validationEngine("updatePromptsPosition");
                                                                        },
                                                                        prettySelect : true,
                                                                        usePrefix: prefix 
                                                                     });              
            }
        }//END Validation Engine
        
        //Masked Inputs
        var feMasked = function(){            
            if($("input[class^='mask_']").length > 0){
                $("input.mask_tin").mask('99-9999999');
                $("input.mask_ssn").mask('999-99-9999');        
                $("input.mask_date").mask('9999-99-99');
                $("input.mask_product").mask('a*-999-a999');
                $("input.mask_phone").mask('99 (999) 999-99-99');
                $("input.mask_phone_ext").mask('99 (999) 999-9999? x99999');
                $("input.mask_credit").mask('9999-9999-9999-9999');        
                $("input.mask_percent").mask('99%');
            }            
        }//END Masked Inputs
        
        //Bootstrap tooltip
        var feTooltips = function(){            
            $("body").tooltip({selector:'[data-toggle="tooltip"]',container:"body"});
        }//END Bootstrap tooltip
       
        //Bootstrap Popover
        var fePopover = function(){            
            $("[data-toggle=popover]").popover();
            $(".popover-dismiss").popover({trigger: 'focus'});
        }//END Bootstrap Popover
        
        //Tagsinput
        var feTagsinput = function(){
            if($(".tagsinput").length > 0){
                
                $(".tagsinput").each(function(){
                    
                    if($(this).data("placeholder") != ''){
                        var dt = $(this).data("placeholder");
                    }else
                        var dt = 'add a tag';
                                                            
                    $(this).tagsInput({width: '100%',height:'auto',defaultText: dt});
                });

            }
        }// END Tagsinput
        
        //iCheckbox and iRadion - custom elements
        var feiCheckbox = function(){
            if($(".icheckbox").length > 0){
                 $(".icheckbox,.iradio").iCheck({checkboxClass: 'icheckbox_minimal-grey',radioClass: 'iradio_minimal-grey'});
            }
        }
        // END iCheckbox
        
        //Bootstrap file input
        var feBsFileInput = function(){
            
            if($("input.fileinput").length > 0)
                $("input.fileinput").bootstrapFileInput();
            
        }
        //END Bootstrap file input
        
        return {// Init all form element features
		init: function(){                    
                    feDatepicker();
                    feTimepicker();
                    feColorpicker();
                    feSelect();
                    feValidation();
                    feMasked();
                    feTooltips();
                    fePopover();
                    feTagsinput();
                    feiCheckbox();
                    feBsFileInput();
                    feDaterangepicker();
                }
        }
    }();

    var uiElements = function(){
        
        //Datatables
        var uiDatatable = function(){
            
            var asOrderVals = $("meta[property='cpanel:order']").attr('content');
            var asSortVals = $("meta[property='cpanel:sort']").attr('content');

            if($(".datatable").length > 0){       
                $(".datatable").dataTable({
                    "oLanguage": {
                        // "oAria": {
                        //     "sSortAscending": " - click/return to sort ascending",
                        //     "sSortDescending": " - click/return to sort descending"
                        //   },
                        "sSearch": "<span>Search:</span> _INPUT_",
                        // "sLengthMenu": "<span>Show result:</span> _MENU_",
                        "sLengthMenu": "<span>Display:</span><select class='btn dropdown-toggle selectpicker btn-default'>"+
                            "<option value='10'>10</option>"+
                            "<option value='25'>25</option>"+
                            "<option value='50'>50</option>"+
                            "<option value='-1'>All</option>"+
                        "</select>",
                        "sInfo": "",
                        "sInfoEmpty": "",
                        "sInfoPostFix": "",
                        "sInfoFiltered": "Filtered from _MAX_ total entries",
                        "oPaginate": { "sNext": "Next →", "sPrevious": "← Previous" },
                        "sZeroRecords": "No result found"
                    },
                    "order": [[ 0, asOrderVals ]],
                    "aoColumnDefs": [
                      { "bSortable": false, "aTargets": asSortVals }
                    ]
                });

                $(".datatable").on('page.dt',function () {
                    onresize(100);
                });
            }
            
            if($(".datatable_simple").length > 0){                
                $(".datatable_simple").dataTable({"ordering": false, "info": false, "lengthChange": false,"searching": false});
                $(".datatable_simple").on('page.dt',function () {
                    onresize(100);
                });                
            }            
        }//END Datatable

        // Custom Content Scroller
        var uiScroller = function(){
            
            if($(".scroll").length > 0){
                $(".scroll").mCustomScrollbar({axis:"y", autoHideScrollbar: true, scrollInertia: 20, advanced: {autoScrollOnFocus: false}});
            }
            
        }// END Custom Content Scroller  

        //OWL Carousel
        var uiOwlCarousel = function(){
            
            if($(".owl-carousel").length > 0){
                $(".owl-carousel").owlCarousel({mouseDrag: false, touchDrag: true, slideSpeed: 300, paginationSpeed: 400, singleItem: true, navigation: false,autoPlay: true});
            }
            
        }//End OWL Carousel

        // Summernote 
        var uiSummernote = function(){
            /* Extended summernote editor */
            if($(".summernote").length > 0){
                $(".summernote").summernote({height: 250,
                                                toolbar: [
                                                      ["style", ["bold", "italic", "underline", "clear"]],
                                                      ['para', ['ul', 'ol', 'paragraph']]                                                 
                                                  ]
                                             
                });
            }
            /* END Extended summernote editor */
            
            /* Lite summernote editor */
            if($(".summernote_lite").length > 0){
                
                $(".summernote_lite").on("focus",function(){
                    
                    $(".summernote_lite").summernote({height: 100, focus: true,
                                                      toolbar: [
                                                          ["style", ["bold", "italic", "underline", "clear"]],
                                                          ["insert",["link","picture","video"]]                                                          
                                                      ]
                                                     });
                });                
            }
            /* END Lite summernote editor */
            
            /* Email summernote editor */
            if($(".summernote_email").length > 0){
                                                    
                $(".summernote_email").summernote({height: 400, focus: true,
                                                  toolbar: [
                                                      ['style', ['bold', 'italic', 'underline', 'clear']],
                                                      ['font', ['strikethrough']],
                                                      ['fontsize', ['fontsize']],
                                                      ['color', ['color']],
                                                      ['para', ['ul', 'ol', 'paragraph']],
                                                      ['height', ['height']]                                                          
                                                  ]
                                                 });
                
            }
            /* END Email summernote editor */
            
        }// END Summernote

        //Validation Engine
        var feValidation = function(){
            if($("form[id^='validate']").length > 0){
                
                // Validation prefix for custom form elements
                var prefix = "valPref_";
                
                //Add prefix to Bootstrap select plugin
                $("form[id^='validate'] .select").each(function(){
                   $(this).next("div.bootstrap-select").attr("id", prefix + $(this).attr("id")).removeClass("validate[required]");
                });
                
                // Validation Engine init
                $("form[id^='validate']").validationEngine('attach', {promptPosition : "bottomLeft", scroll: false,
                                                                        // onValidationComplete: function(form, status){
                                                                        //     form.validationEngine("updatePromptsPosition");
                                                                        // },
                                                                        prettySelect : true,
                                                                        usePrefix: prefix 
                                                                     });
            }
        }//END Validation Engine       
       
        return {
            init: function(){
                uiDatatable();
                uiScroller();
                uiOwlCarousel();
                uiSummernote();
                feValidation();
            }
        }
        
    }();

    formElements.init();
    uiElements.init();

    
    /* My Custom Progressbar */
    $.mpb = function(action,options){

        var settings = $.extend({
            state: '',            
            value: [0,0],
            position: '',
            speed: 20,
            complete: null
        },options);

        if(action == 'show' || action == 'update'){
            
            if(action == 'show'){
                $(".mpb").remove();
                var mpb = '<div class="mpb '+settings.position+'">\n\
                               <div class="mpb-progress'+(settings.state != '' ? ' mpb-'+settings.state: '')+'" style="width:'+settings.value[0]+'%;"></div>\n\
                           </div>';
                $('body').append(mpb);
            }
            
            var i  = $.isArray(settings.value) ? settings.value[0] : $(".mpb .mpb-progress").width();
            var to = $.isArray(settings.value) ? settings.value[1] : settings.value;            
            
            var timer = setInterval(function(){
                $(".mpb .mpb-progress").css('width',i+'%'); i++;
                
                if(i > to){
                    clearInterval(timer);
                    if($.isFunction(settings.complete)){
                        settings.complete.call(this);
                    }
                }
            }, settings.speed);

        }

        if(action == 'destroy'){
            $(".mpb").remove();
        }                
        
    }
    /* Eof My Custom Progressbar */
               
});