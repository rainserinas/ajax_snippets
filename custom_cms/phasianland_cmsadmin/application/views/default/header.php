<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$pageInfo->title?></title>           
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <meta property='cpanel:url' content="<?=base_url()?>" />
    <meta property="cpanel:navigation" content="<?=(($this->input->cookie('xnavigation',true)!=NULL) ? $this->input->cookie('xnavigation',true) : '0')?>" />
    <meta property="cpanel:order" content="<?=(!empty($tableOrder) ? $tableOrder : 'desc')?>" />
    <meta property="cpanel:sort" content="<?=(!empty($tableSortable) ? $tableSortable : 'null')?>" />
    
    <link rel="shortcut icon" href="<?php echo base_url().FOLDER_IMG; ?>favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().FOLDER_CSS; ?>designbluemanila.css"/>   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().FOLDER_CSS; ?>summernote/monokai.min.css"/> 

    <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>jquery-1.10.1.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/summernote/summernote.min.js"></script>
</head>
<?php 
    echo (isset($_SESSION['actionMessage']) ? "<body onload=\"noty({text: '".$_SESSION['actionMessage']."', layout: 'topCenter', type: '".(isset($_SESSION['actionType']) ? $_SESSION['actionType'] : 'success')."'});\">" : '<body>'); 
    unset($_SESSION['actionMessage'], $_SESSION['actionType']);
