<?php $this->load->view('default/header'); ?>

<div class="content-frame">  
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?=$pageInfo->header?></h2>
        </div>                                      
        <div class="pull-right">
            <?php if($this->uri->segment(2) == null) : ?>
                <a href="<?php echo base_url(); ?>accounts/create"  class="btn btn-primary">Create Account</a>
            <?php endif; ?>
        </div>
    </div>

<?php if($pageInfo->code == 'list') : ?>
	<div class="content-frame-body content-frame-body-left">
        <div class="col-md-12">
            <h4 class="text-warning push-up-5">There are three types of accounts. Each type gives users a different level of control over the system:</h4>
            <ol>
            	<li>Developer accounts provide the most control over the system, and should only be used when necessary.</li>
                <li>Administrator accounts are intended primarily for creating, modifying and removing contents.</li>
                <li>Moderator accounts can only use the system by modifying contents created by the administrator.</li>
            </ol>
        </div>
		
		<div class="col-md-12">
            <div class="table-responsive">
		        <table class="table datatable">
			        <thead>
			            <tr>
			                <th width="8%">User#</th>
			                <th>Last Activity</th>
			                <th>Name</th>
			                <th>Account Type</th>
			                <th>Email</th>
			                <th width="13%">Date Created</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php foreach($results as $result) : ?>
			        		<tr>
								<td><?=$result->AccountID?></td>
								<td><?=$this->mgeneral->timeAgo($result->DateModified)?></td>
								<td>
									<?php if(($result->AccountTypeID == 1 && $userInfo->AccountTypeID != 1) || ($this->mgeneral->getCurrUserId() == $result->AccountID)): ?>
				                        <?=$result->FirstName.' '.$result->LastName?>
				                    <?php else: ?>
				                    	<li class="dropdown no-decoration">
				                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$result->FirstName.' '.$result->LastName?></a>                                            
				                            <ul class="dropdown-menu">
				                                <li><a href="<?php echo base_url(); ?>accounts/modify/id/<?=$result->AccountID?>">Modify</a></li>
				                                <li><a href="#" id="remove-<?=$result->AccountID?>" data-id="<?=$result->AccountID?>">Remove</a></li>
				                            </ul>                                   
				                        </li>
			                    	<?php endif; ?>
		                		</td>
								<td><?=$result->AccountType?></td>
								<td><?=$result->EmailAddress?></td>
								<td><?=$this->mgeneral->dateFormat($result->DateCreated)?></td>     
							</tr>

							<script type="text/javascript">
	                            $('#remove-'+<?=$result->AccountID?>).click(function(){
	                                var id = $(this).data('id');
	                                $('.load-content').load('<?php echo base_url(); ?>accounts/remove/id/'+id,function(result){
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
	            <h4 class="text-warning push-up-5">Choose a hard-to-guess password</h4>
	            <ol>
	            	<li>Avoid dictionary words</li>
	                <li>Avoid familiar items (names, phone numbers, etc.)</li>
	                <li>Use a combination of letters, numbers, and special characters</li>
	                <li>Use more characters (5+)</li>
	            </ol>
        	</div>
		
        	<?php 
	            echo form_open(base_url().'accounts/save',array('class'=>'form-horizontal','id'=>'form-validate'));
	        ?>
            	<div class="panel-body">

	                <div class="form-group">
	                    <label class="col-md-2 control-label">Firstname:</label>  
	                    <div class="col-md-3">
	                        <input type="text" class="form-control" name="firstname"/>
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label class="col-md-2 control-label">Lastname:</label>  
	                    <div class="col-md-3">
	                        <input type="text" class="form-control" name="lastname"/>
	                    </div>
	                </div>

	                <div class="form-group">
			            <div class="form-group">
			                <label class="col-md-2 control-label">Account Type:</label>
			                <div class="col-md-6 col-xs-12"> 
			                	<?php if($userInfo->AccountTypeID == 1) : ?>  
				                    <div class="col-md-12">                                    
				                        <label class="check"><input type="radio" class="iradio" name="account_type_id" value="1" checked="checked"/> Developer</label>
				                    </div>
				                <?php endif; ?>
			                    <div class="col-md-12">                                    
			                        <label class="check"><input type="radio" class="iradio" name="account_type_id" value="2" <?=(($userInfo->AccountTypeID != 1) ? 'checked="checked"' : '')?>/> Administrator</label>
			                    </div>
			                    <div class="col-md-12">                                    
			                        <label class="check"><input type="radio" class="icheckbox" name="account_type_id" value="3"/> Moderator</label>
			                    </div>
			                </div>
			            </div>
			        </div>
    
	                <div class="form-group">
	                    <label class="col-md-2 control-label">E-mail:</label>
	                    <div class="col-md-4">
	                        <input type="text" value="" name="email" class="form-control"/>                                        
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label class="col-md-2 control-label">Password:</label>                                        
	                    <div class="col-md-4">
	                        <input type="password" class="form-control" name="password" id="password2"/>                                        
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label class="col-md-2 control-label">Confirm Password:</label>                                       
	                    <div class="col-md-4">
	                        <input type="password" class="form-control" name="re-password"/>
	                    </div>
	                </div>
	                
	                <div class="panel-footer">
	                    <button class="btn btn-primary" type="submit">Create Account</button>
	                </div> 

            	</div>                                               
            <?php echo form_close(); ?>

        </div>

	 </div>

<?php elseif($pageInfo->code == 'modify') : ?>

	 <div class="content-frame-body content-frame-body-left">

	 	<div class="block">
		
        	<?php 
	            echo form_open(base_url().'accounts/save/id/'.$results->AccountID,array('class'=>'form-horizontal','id'=>'form-validate'));
	        ?>
            	<div class="panel-body">

	                <div class="form-group">
	                    <label class="col-md-3 control-label">Firstname:</label>  
	                    <div class="col-md-3">
	                        <?php echo form_input('firstname', $results->Firstname, 'class="required form-control"'); ?>
	                    </div>
	                </div>

	                <div class="form-group">
	                    <label class="col-md-3 control-label">Lastname:</label>  
	                    <div class="col-md-3">
	                        <?php echo form_input('lastname', $results->Lastname, 'class="required form-control"'); ?>
	                    </div>
	                </div>

	                <div class="form-group">
			            <div class="form-group">
			                <label class="col-md-3 col-xs-12 control-label">Account Type:</label>
			                <div class="col-md-6 col-xs-12"> 
			                	<?php if($userInfo->AccountTypeID == 1) : ?>  
				                    <div class="col-md-12">                                    
				                        <label class="check"><input type="radio" class="iradio" name="account_type_id" value="1" <?=(($results->AccountTypeID == 1) ? 'checked="checked"' : '')?>/> Developer</label>
				                    </div>
				                <?php endif; ?>
			                    <div class="col-md-12">                                    
			                        <label class="check"><input type="radio" class="iradio" name="account_type_id" value="2" <?=(($results->AccountTypeID == 2) ? 'checked="checked"' : '')?>/> Administrator</label>
			                    </div>
			                    <div class="col-md-12">                                    
			                        <label class="check"><input type="radio" class="icheckbox" name="account_type_id" value="3" <?=(($results->AccountTypeID == 3) ? 'checked="checked"' : '')?>/> Moderator</label>
			                    </div>
			                </div>
			            </div>
			        </div>
    
	                <div class="form-group">
	                    <label class="col-md-3 control-label">E-mail:</label>
	                    <div class="col-md-4">
	                        <?php echo form_input('email', $results->EmailAddress, 'class="required form-control"'); ?>                                      
	                    </div>
	                </div>
	                
	                <div class="panel-footer">
	                    <button class="btn btn-primary" type="submit">Modify Account</button>
	                </div> 

            	</div>                                               
            <?php echo form_close(); ?>

        </div>

	 </div>

<?php endif; ?>

</div>

<?php $this->load->view('default/footer'); ?>