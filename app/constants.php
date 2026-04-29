<?php

define('BASE_PATH', 'http://localhost/prince_mobile/');
define('DOC_PATH', dirname(__DIR__) . '/');

define('ONLINESTATUS', false);

if (!ONLINESTATUS) {
	define('PREFIX1', BASE_PATH . 'public/');
	define('UPLOADFILES', 'public/uploads/');
	define('ASSETS', BASE_PATH . 'public/assets/');
} else {
	define('PREFIX1', BASE_PATH);
	define('UPLOADFILES', 'uploads/');
	define('ASSETS', BASE_PATH . 'assets/');
}

define('DASHBOARD', BASE_PATH . 'dashboard');

//Design Source File Paths
define('CSS', PREFIX1 . 'css/');
define('JS', PREFIX1 . 'js/');
define('IMAGES', PREFIX1 . 'images/');
define('VENDOR', BASE_PATH . 'vendor/');


//Define Constant for Room Inquiry
define('BANNER_TYPE', array('1' => 'Banner', '2' => 'Promotions Banner	'));
define('CURRENCY_SYMBOL', '₹');
