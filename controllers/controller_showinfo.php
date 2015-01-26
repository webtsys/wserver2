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

	public function os($token, $server_type)
	{
		$server_type=basename($server_type);
	
		$json=login($token, 0);
		
		if($json['login']==1)
		{
			
			$process = new Process('python3 '.PhangoVar::$base_path.'/modules/wserver2/scripts/os/getinfo.py --type '.$server_type);
			$process->run();

			if (!$process->isSuccessful()) {
				
				$json['error']=1;
				$json['error_txt']=$process->getErrorOutput();
			}
			else
			{
				$system_info=$process->getOutput();
				
				$arr_system_info=json_decode($system_info, true);
				
				if(isset($arr_system_info['error']))
				{
					
					$json['error']=1;
					$json['error_txt']=$arr_system_info['error'];
				
				}
				else
				{
				
					$json['system_info']=$arr_system_info;
					
				}
			}
		
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