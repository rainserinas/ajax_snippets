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


<?php 
//Basic the loop on wordpress


if(have_posts()) :
	
	while(have_posts()) : the_post();
		//output content however we please here
	endwhile;
	
	else;
		//fallback no content message here

endif;


?>

