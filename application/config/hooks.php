<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = array(

    'class'    => 'LanguageLoader',

    'function' => 'initialize',

    'filename' => 'LanguageLoader.php',

    'filepath' => 'hooks'

);
if($_SERVER["SERVER_NAME"] == "donate.consumerthai.org"){
    /***Pro*****/
    $hook['post_controller_constructor'][] = array(
        'function' => 'force_ssl',
        'filename' => 'ssl.php',
        'filepath' => 'hooks'
    );
}
if($_SERVER["SERVER_NAME"] == "donate-consumer.local"){
    /***Pro*****/
    $hook['post_controller_constructor'][] = array(
        'function' => 'force_ssl',
        'filename' => 'ssl.php',
        'filepath' => 'hooks'
    );
}

