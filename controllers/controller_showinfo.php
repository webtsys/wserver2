<?php

use Symfony\Component\Process\Process;

load_model('wserver2');
load_libraries(array('utilities'));
load_libraries(array('autoload'), PhangoVar::$base_path.'modules/wserver2/vendor/');

/**
* With this script, the user can access to create new servers, reconfiguring, etc.
*
*/

class ShowInfoSwitchClass extends ControllerSwitchClass {

	/**
	* This method obtain the token from the server.
	*/

	public function os($token)
	{
	
		$json=login($token, 0);
		
		if($json['login']==1)
		{
			
			$process = new Process('python3 '.PhangoVar::$base_path.'/modules/wserver2/scripts/os/getinfo.py');
			$process->run();

			if (!$process->isSuccessful()) {
				
				$json['error']=1;
				$json['error_txt']=$process->getErrorOutput();
			}

			$system_info=$process->getOutput();
			
			$json['system_info']=$system_info;
		
			echo json_encode($json);
		
		}
		else
		{
		
			echo json_encode($json);
		
		}
		
	
	}
	
	/**
	* This method is used for create a new server.
	*
	*/
	
	public function configure_server($token, $server_type, $server_script)
	{
	
		
	
	}

}

?>