?>
    <div class="page-container page-navigation-top-fixed <?php echo (($this->input->cookie('xnavigation') == 1)?'page-navigation-toggled page-container-wide':''); ?>">

        <div class="page-sidebar page-sidebar-fixed scroll">
            <ul class="x-navigation <?php echo (($this->input->cookie('xnavigation'))?'x-navigation-minimized':''); ?>">
                <li class="xn-logo">
                    <a href="<?php echo base_url() ?>">designblue</a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="<?php echo base_url().FOLDER_USERS.$userInfo->AccountPicture ?>" alt=""/>
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="<?php echo base_url().FOLDER_USERS.$userInfo->AccountPicture ?>" alt=""/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name"><?=$userInfo->FullName?></div>
                            <div class="profile-data-title"><?=$userInfo->AccountType?></div>
                        </div>
                    </div>                                                                        
                </li>
                
                <!-- <li <?php echo (($this->uri->segment(1)=='home')?'class="is_active"':''); ?>>
                    <a href="<?php echo base_url() ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                </li> -->
                <?php if($userInfo->AccountTypeID != 3) : ?>
                <li <?php echo (($this->uri->segment(1)=='accounts')?'class="is_active"':''); ?>>
                    <a href="<?php echo base_url() ?>accounts"><span class="fa fa-user"></span> <span class="xn-text">Admin Accounts</span></a>
                </li>
                <?php endif; ?>
                <li <?php echo (($this->uri->segment(1)=='about')?'class="is_active active"':''); ?>>
                    <a href="<?php echo base_url() ?>about"><span class="fa fa-info"></span> <span class="xn-text">About</span></a>

                    <ul>
                        <li <?php echo (($this->uri->segment(2) == 'modifyBanner' && $this->uri->segment(1) == 'about')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>about/modifyBanner"><span class="fa fa-image"></span> <span class="xn-text">Modify Banner</span></a>
                        </li>
                        <li <?php echo (($this->uri->segment(2)=='contents' && $this->uri->segment(1) == 'about')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>about/contents"><span class="fa fa-paragraph"></span> <span class="xn-text">Contents</span></a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (($this->uri->segment(1)=='projects' || $this->uri->segment(1) == 'community')?'class="is_active active"':''); ?>>
                    <a href="<?php echo base_url('projects') ?>"><span class="fa fa-building"></span> <span class="xn-text">Projects</span></a>

                    <ul>
                        <li <?php echo (($this->uri->segment(1) == 'community')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>community"><span class="fa fa-users"></span> <span class="xn-text">Community</span></a>
                        </li>
                        <li <?php echo (($this->uri->segment(1)=='projects')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>projects"><span class="fa fa-paragraph"></span> <span class="xn-text">Contents</span></a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (($this->uri->segment(1)=='careers')?'class="is_active active"':''); ?>>
                    <a href="<?php echo base_url() ?>careers"><span class="fa fa-briefcase"></span> <span class="xn-text">Career</span></a>

                    <ul>
                        <li <?php echo (($this->uri->segment(2) == 'vacancies' || $this->uri->segment(2) == 'modify' || $this->uri->segment(2) == 'create'  && $this->uri->segment(1) == 'careers')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>careers/vacancies"><span class="fa fa-users"></span> <span class="xn-text">Vacancies</span></a>
                        </li>
                        <li <?php echo (($this->uri->segment(2) == 'modifyBanner' && $this->uri->segment(1) == 'careers')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>careers/modifyBanner"><span class="fa fa-image"></span> <span class="xn-text">Modify Banner</span></a>
                        </li>
                        <li <?php echo (($this->uri->segment(2)=='contents' && $this->uri->segment(1) == 'careers')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>careers/contents"><span class="fa fa-paragraph"></span> <span class="xn-text">Contents</span></a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (($this->uri->segment(1)=='contact')?'class="is_active active"':''); ?>>
                    <a href="<?php echo base_url() ?>contact"><span class="fa fa-phone"></span> <span class="xn-text">Contact</span></a>

                    <ul>
                        <li <?php echo (($this->uri->segment(2) == 'modifyBanner' && $this->uri->segment(1) == 'contact')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>contact/modifyBanner"><span class="fa fa-image"></span> <span class="xn-text">Modify Banner</span></a>
                        </li>
                        <li <?php echo (($this->uri->segment(2)=='contents' && $this->uri->segment(1) == 'contact')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>contact/contents"><span class="fa fa-paragraph"></span> <span class="xn-text">Contents</span></a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (($this->uri->segment(1)=='news_events')?'class="is_active active"':''); ?>>
                    <a href="<?php echo base_url() ?>news_events"><span class="fa fa-calendar"></span> <span class="xn-text">News & Events</span></a>

                    <ul>
                        <li <?php echo (($this->uri->segment(2) == 'lists' || $this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'modify' && $this->uri->segment(1) == 'news_events')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>news_events/lists"><span class="fa fa-paragraph"></span> <span class="xn-text">List of News & Events</span></a>
                        </li>
                        <li <?php echo (($this->uri->segment(2) == 'modifyBanner' && $this->uri->segment(1) == 'news_events')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>news_events/modifyBanner"><span class="fa fa-image"></span> <span class="xn-text">Modify Banner</span></a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (($this->uri->segment(1)=='property_finder')?'class="is_active active"':''); ?>>
                    <a href="<?php echo base_url() ?>property_finder"><span class="fa fa-home"></span> <span class="xn-text">Property Finder</span></a>

                    <ul>
                        <li <?php echo (($this->uri->segment(2) == 'modifyBanner' && $this->uri->segment(1) == 'property_finder')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>property_finder/modifyBanner"><span class="fa fa-image"></span> <span class="xn-text">Modify Banner</span></a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (($this->uri->segment(1)=='newsletters')?'class="is_active active"':''); ?>>
                    <a href="<?php echo base_url() ?>newsletters"><span class="fa fa-envelope"></span> <span class="xn-text">Newsletters</span></a>

                    <ul>
                        <li <?php echo (($this->uri->segment(2) == 'lists' || $this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'modify' && $this->uri->segment(1) == 'newsletters')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>newsletters/lists"><span class="fa fa-paragraph"></span> <span class="xn-text">List of Newsletters</span></a>
                        </li>
                        <li <?php echo (($this->uri->segment(2) == 'modifyBanner' && $this->uri->segment(1) == 'newsletters')?'class="is_active"':''); ?>>
                            <a href="<?php echo base_url() ?>newsletters/modifyBanner"><span class="fa fa-image"></span> <span class="xn-text">Modify Banner</span></a>
                        </li>
                    </ul>
                </li>
                <!-- <li <?php echo (($this->uri->segment(1)=='support')?'class="is_active"':''); ?>>
                    <a href="<?php echo base_url() ?>support"><span class="fa fa-support"></span> <span class="xn-text">Report a Problem</span></a>
                </li> -->
            </ul>
        </div>
        
        <div class="page-content">

            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize" id="x-navigation"><span class="fa fa-minus-square"></span></a>
                </li>
                <!-- <li class="xn-search">
                    <form role="form">
                        <input type="text" name="search" placeholder="Search..."/>
                    </form>
                </li>   --> 
                <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span></a>
                </li>
                <!-- <?php //if($userInfo->account_type_id == 1) : ?>
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="glyphicon glyphicon-globe"></span></a>
                        <?php echo ($support->total > 0) ? '<div class="informer informer-danger">'.$support->total.'</div>' : '' ?>
                        <div class="panel-notification panel panel-primary animated zoomIn xn-drop-left">
                            <div class="panel-heading">
                                <h4 class="panel-title">Support</h4>
                                <div class="pull-right">
                                    <span class="label text-danger"><?=$support->total?> unresolved issue</span>
                                </div>
                            </div>
                                <?php if(!empty($support->details)) : ?>
                                <div class="panel-body list-group list-group-contacts scroll" style="max-height: 185px;">
                                    <?php foreach($support->details as $support) : ?>
                                        <a href="<?php echo base_url().'support/issue/id/'.$support->SupportID; ?>" class="list-group-item">
                                            <div class="list-group-status status-<?=$support->Priority?>"></div>
                                            <img src="<?php echo base_url().FOLDER_USERS.$this->mgeneral->getUserAvatar($support->AccountID) ?>" class="pull-left" alt=""/>
                                            <span class="contacts-title"><?=$support->FullName?></span>
                                            <p><?=$support->Title?></p>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <?php else: ?>
                                    <div class="panel-body list-group list-group-contacts scroll" style="max-height: 101px;">
                                        <a href="<?php echo base_url(); ?>support" class="list-group-item">
                                            <span class="contacts-title">No Issues Found</span>
                                            <p>If you encounter a bug or wants an improvement on the current system, make sure to send a detailed bug/improvement description so we can continue to track and work these issues.</p>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                 
                            <div class="panel-footer text-center">
                                <a href="<?php echo base_url(); ?>support">See All</a>
                            </div>                            
                        </div>                        
                    </li>
                <?php //endif; ?> -->
            </ul>

            <ul class="breadcrumb">
                <li class="active">You are here</li>         
                <?php echo $this->breadcrumbs->show(); ?>
            </ul>