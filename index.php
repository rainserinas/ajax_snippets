<?php

get_header();

if (have_posts()) {

    //Looping through post with specific category
    $pr = query_posts('category_name=prom');

    foreach ($pr as $data) {
        echo $data->post_content;
    }

} else {
    echo "No content found";
}

get_footer();
?>

