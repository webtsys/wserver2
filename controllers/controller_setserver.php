<?php

/**
* With this script, the user can access to create new servers, reconfiguring, etc.
*
*/

class SetServerSwitchClass extends ControllerSwitchClass {

	/**
		* This method is used for create a new server.
		*
		*/

	public function index()
	{
		
		
		//Se ejecuta el daemon php
		//debian/wheezy/webserver/apache
		//Only need the category and the name.
	
		/*$process = new Process('python3 '.PhangoVar::$base_path.'modules/wserver2/controllers/python.py');
		
		$process->start();*/
		
		//Write in a file that is loaded by 
		
		/*$process->wait(function ($type, $buffer) {
			if (Process::ERR === $type) {
				echo 'ERR > '.$buffer;
			} else {
				echo 'OUT > '.$buffer;
			}
		});*/
	
		
	}

}

?>