<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
//
//$hook['pre_system'][]= array(
//    'class' => 'Maintenance',
//    'function' => 'offline',
//    'filename' => 'Maintenance.php',
//    'filepath' => 'hooks'
//);

$hook['pre_controller'][] = array(
    'class'    => 'PHPFatalError',
    'function' => 'setHandler',
    'filename' => 'PHPFatalError.php',
    'filepath' => 'hooks'
);

$hook['post_controller_constructor'][] = array(
    'class'    => 'AffiliateChecker',
    'function' => 'checker',
    'filename' => 'AffiliateChecker.php',
    'filepath' => 'hooks'
);


$hook['post_controller_constructor'][] = array(
    'class'    => 'LanguageLoader',
    'function' => 'initialize',
    'filename' => 'LanguageLoader.php',
    'filepath' => 'hooks'
);

$hook['post_controller'][] = array(
    'class'    => 'DefaultLanguage',
    'function' => 'initialize',
    'filename' => 'DefaultLanguage.php',
    'filepath' => 'hooks'
);