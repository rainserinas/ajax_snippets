<!DOCTYPE html>
<html lang="en">
<head>
    <title>Journeytech Inc.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/home/home.css') ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/home/home.js'); ?>"></script>

</head>
<body onload="onload()">

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
                <li><a href="#">Home</a></li>
                <li><a href="#about-div">About Us</a></li>
                <li><a href="#pas-div">Products and Services</a></li>
                <li><a href="#careers-div">Careers</a></li>
                <li><a href="#footer">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="row" style="margin-top: 51px;">
    <div class="col-sm-8" id="heading_img_url">
        <!--Img will be on fetch data via ajax-->
    </div>
    <div class="col-sm-4">
        <div style="border: 1px solid;" id="news_img_url">
            <!--Img will be on fetch data via ajax-->

            <p id="news_one_title">
                <!-- title will be on fetch data via ajax-->
            </p>
            <p id="news_one_text">
                <!-- Text will be on fetch data via ajax-->
            </p>
        </div>
        <div style="border: 1px solid;" id="news_two_img_url">
            <!--Img will be on fetch data via ajax-->

            <p id="news_two_title">
                <!-- title will be on fetch data via ajax-->
            </p>
            <p id="news_two_text">
                <!-- Text will be on fetch data via ajax-->
            </p>
        </div>
        <div style="border: 1px solid;" id="news_three_img_url">
            <!--Img will be on fetch data via ajax-->
            <p id="news_three_title">
                <!-- title will be on fetch data via ajax-->
            </p>
            <p id="news_three_text">
                <!-- Text will be on fetch data via ajax-->
            </p>
        </div>
    </div>
</div>

<div class="row" id="about-div">
    <div class="col-sm-7">

        <div class="container-fluid" style="margin-top: 15px; margin-left: 20px;">
            <p id="about_title">
                <!-- title will be on fetch data via ajax-->
            </p>

            <p id="about_text">
                <!-- Text will be on fetch data via ajax-->
            </p>
        </div>

    </div>
    <div class="col-sm-5" id="side_img_url">
        <!--Img will be on fetch data via ajax-->
    </div>
</div>

<div id="pas-div">
    <!--Img will be on fetch data via ajax-->
</div>

<div id="careers-div">
    <p id="first-par">Looking for a career? We got you.</p>
    <p id="second-par">Right now, Journeytech is looking for:</p>

    <div id="careers-list">
        <!--Img will be on fetch data via ajax-->
    </div>

</div>

<div id="clients-div">
    <!--Img will be on fetch data via ajax-->
</div>



<!-- Footer -->
<div class="footer" id="footer">
    <p>852-8410 www.facebook.com/JourneytechInc</p>
    <p>@JourneytechInc sales@journeytech.com.ph</p>
    <p>
        3rd Floor, Skyfreight Building
        Pascor Drive, Paranaque City
    </p>
    <p>
        &copy; Journeytech Inc. All Rights Reserved.
    </p>
</div>


</body>
</html>
