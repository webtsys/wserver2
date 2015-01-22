<?php

use GuzzleHttp\Client;

load_model('wserver2');

/**
* Here, the user send the token, if not exists on the server, go via restful to origin server
*
*/

function login($token, $return_json=1)
{

	load_libraries(array('autoload'), PhangoVar::$base_path.'modules/wserver2/vendor/');
	
	$arr_token=PhangoVar::$model['wserver_admin']->select_a_row_where('where wtoken="'.PhangoVar::$model['wserver_admin']->check_where_sql('wtoken', $token).'"');
	
	settype($arr_token['IdWserver_admin'], 'integer');
	
	$yes_login=0;
	$error=0;
	$error_txt='Invalid token';
	
	if(isset(ConfigWServer::$arr_server[$_SERVER['REMOTE_ADDR']]))
	{
	
		$url_server=make_direct_url( ConfigWServer::$arr_server[$_SERVER['REMOTE_ADDR']], 'wpanel2', 'rest/login', array('token_sended' => $token));
		
		if($arr_token['IdWserver_admin']>0)
		{
		
			$yes_login=1;
			$error_txt='';
		
		}
		else
		{
		
			//Need connect to origin server.
			
			$json=array();
					
			$client = new Client();
			
						
			try {
				
				$response = $client->get($url_server, [ 'verify' => ConfigWserver::$verify_guzzle_ssl ]  );
				
				$json = $response->json();
				
				//return json_encode($json);
				
				if($json['login']==1)
				{
					//Insert into table
					
					if(PhangoVar::$model['wserver_admin']->insert(array('wtoken' => $token)))
					{
				
						$yes_login=1;
						$error=0;
						$error_txt='Inserted...';
						
					}
					else
					{
						$yes_login=0;
						$error=2;
						$error_txt='Cannot insert the new token in the database';
					
					}
				
				}
				else
				{
				
					$error_txt='Central server rejected the login';
				
				}
				
				
			} catch (exception $e) {
			
				return json_encode(array('login' => 0, 'code_error' =>-1, 'txt_error' => 'Error in central server -> '.$e->getMessage().'<p>'.$response->getBody() ));

			}
			
		
		}
	}
	else
	
	{
		
		$yes_login=0;
		$error=1;
		$error_txt='IP forbidden';
	
	}
	
	switch($return_json)
	{
	
		default:
		
			return json_encode(array('login' => $yes_login, 'code_error' => $error, 'txt_error' => $error_txt));
		
		break;
		
		case 0:
		
			return $yes_login;
		
		break;
	
	}

}

?>