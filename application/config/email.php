<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email
|--------------------------------------------------------------------------
*/  

	$config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.gmail.com'; //change this
    $config['smtp_port'] = '465';
    $config['smtp_user'] = 'oronaldosantos@gmail.com'; //change this
    $config['smtp_pass'] = 'Yes!Yes2020'; //change this
    $config['mailtype'] = 'html';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    $config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard