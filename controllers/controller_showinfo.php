<?php

/**
* With this script, the user can access to create new servers, reconfiguring, etc.
*
*/

load_model('wserver2');
load_libraries(array('login'));

class ShowInfoSwitchClass extends ControllerSwitchClass {

	public function index($token)
	{
	
		echo login($token);
		
	
	}

}

?>