<?php $this->load->view('default/header'); ?>
    
<div class="content-frame">  

    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?=$pageInfo->header?></h2>
        </div>                                      
        <div class="pull-right">
            <?php if($userInfo->AccountTypeID != 1 && $this->uri->segment(2) == null) : ?>
                <a href="<?php echo base_url(); ?>support/report"  class="btn btn-primary">Report New Issue</a>        
            <?php endif; ?>
            
            <?php if($userInfo->AccountTypeID == 1 && $this->uri->segment(2) == 'issue') : ?>
                <button class="btn btn-primary toggle" data-toggle="action"> Action</button>
            <?php endif; ?>
        </div>
    </div>

<?php if($pageInfo->code == 'list') : ?>    
    
    <div class="content-frame-right">
        <!-- CLOSED ISSUES -->
        <h4 class="text-warning">Closed Issues</h4>
        <ul class="list-unstyled link-arrow-list">
            <?php if(!empty($closed_issues)) : ?>
                <?php foreach($closed_issues as $closed) : ?>
                    <li><a href="<?php echo base_url().'support/issue/id/'.$closed->SupportID; ?>"><?=$closed->Title?></a></li>
                <?php endforeach; ?>
            <?php else : ?>
                No closed issues found.
            <?php endif; ?>
        </ul>
        <!-- END CLOSED ISSUES -->

        <!-- IN PROGRESS ISSUES -->
        <h4 class="text-warning push-up-20">Issues in Progress</h4>
        <ul class="list-unstyled link-arrow-list">
            <?php if(!empty($in_progress_issues)) : ?>
                <?php foreach($in_progress_issues as $in_progress) : ?>
                    <li><a href="<?php echo base_url().'support/issue/id/'.$in_progress->SupportID; ?>"><?=$in_progress->Title?></a></li>
                <?php endforeach; ?>
            <?php else : ?>
                No Issues in Progress Found.
            <?php endif; ?>
        </ul>
        <!-- END IN PROGRESS ISSUES -->
    </div>

    <div class="content-frame-body content-frame-body-left">
        
        <div class="col-md-12">
            <h3 class="push-up-5">Found a bug (or an 'issue' as we call it)?  Please review the guidelines below:</h3>
        </div>
        <div class="col-md-6">
            <h4 class="text-warning">Step 1: Search</h4>
            <ul class="list-unstyled">
                <li>There is a good chance the issue has been already reported with users reviewing the system.</li>
                <li>Because of this, it`s very important to check to determine if the issue is already reported before you submit it.</li>
                <li>Search for the issue and review the results. If it has been reported, please do not submit a duplicate.</li>   
                <li>If you have any additional information to report on the issue, please submit a comment.</li>                               
            </ul>
        </div>
        <div class="col-md-6">
            <h4 class="text-warning">Step 2: Report an Issue</h4>
            <ul class="list-unstyled">
                <li>After you've verified that the issue has not been reported, click the Report New Issue button Be as detailed and thorough as possible.</li>
                <li>Report what you expected to happen but didn't occur. </li>
                <li>Include error messages, URL's and as much information as possible.</li>                                  
            </ul>
        </div>
        
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th width="10%">Issue#</th>
                            <th width="7%">Type</th>
                            <th>Title</th>
                            <th width="10%">Status</th>
                            <th width="18%">Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($results)) : ?>
                            <?php foreach($results as $result) : ?>
                                <tr>
                                    <td><a href="<?php echo base_url(); ?>support/issue/id/<?=$result->SupportID?>"><?=$result->SupportID?></a></td>
                                    <td><?=$result->Type?></td>
                                    <td><a href="<?php echo base_url(); ?>support/issue/id/<?=$result->SupportID?>"><?=$result->Title?></a></td>
                                    <td><?=$result->Status?></td>
                                    <td><?=$this->mgeneral->dateTimeFormat($result->LastUpdate)?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 push-down-20 push-up-20"></div>

    </div>

<?php elseif($pageInfo->code == 'report') : ?>
   
   <div class="content-frame-body content-frame-body-left">

        <div class="block">

             <div class="col-md-12">
                <ul class="list-unstyled">
                    <h4 class="text-warning push-up-5">Found a Issue?</h4>
                    <li>Please complete the form below.</li>
                    <li>Be very specific - give us a detailed analysis of the steps taken, the expected action and the outcome result.</li>
                    <li>Don't forget to mention the browser and Operating System you are running. Thanks!</li>                                  
                </ul>
            </div>
        
            <?php 
                echo form_open(base_url().'support/save', array('class' => 'form-horizontal', 'id' => 'validate'));
            ?>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Type of Issue</label>
                        <div class="col-md-6 col-xs-12">   
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="type" value="Bug" checked="checked"/> Bug</label>
                            </div>
                            <div class="col-md-12">                                    
                                <label class="check"><input type="radio" class="iradio" name="type" value="Improvements"/> Improvements</label>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Title</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="validate[required,minSize[10]] form-control" name="title"/>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Priority</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="col-md-12">
                                <label class="check"><input type="radio" class="icheckbox" name="priority" value="Minor" checked="checked"/> Minor</label>
                            </div>
                            <div class="col-md-12">
                                <label class="check"><input type="radio" class="iradio" name="priority" value="Major"/> Major</label>
                            </div>
                            <div class="col-md-12">
                                <label class="check"><input type="radio" class="iradio" name="priority" value="Critical"/> Critical</label>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Description</label>
                        <div class="col-md-7 col-xs-12">                                            
                            <textarea class="summernote" name="description"></textarea>                                   
                            <span class="help-block">Description must be detailed and thorough as possible</span>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit">Report Issue</button>
                    </div> 

                </div>
            <?php echo form_close(); ?>

        </div>

     </div>

<?php elseif($pageInfo->code == 'view') : ?>                                    
    <!-- START COMMENT ISSUE -->
    <div class="content-frame-right">
        <h4 class="text-warning">Leave your comments</h4>

         <div class="timeline-item timeline-item-right">                                
            <div class="timeline-item-content">                                     
                <div class="timeline-body comments">
                    
                    <div id="comment-message-wrapper">
                        <?php if(!empty($results['comments'])) : ?>
                            <?php foreach($results['comments'] as $comment) : ?>
                                <div class="comment-item">
                                    <img src="<?php echo base_url().FOLDER_USERS.$this->mgeneral->getUserAvatar($comment->AccountID) ?>" alt="<?=$comment->FirstName.' '.$comment->LastName?>">
                                    <p class="comment-head">
                                        <a href="#"><?=$comment->FirstName.' '.$comment->LastName?></a>
                                    </p>
                                    <div class="comment-wrapper">
                                        <p><?=$comment->Message?></p>
                                    </div>
                                    <small class="text-muted"><?=$this->mgeneral->timeElapsed($comment->DateCreated)?></small>
                                </div>   
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="comment-item">
                                No comments to show
                            </div>
                        <?php endif; ?> 
                    </div>  

                    <div class="comment-write">
                        <form id="comment-form" method="post">
                            <div class="input-group">
                                <input type="hidden" name="support_id" value="<?=$results['info']->SupportID?>"/>
                                <input type="text" name="message" id="comment-message-field" class="form-control" placeholder="Write a comment..." autocomplete="off"/>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default" id="comment-message-submit" disabled>Submit</button>
                                </div>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>                                    
        </div>        

    </div>
    <!-- END COMMENT ISSUE -->

    <!-- START VIEW ISSUE -->
    <div class="content-frame-body content-frame-body-left">

        <div class="panel-body col-md-12" id="action" style="display: none;">
            <div class="col-md-2">
                <div class="list-group border-bottom">
                    <a href="<?php echo base_url() ?>support/set_status/status/close/id/<?=$results['info']->SupportID?>" class="list-group-item"><img src="<?php echo base_url().FOLDER_ICON; ?>close.png" width="24"/> Closed Issue</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="list-group border-bottom">
                    <a href="<?php echo base_url() ?>support/set_status/status/open/id/<?=$results['info']->SupportID?>" class="list-group-item"><img src="<?php echo base_url().FOLDER_ICON; ?>open.png" width="24"/> Open Issue</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="list-group border-bottom">
                    <a href="<?php echo base_url() ?>support/set_status/status/progress/id/<?=$results['info']->SupportID?>" class="list-group-item"><img src="<?php echo base_url().FOLDER_ICON; ?>in-progress.png" width="24"/> In Progress</a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="list-group border-bottom">
                    <a href="#" id="remove" data-id="<?=$results['info']->SupportID?>" class="list-group-item"><img src="<?php echo base_url().FOLDER_ICON; ?>remove.png" width="24"/> Remove Issue</a>

                    <script type="text/javascript">
                        $('#remove').click(function(){
                            var id = $(this).data('id');
                            $('.load-content').load('<?php echo base_url(); ?>support/remove/id/'+id,function(result){
                                $('#db-modal').modal({show:true});
                            });
                        });
                    </script>
                </div>
            </div>   
        </div>   
        
        <div class="panel-body form-group-separated col-md-12">
            <div class="form-group">
                <label class="col-md-1 control-label">Title</label>
                <div class="col-md-11">                                      
                    <p><?=$results['info']->Title?></p>
                </div>
            </div>
        </div>

        <div class="panel-body form-group-separated col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label">Issue#</label>
                <div class="col-md-5">                                      
                    <p><?=$results['info']->SupportID?></p>
                </div>
            </div>
        </div>
    
         <div class="panel-body form-group-separated col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label">Posted</label>
                <div class="col-md-5">                                      
                    <p><?=$this->mgeneral->dateTimeFormat($results['info']->DateCreated)?></p>
                </div>
            </div>
        </div>    

        <div class="panel-body form-group-separated col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label">Status</label>
                <div class="col-md-5">     
                    <p><?=$results['info']->Status?></p>
                </div>
            </div>
        </div>

        <div class="panel-body form-group-separated col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label">Last Updated</label>
                <div class="col-md-5">     
                    <p><?=$this->mgeneral->dateTimeFormat($results['info']->LastUpdate)?></p>
                </div>
            </div>
        </div>

        <div class="panel-body form-group-separated col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label">Type</label>
                <div class="col-md-5">                                      
                    <p><?=$results['info']->Type?></p>
                </div>
            </div>
        </div>

        <div class="panel-body form-group-separated col-md-6">
            <div class="form-group">
                <label class="col-md-2 control-label">Priority</label>
                <div class="col-md-5">                                      
                    <p><?=$results['info']->Priority?></p>
                </div>
            </div>
        </div>

        <div class="panel-body form-group-separated col-md-12">
            <div class="form-group">
                <label class="col-md-1 control-label">Reported By</label>
                <div class="col-md-5">                                      
                    <p><?=$results['info']->FirstName.' '.$results['info']->LastName?></p>
                </div>
            </div>
        </div>

        <div class="panel-body form-group-separated col-md-12">
            <div class="form-group">
                <label class="col-md-1 control-label">Description</label>
                <div class="col-md-5">                                      
                    <p><?=$results['info']->Description?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- END VIEW ISSUE -->

<?php endif; ?>   

</div>        

<?php $this->load->view('default/footer'); ?>