<?php
include_once 'wp-load.php';
$url = 'http://127.0.0.1/wp642/wordpress/wp-json/wp/v2/posts/311?force=true';
$response = wp_remote_post( $url, array(
	"method"=>"DELETE",
	"headers"=>array("Authorization"=>"Basic ".base64_encode("admin:admin123"))	
	
));
$body_response = json_decode($response['body']);
print_r($body_response);
?>