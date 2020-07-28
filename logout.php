<?php
require_once 'initialization.php';
$user->logout();
header("Location: login.php");