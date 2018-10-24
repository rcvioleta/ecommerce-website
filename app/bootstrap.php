<?php 
// Load configuration
require_once 'config/config.php';

// Load URL helper 
require_once 'helpers/url_helper.php';

// Load session helper 
require_once 'helpers/session_helper.php';

spl_autoload_register(function($class) {
	require_once 'lib/'.$class.'.php'; 
});
?>