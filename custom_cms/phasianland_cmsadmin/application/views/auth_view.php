<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
    <title><?php echo $title; ?></title>           
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="shortcut icon" href="<?php echo base_url().FOLDER_IMG; ?>favicon.ico" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url().FOLDER_CSS; ?>designbluemanila.css"/>
</head>

<?php 
    echo (isset($_SESSION['loginError']) ? "<body onload=\"noty({text: '".$_SESSION['loginError']."', layout: 'topCenter', type: 'error'});\">" : '<body>'); 
    unset($_SESSION['loginError']);
?>
    <div class="login-container">
        
            <div class="login-box">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    <?php 
                        echo form_open('', array('class' => 'form-horizontal', 'id' => 'login-validate'));
                    ?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="inner-addon left-addon">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <?php echo form_input('email', set_value('email'), 'class="form-control" placeholder="Email Address"'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="inner-addon left-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                    <?php echo form_password('password', '', 'class="form-control" placeholder="Password"'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-12">
                                <a href="#">I cannot access my account.</a>
                            </div>         
                        </div> -->
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg btn-block">Log In</button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; <?=date('Y')?> Designblue Manila.
                    </div>
                </div>
            </div>
            
        </div>
               
    <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/bootstrap/bootstrap.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/jquery-validation/jquery.validate.js'></script>     
    <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>application.js"></script>

    <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/noty/jquery.noty.js'></script>
    <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/noty/layouts/topCenter.js'></script>
    <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/noty/themes/default.js'></script>

    <!--
    /*! Designblue Manila - creative instinct
    //@ Web Developer: Ralph Dayne B. Banzon
    */
    -->
        
    </body>
</html>