<?php
include_once('./includes/api-functions.php');
include_once('./includes/wp-bootstrap.php');

$ig_access_token = get_option("instagram_api_key");
$ig_search_term = get_option("instagram_search_term");

$send_object = array(
    "data" => array(

    )
);


$ig_contents = json_decode(file_get_contents( "https://api.instagram.com/v1/tags/" . $ig_search_term . "/media/recent?access_token=" . $ig_access_token . "&count=" . $_GET['count'] ));

wp_send_json( $ig_contents );