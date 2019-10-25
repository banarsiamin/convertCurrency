function exchangeRate($amount=1,$from_Currency='EUR',$to_Currency='USD') {
		$amount = urlencode($amount);
		$from_Currency = urlencode($from_Currency);
		$to_Currency = urlencode($to_Currency);
		$req_url = "https://api.exchangerate-api.com/v4/latest/$from_Currency";
		$response_json = file_get_contents($req_url);
		if(false !== $response_json) {
			$response_object = json_decode($response_json);
			//echo "<PRE>";print_r($response_object);echo "<PRE>";//die;
			$amount = round(($amount * $response_object->rates->$to_Currency), 2);
			return $amount ;

		}else{
			return $amount ;
		}
	}
 echo exchangeRate(1,'USD',INR);
