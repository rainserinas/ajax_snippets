var myCenter=new google.maps.LatLng(14.507460,121.000710);

function initialize()
{
    var mapProp = {
        center:myCenter,
        zoom:16,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    var marker=new google.maps.Marker({
        position:myCenter,
    });

    marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);

function onload() {

    var url = window.location.href;     // Returns full URL

    $.ajax({
        url: url+"home_data",
        type: "GET",
        dataType: "json",
        success: function (data) {


            $.each(data, function (index, item) {
                $("#heading_img_url").append("<img src='" + url + "uploads/" + item.heading_img_url + "' height='420' width='105%'/>");
                $("#news_img_url").append("<img src='" + url + "uploads/" + item.news_img_url + "' height='138' width='100%'/>");
                $("#news_one_title").append(item.news_one_title);
                $("#news_one_text").append(item.news_one_text);
                $("#news_two_img_url").append("<img src='" + url + "uploads/" + item.news_two_img_url + "' height='138' width='100%'/>");
                $("#news_two_title").append(item.news_two_title);
                $("#news_two_text").append(item.news_two_text);
                $("#news_three_img_url").append("<img src='" + url + "uploads/" + item.news_three_img_url + "' height='138' width='100%'/>");
                $("#news_three_title").append(item.news_three_title);
                $("#news_three_text").append(item.news_three_text);
            });

        },
        error: function (error) {
            console.log("Error:");
            console.log(error);
        }
    });

    $.ajax({
        url: url+"about_data",
        type: "GET",
        dataType: "json",
        success: function (data) {


            $.each(data, function (index, item) {

                $("#about_title").append(item.about_title);
                $("#about_text").append(item.about_text);
                $("#side_img_url").append("<img src='" + url + "uploads/" + item.side_img_url + "' height='600' width='100%'/>");
            });

        },
        error: function (error) {
            console.log("Error:");
            console.log(error);
        }
    });

    $.ajax({
        url: url+"pas_data",
        type: "GET",
        dataType: "json",
        success: function (data) {


            $.each(data, function (index, item) {
                $("#pas-div").append("<img src='" + url + "uploads/" + item.product_img_url + "' class='img-responsive' width='250' height='250' style='margin: 50px'>");
            });

        },
        error: function (error) {
            console.log("Error:");
            console.log(error);
        }
    });

    $.ajax({
        url: url+"careers_data",
        type: "GET",
        dataType: "json",
        success: function (data) {

            $.each(data, function (index, item) {
                $("#careers-list").append("<img src='" + url + "uploads/" + item.career_img_url + "' class='img-responsive' width='250' height='250' style='margin: 50px'>");
            });

        },
        error: function (error) {
            console.log("Error:");
            console.log(error);
        }
    });

    $.ajax({
        url: url+"clients_data",
        type: "GET",
        dataType: "json",
        success: function (data) {

            $.each(data, function (index, item) {
                $("#clients-div").append("<img src='" + url + "uploads/" + item.client_img_url + "' class='img-responsive' width='250' height='250' style='margin: 50px'>");
            });

        },
        error: function (error) {
            console.log("Error:");
            console.log(error);
        }
    });
}

//Scroll effect

$(function () {
    $('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});