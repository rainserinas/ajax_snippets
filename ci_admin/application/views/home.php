<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Case</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/home/home.css') ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="<?php echo base_url('uploads/jtilogo/jti logo small.png') ?>" alt="company logo" height="48"/>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav pull-right">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Products and Services</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="row" style="margin-top: 51px;">
    <div class="col-sm-8">
        <img src="<?php echo base_url('uploads/home/Chrysanthemum.jpg'); ?>" height="420" width="105%"/>
    </div>
    <div class="col-sm-4">
        <div style="border: 1px solid;">
            <img src="<?php echo base_url('uploads/home/Desert.jpg'); ?>" height="138" width="100%"/>

            <p id="title1">
                Hello World!
            </p>
            <p id="text1">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries,
            </p>
        </div>
        <div style="border: 1px solid;">
            <img src="<?php echo base_url('uploads/home/Hydrangeas.jpg'); ?>" height="138" width="100%"/>

            <p id="title2">
                Hello World!
            </p>
            <p id="text2">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries,
            </p>
        </div>
        <div style="border: 1px solid;">
            <img src="<?php echo base_url('uploads/home/Jellyfish.jpg'); ?>" height="138" width="100%"/>

            <p id="title3">
                Hello World!
            </p>
            <p id="text3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries,
            </p>
        </div>
    </div>
</div>


</body>
</html>
