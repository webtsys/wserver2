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
	* The schema is use key how IP and value how wpanel2 url.
	*/

	static public $arr_server=array();
	
	static public $os_version=array('os' => 'debian', 'version' => 'wheezy');
	
	static public $verify_guzzle_ssl=false;
	
}

load_config('wserver2');


?>