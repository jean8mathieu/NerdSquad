<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 11/9/14
 * Time: 10:32 AM
 */

session_start();
$_SESSION['lat'] = $_GET['lat'];
$_SESSION['long'] = $_GET['long'];

header('Location: http://health.jackiehuang.ca/dashboard');