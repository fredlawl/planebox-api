<?php

require_once('bootstrap.php');

// match current request url
$match = $router->match();

// call closure or throw 404 status
if ($match && is_callable($match['target'])) {
	call_user_func_array($match['target'], $match['params']);
} else {
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
