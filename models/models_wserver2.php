<?php

/*
* Model for identify to a admin user.
*
*/

PhangoVar::$model['wserver_admin']=new Webmodel('wserver_admin');

PhangoVar::$model['wserver_admin']->set_component('wtoken', 'CharField', array(255));

class ConfigWServer {

	/**
	* This array save the ips from server that have permissions for configure this server.
	*
	*/

	static public $arr_server=array();
	
}

load_config('wserver2');


?>