<?php

PhangoVar::$urls['wserver']['login']=array('pattern' => '/^wserver\/login\/(\w+)$/', 'url' => '/wserver/login', 'module' => 'wserver2', 'controller' => 'admin', 'action' => 'login', 'parameters' => array('$1' => 'string'));

//Load urls for every module.
//Structure is controlers/servers/so/so_version/type_server_codename/controllers_folder_name/controller file
//Use cache?


?>