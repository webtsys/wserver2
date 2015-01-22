<?php

/**
* With this script, the user can access to create new servers, reconfiguring, etc.
*
*/

load_model('wserver2');
load_libraries(array('utilities'));

class ShowInfoSwitchClass extends ControllerSwitchClass {

	/**
	* This method obtain the token from the server.
	*/

	public function os($token)
	{
	
		$json=login($token, 0);
		
		if($json['login']==1)
		{
		
			//Execute a script that obtain the data of this system.
		
			echo json_encode($json);
		
		}
		else
		{
		
			echo json_encode($json);
		
		}
		
	
	}

}

?>