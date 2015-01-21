<?php

PhangoVar::$urls['wserver']['login']=array('pattern' => '/^wserver\/login\/(\w+)$/', 'url' => '/wserver/login', 'module' => 'wserver2', 'controller' => 'admin', 'action' => 'login', 'parameters' => array('$1' => 'string'));

?>