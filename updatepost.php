<?php
include_once 'wp-load.php';
$url = 'http://127.0.0.1/wp642/wordpress/wp-json/wp/v2/posts/311';
$response = wp_remote_post( $url, array(
	"method"=>"POST",
	"headers"=>array("Authorization"=>"Basic ".base64_encode("admin:admin123")),	
	"body"=>array('title'=>'created post by file update',
	"content"=>'created post by file content updated',
	"status"=>'publish')
));
$body_response = json_decode($response['body']);
print_r($body_response);
?>