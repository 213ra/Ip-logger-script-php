<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   file                 :  index.php
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *   author               :  DEVISION
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

include_once($_SERVER['DOCUMENT_ROOT'].'/includes.php');

/* Information */
$userHost      	= $Secure->getUserIP();
$userOS        	= $Secure->getUserOS();
$userBrowser   	= $Secure->getUserBrowser();
$userAgent 		= $user_agent;
// Request
$Secure->saveUserInfo($userHost, $userOS, $userBrowser, $userAgent);
// Get Image
$gImage = $url.'/geri_brat_moj.jpg';

$data = file_get_contents($gImage); header('Content-type: image/png'); echo $data; die();