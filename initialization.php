<?php
header("Access-Control-Allow-Origin: *");

if (file_exists('config.php')) {
    require_once 'config.php';
} else {
    header("Location: Install/installation.php");
    exit();
}

session_start();

date_default_timezone_set(TIME_ZONE);

//import library
require_once 'classes/DB.class.php';
require_once 'classes/Msg.class.php';
require_once 'classes/User.class.php';

$db = new DB();
$msg = new Msg();
$user = new User();
?>