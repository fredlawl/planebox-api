<?php

$router->map('GET', '/', function() {
	echo 'hello world';
});

$router->map('GET', '/data', function() {
	header('Content-Type: application/json');
	header('HTTP/1.1 200 Ok!');

	$array = (object) array(
		'status' 	=> 200,
		'message' 	=> 'success'
	);

	echo json_encode($array);
});
