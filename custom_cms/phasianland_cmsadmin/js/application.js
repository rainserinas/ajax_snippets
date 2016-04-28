/*! Designblue Manila - creative instinct
//@ Web Developer: Ralph Dayne B. Banzon
*/

$(document).ready(function(){
    var loadPromises = [];
    var oTable;
    var base_url = $("meta[property='cpanel:url']").attr('content');
    var navi = $("meta[property='cpanel:navigation']").attr('content');
    var curr_url = $(location).attr('href');
    var comment_submit = base_url  + 'support/save';

    //Deferred Jquery.load() - Added 03/10/2015
    function deferredLoad(target, url) {
        return $.Deferred(function(deferred) {
            $(target).load(url, function() {
                deferred.resolve();
            });
        }).promise();
    }

    //Login Validation - Added 02/05/2015
    $("#login-validate").validate({
    ignore: [],
        rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            } ,
        messages: {
            email: {
                required: "Please enter your email address",
            },
            password: {
                required: "Please enter your password"
            }
        }                                    
    });

    //Toggle Navigation - Added 02/27/2015
    $('#x-navigation').click (function(event) {
        event.preventDefault();
        // console.log(navi);
        $.ajax({
            type: "POST",
            url: "auth/xnavigation",
            data: {"value":navi}
       }).done(function() {
          //set cookies for xnavigation
       });
    });

    //Bug Tracker Comment AJAX - Added 03/05/2015
    $("#comment-form").on("submit", function(event){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: comment_submit,
            data: $("#comment-form").serialize(),
            success: function() {
                $('#comment-message-field').val('');
                $('#comment-message-submit').attr('disabled', 'true');
                $('#comment-message-wrapper').load(curr_url + ' #comment-message-wrapper' , function() {
                    $(this).find('.item').addClass('item-visible');
                });
            }
        })

    });

    //Refresh Comment Every 1 Second - Added 03/05/2015
    var load_comment = setInterval(
    function () {
        $('#comment-message-wrapper').load(curr_url + ' #comment-message-wrapper' , function() {
            $(this).find('.item').addClass('item-visible');
        });
    }, 1000);

    //Refresh Banner Ads Report Every 5 Second - Added 03/19/2015
    // var bannerAdsLoad = setInterval(
    // function () {
    //     $('#ads_report').load(curr_url + ' #ads_report' , function() {      

    //         if($.fn.dataTable.isDataTable( '.datatable' )) {
    //             table = $('.datatable').DataTable();
    //         }
    //         else {
    //             table = $('.datatable').DataTable( {
    //                 paging: false,
    //                 searching: false
    //             } );
    //         }
    //     });
    // }, 1000);

    //Disable Submit Comment - Added 03/06/2015
    $('#comment-message-field').keyup(function() {
        if($(this).val() !== ""){
            $('#comment-message-submit').removeAttr('disabled');
        } else {
            $('#comment-message-submit').attr('disabled', 'true');
        }
    });

    //Gallery Dropzone - Added 03/10/2015
    /*Dropzone.options.galleryDropzone = {
        maxFilesize: 5,
        acceptedFiles: ".jpg, .gif, .png",
        init: function() {
          // this.on("addedfile", function(file) {
          //   var removeButton = Dropzone.createElement("<a class='dz-remove'>Remove file</a>");
          //   var _this = this;

          //   removeButton.addEventListener("click", function(e) {
          //       e.preventDefault();
          //       e.stopPropagation();
          //       _this.removeFile(file);
              
          //       var name = file.name;

          //       $.ajax({
          //           type: 'POST',
          //           url: gallery_remove,
          //           data: {"value":name}
          //       }).done(function() {
          //           $("#links").html("<img src='./img/loading.gif' alt='loading...' />");

          //           loadPromises.push(deferredLoad('#links', curr_url + ' #links'));

          //           $.when.apply(null, loadPromises).done(function() {
          //               $(".gallery-item-remove").on("click",function(){
          //                   $(this).parents(".gallery-item").fadeOut(400,function(){
          //                       $(this).remove();
          //                   });
          //                   return false;
          //               });
          //           });
          //       });

          //   });

          //   file.previewElement.appendChild(removeButton);
          // });

          this.on("uploadprogress", function(file) {
            $("#links").html("<img src='./img/loading.gif' alt='loading...' />");
          });

          this.on("success", function(file) {

            loadPromises.push(deferredLoad('#links', curr_url + ' #links'));

            $.when.apply(null, loadPromises).done(function() {
                $(".gallery-item-remove").on("click",function(){
                    var id = $(this).data('id');
                    var name = $(this).data('name');

                    $('.load-content').load('<?php echo base_url(); ?>community/galleryRemove/name/'+ name +'/id/'+id,function(result){
                        $('#db-modal').modal({show:true});
                    });
                });

                if($(".icheckbox").length > 0){
                     $(".icheckbox,.iradio").iCheck({checkboxClass: 'icheckbox_minimal-grey',radioClass: 'iradio_minimal-grey'});
                }
            });

          });

          this.on("error", function(file) {

            loadPromises.push(deferredLoad('#links', curr_url + ' #links'));

            $.when.apply(null, loadPromises).done(function() {
                $(".gallery-item-remove").on("click",function(){
                    var id = $(this).data('id');
                    var name = $(this).data('name');

                    $('.load-content').load('<?php echo base_url(); ?>community/galleryRemove/name/'+ name +'/id/'+id,function(result){
                        $('#db-modal').modal({show:true});
                    });
                });

                if($(".icheckbox").length > 0){
                     $(".icheckbox,.iradio").iCheck({checkboxClass: 'icheckbox_minimal-grey',radioClass: 'iradio_minimal-grey'});
                }
            });

          });

        }
    }*/

    //Video Ads Pop-up pause - Added 03/24/2015
    /*$('#db-modal').on('hidden.bs.modal', function (e) {
      $("#ads-video-container")[0].pause();
    });*/

    //Loading Gif on User Avatar - Added 03/24/2015
    $('.profile-image #avatar-loader').show();
    $('.profile-image #avatar-main').hide();
    
    $('.profile-image #avatar-main').on('load', function(){
        $('.profile-image #avatar-main').show();
        $('.profile-image #avatar-loader').hide();
    });

    //Date Filter - Added 04/01/2015
    if($("#reportrange").length > 0){   
        $("#reportrange").daterangepicker({                    
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment()
          },function(start, end) {
              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
        
        $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }

    //Banner Ads Show Image - Added 03/17/2015
    $("#banner-ads-show-image").on("click",function(){
        event = event || window.event;
        var target = event.target || event.srcElement;
        var link = target.src ? target.parentNode : target;
        var options = {index: link, event: event,onclosed: function(){
                setTimeout(function(){
                    $("body").css("overflow","");
                },200);                        
            }};
        var links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    });

    //Front End Users Table Loader - Added 04/09/2015
    $('#users-table-loader').show();
    var load_user_table = setTimeout(function() {
        $("#users-table").bind("delayshow", function (event, timeout) {
            var $self = $(this);
            $self.data('timeout', setTimeout(function () {
                $self.fadeIn(600);
            }, timeout));
        });

        $("#users-table-loader").bind("delayhide", function (event, timeout) {
            var $self = $(this);
            $self.data('timeout', setTimeout(function () {
                $self.hide();
            }, timeout));
        });

        $("#users-table").trigger('delayshow', 1000);
        $("#users-table-loader").trigger('delayhide', 1000);
    }, 1000);

    //Table CSV Export - Added 04/09/2014
    var asInitVals = new Array();
    var asOrderVals = $("meta[property='cpanel:order']").attr('content');
    var asSortVals = $("meta[property='cpanel:sort']").attr('content');

    var oTable = $('#export_csv').dataTable({
        "oLanguage": {
            "sSearch": "<span>Search:</span> _INPUT_",
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

    // export only what is visible right now (filters & pagination applied)
    $('#export_visible').click(function(event) {
        event.preventDefault();
        table2csv(oTable, 'visible', '#export_csv');
        $('#download-action').show();
    })
     
    // export all table data
    $('#export_all').click(function(event) {
        event.preventDefault();
        table2csv(oTable, 'full', '#export_csv');
        $('#download-action').show();
    })

    //Hide download button when clicked
    // export all table data
    $('#download-csv').click(function(event) {
        $('#download-action').hide();
    })

    //Validation - Added 02/10/2015
    $("#form-validate").validate({
    ignore: [],
        rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                're-password': {
                    equalTo: "#password2"
                },
                title: {
                    required: true
                },
                version_name: {
                    required: true
                },
                version_code: {
                    required: true
                },
            } ,
        messages: {
            firstname: {
                required: "Please Enter Firstname.",
            },
            lastname: {
                required: "Please Enter Lastname.",
            },
            email: {
                required: "Please Enter Email Address.",
            },
            password: {
                required: "Please Enter Password.",
                minlength: "Password must contain atleast 5 characters.",
            },
            're-password': {
                equalTo: "Password does not match the confirm password.",
            },
            version_name: {
                required: "Please enter version name of the update.",
            },
            version_code: {
                required: "Please enter version code of the update.",
            },
        }       
    });

    $("#form-about-validate").validate({
        ignore: [],
            rules: {
                    title: {
                        required: true,
                        maxlength: 100,
                    },
                    description: {
                        required: true,
                    },
                    description_wo_tags: {
                        required: true,
                        maxlength: 499,
                    },
                } ,
            messages: {
                title: {
                    required: "Please Enter Banner Title.",
                },
                description: {
                    required: "Please Enter Asianland Description.",
                },
                description_wo_tags: {
                    maxlength: "Please enter no more than 500 characters.",
                },
            }       
        });

    $("#form-career-validate").validate({
        ignore: [],
            rules: {
                    position: {
                        required: true,
                    },
                    responsibilities: {
                        required: true,
                    },
                    requirements: {
                        required: true,
                    },
                    status: {
                        required: true
                    },
                } ,
            messages: {
                position: {
                    required: "Please Enter Position.",
                },
                responsibilities: {
                    required: "Please Enter Responsibilities.",
                },
                requirements: {
                    required: "Please Enter Requirements.",
                },
                status: {
                    required: "Please Select Status.",
                },
            }       
        });

    $("#form-news-validate").validate({
        ignore: [],
            rules: {
                    title: {
                        required: true,
                    },
                    description: {
                        required: true
                    },
                    /*schedule: {
                        required: true
                    },*/
                    location: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                } ,
            messages: {
                title: {
                    required: "Please Enter Title.",
                },
                description: {
                    required: "Please Enter Description.",
                },
                /*schedule: {
                    required: "Please Enter Schedule.",
                },*/
                location: {
                    required: "Please Enter Location.",
                },
                status: {
                    required: "Please Select Status.",
                },
            }       
        });

    $("#form-newsletter-validate").validate({
        ignore: [],
            rules: {
                    subject: {
                        required: true,
                    },
                    message: {
                        required: true
                    },
                } ,
            messages: {
                subject: {
                    required: "Please Enter Subject.",
                },
                message: {
                    required: "Please Enter Message.",
                },
            }       
        });

    $("#form-newsletter-banner-validate").validate({
        ignore: [],
            rules: {
                    description: {
                        required: true,
                    },
                    description_wo_tags: {
                        maxlength: 199,
                    }
                } ,
            messages: {
                description: {
                    required: "Please Enter Description.",
                },
                description_wo_tags: {
                    maxlength: "Please enter no more than 200 characters.",
                },
            }       
        });

    $("#form-community-validate").validate({
        ignore: [],
            rules: {
                    cname: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    description_wo_tags: {
                        maxlength: 199,
                    },
                    amenities: {
                        required: true,
                    },
                    latitude: {
                        required: true
                    },
                    longtitude: {
                        required: true
                    },
                    residences: {
                        required: true,
                        maxlength: 200
                    },
                    status: {
                        required: true
                    },

                } ,
            messages: {
                cname: {
                    required: "Please Enter Name.",
                },
                description: {
                    required: "Please Enter Description.",
                },
                description_wo_tags: {
                    maxlength: "Please enter no more than 200 characters.",
                },
                amenities: {
                    required: "Please Enter Amenities.",
                },
                latitude: {
                    required: "Please Enter Latitude.",
                },
                longtitude: {
                    required: "Please Enter Longtitude.",
                },
                residences: {
                    required: "Please Enter Residences Name.",
                },
                status: {
                    required: "Please Select Status.",
                },
            }       
        });

    $("#form-houses-validate").validate({
        ignore: [],
            rules: {
                    model_name: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    description_wo_tags: {
                        maxlength: 999,
                    },
                    location: {
                        required: true,
                    },
                    estimated_price: {
                        required: true,
                        number: true,
                    },
                    classification: {
                        required: true,
                    },
                    floor_area: {
                        required: true,
                        number: true,
                    },
                    lot_area: {
                        required: true,
                        number: true,
                    },
                    bedroom: {
                        required: true,
                        number: true,
                    },
                    bath: {
                        required: true,
                        number: true,
                    },
                    status: {
                        required: true,
                    },

                } ,
            messages: {
                model_name: {
                    required: "Please Enter Model Name.",
                },
                type: {
                    required: "Please Select Type.",
                },
                description: {
                    required: "Please Enter Description.",
                },
                description_wo_tags: {
                    maxlength: "Please enter no more than 1000 characters.",
                },
                location: {
                    required: "Please Enter Location.",
                },
                estimated_price: {
                    required: "Please Enter Estimated Price.",
                },
                classification: {
                    required: "Please Select Classification.",
                },
                floor_area: {
                    required: "Please Enter Floor Area.",
                },
                lot_area: {
                    required: "Please Enter Lot Area.",
                },
                bedroom: {
                    required: "Please Enter number of Bedroom.",
                },
                bath: {
                    required: "Please Enter number of Bath.",
                },
                status: {
                    required: "Please Enter Status.",
                },
            }       
        });

    $("#form-project-content-validate").validate({
        ignore: [],
            rules: {
                    project_content: {
                        required: true,
                    },
                    project_content_wo_tags: {
                        maxlength: 199
                    },
                },
            messages: {
                project_content: {
                    required: "Please Enter Project Content.",
                },
                project_content_wo_tags: {
                    maxlength: "Please enter no more than 200 characters.",
                },
            }       
        });

    $("#form-careers-content-validate").validate({
        ignore: [],
            rules: {
                    careers_content: {
                        required: true,
                    },
                    careers_content_wo_tags: {
                        maxlength: 499
                    },
                },
            messages: {
                careers_content: {
                    required: "Please Enter Careers Content.",
                },
                careers_content_wo_tags: {
                    maxlength: "Please enter no more than 500 characters.",
                },
            }       
        });

    $("#form-contact-content-validate").validate({
        ignore: [],
            rules: {
                    contact_content: {
                        required: true,
                    },
                    contact_content_wo_tags: {
                        maxlength: 499,
                    },
                    bulacan_content: {
                        required: true,
                    },
                    caloocan_content: {
                        required: true,
                    },
                },
            messages: {
                contact_content: {
                    required: "Please Enter Contact Content.",
                },
                contact_content_wo_tags: {
                    maxlength: "Please enter no more than 500 characters.",
                },
                bulacan_content: {
                    required: "Please Enter Bulacan Content.",
                },
                caloocan_content: {
                    required: "Please Enter Caloocan Content.",
                },
            }       
        });

    $("#form-property-validate").validate({
        ignore: [],
            rules: {
                    description: {
                        required: true,
                    },
                    description_wo_tags: {
                        maxlength: 199,
                    },
                },
            messages: {
                description: {
                    required: "Please Enter Description.",
                },
                description_wo_tags: {
                    maxlength: "Please enter no more than 200 characters.",
                },
            }       
        });

    //Gallery - Added 03/09/2015
    // $("#links").on("click",function(){
    //     event = event || window.event;
    //     var target = event.target || event.srcElement;
    //     var link = target.src ? target.parentNode : target;
    //     var options = {index: link, event: event,onclosed: function(){
    //             setTimeout(function(){
    //                 $("body").css("overflow","");
    //             },200);                        
    //         }};
    //     var links = this.getElementsByTagName('a');
    //     blueimp.Gallery(links, options);
    // });
    
});

function table2csv(oTable, exportmode, tableElm) {
    var base_url = $("meta[property='cpanel:url']").attr('content');
    var csv = '';
    var headers = [];
    var footers = [];
    var rows = [];

    // Get header names
    $(tableElm+' thead').find('th').each(function() {
        var $th = $(this);
        var text = $th.text();
        var header = '"' + text + '"';
        // headers.push(header); // original code
        if(text != "") headers.push(header); // actually datatables seems to copy my original headers so there ist an amount of TH cells which are empty
    });
    csv += headers.join(',') + "\n";

    // get table data
    if (exportmode == "full") { // total data
        var total = oTable.fnSettings().fnRecordsTotal()
        for(i = 0; i < total; i++) {
            var row = oTable.fnGetData(i);
            row = strip_tags(row);
            rows.push(row);
        }
    } else { // visible rows only
        $(tableElm+' tbody tr:visible').each(function(index) {
            var row = oTable.fnGetData(this);
            row = strip_tags(row);
            rows.push(row);
        })
    }
    csv += rows.join("\n") + "\n";

    // Get footer names
    $(tableElm+' tfoot').find('td').each(function() {
        var $th = $(this);
        var text = $th.text();
        var footer = '"' + text + '"';
        if(text != "") footers.push(footer); // actually datatables seems to copy my original headers so there ist an amount of TD cells which are empty
    });
    csv += footers.join(',');

    // if a csv div is already open, delete it
    if($('.csv-data').length) $('.csv-data').remove();
    // open a div with a download link
    $('#download-csv').append('<div class="csv-data"><form enctype="multipart/form-data" method="post" action="'+base_url+'home/export"><textarea name="csv" style="display:none;">'+csv+'</textarea><input type="submit" class="list-group-item" value="Download CSV File" /></form></div>');
}
 
function strip_tags(html) {
    var tmp = document.createElement("div");
    tmp.innerHTML = html;
    return tmp.textContent||tmp.innerText;
}