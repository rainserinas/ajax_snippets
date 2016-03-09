<?php

  error_reporting(1);

  $lat  = "14.357230";
  $long = "121.110403";

  $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=true";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $geoloc = json_decode(curl_exec($ch), true);


 $address = $geoloc['results'][0]['formatted_address'];

 echo $address;
