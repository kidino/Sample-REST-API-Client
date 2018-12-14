<?php

class API_Client {
	var $base_url = 'http://api.mylocal.test/';
	var $token = null;
	var $user_agent = 'PHP API Client';
	
	function __construct($base_url = null, $token = null, $user_agent = null) {
		if ($base_url != null) {
			$this->base_url = $base_url;
		}
		if ($token != null) {
			$this->token = $token;
		}
		if ($user_agent != '') {
			$this->user_agent = $user_agent;
		}
	}
		
	function go($uri = '', $method = 'GET', $data = null, $expired = null) {
		
		$ch = curl_init($this->base_url.$uri);  
		$header = array();
		if ($data != null) {
			$data_string = json_encode($data);    
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);    
			$header[] = 'Content-Length: ' . strlen($data_string);
		}
		
		if ($this->token != null) {
			$header[] = 'Authorization: Bearer ' . $this->token;
		}
		
		$header[] = 'Content-Type: application/json';
		$header[] = 'User-Agent: '.$this->user_agent;
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);     

		$result = curl_exec($ch);
		$back_data = json_decode($result, true);
		
		if ($back_data != null) {
						
			if (isset($back_data['message']) && (
				(strpos($back_data['message'], 'Expired token') === 0)
				|| (strpos($back_data['message'], 'Unknown JSON error') === 0)
				|| (strpos($back_data['message'], 'Missing authorization header') === 0)
				|| (strpos($back_data['message'], 'Access to this resource is not in the scope of the provided token') === 0)
			) ) {
                return false;
			}
            return $back_data;
		} else {
            return $result;
        }
	}
    
    function login($username, $password) {
        
        $data = array(
            'username' => $username,
            'password' => $password
        );

        $result = $this->go('consumer/login','POST',$data);

        if (isset($result['token'])) {
            $this->save_token($result['token']);
            return true;
        } 
        return false;
    }
    
    function save_token($token) {
        $this->token = $token;
    }
    
    function get_token() {
        return $this->token;
    }
    
    function token_ok() {
        if ($this->token !== null) {
            $result = $this->go('todo','GET');
            if ($result === false) {
                return false;
            }
            return true;
        }
        return false;
    }
	
}
				
