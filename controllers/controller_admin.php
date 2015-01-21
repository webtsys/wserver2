<?php

/**
* With this script, the user can access to create new servers, reconfiguring, etc.
*
*/

load_model('wserver2');

class AdminSwitchClass extends ControllerSwitchClass {

	public function execute($token, $controller, $action)
	{
	
		//Here, execute the function.
		//Parameters are passed via post and is passed to a ControllerSwitchClass
		
	
	}
	
	/**
	* Here, the user send the token, if not exists on the server, go via restful to origin server
	*
	*/
	
	public function login($token, $return_json=1)
	{
	
		load_libraries(array('autoload'), PhangoVar::$base_path.'modules/wserver2/vendor/');
	
		$arr_token=PhangoVar::$model['wserver_admin']->select_to_array('where wtoken="'.PhangoVar::$model['wserver_admin']->check_where_sql('wtoken', $token).'"');
		
		settype($arr_token['IdWserver_admin'], 'integer');
		
		$yes_login=0;
		$error=0;
		$error_txt='Invalid token';
		
		if($arr_token['IdWserver_admin']>0)
		{
		
			$yes_login=1;
		
		}
		else
		{
		
			//Need connect to origin server.
		
		}
		
		if(!isset(ConfigWServer::$arr_server[$_SERVER['REMOTE_ADDR']]))
		{
			
			$yes_login=0;
			$error=1;
			$error_txt='IP forbidden';
		
		}
		
		switch($return_json)
		{
		
			default:
			
				echo json_encode(array('login' => $yes_login, 'code_error' => $error, 'txt_error' => $error_txt));
			
			break;
			
			case 0:
			
				return $yes_login;
			
			break;
		
		}
	
	}

}

?>