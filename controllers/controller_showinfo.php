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
	
		echo login($token);
		
	
	}

}

?>