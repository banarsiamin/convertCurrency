<?php 
function akbce_liveAPI_ajaxfn(){
    $priceUSD = !empty($_POST['_akbce_price_in_usd'])? $_POST['_akbce_price_in_usd']:'1';
    $accessKey = '*************';
    	// Replace 'USD' and 'ZAR' with the desired currencies
	$baseCurrency = 'USD';
	$targetCurrency = 'INR';
	// Make an API request to get the latest exchange rates
	// $apiUrl = "http://data.fixer.io/api/latest?access_key=$accessKey&base=$baseCurrency&symbols=$targetCurrency";

	// Make API request to Fixer.io to get latest exchange rates
	$apiUrl = "https://v6.exchangerate-api.com/v6/$accessKey/latest/$baseCurrency";
	$ch = curl_init($apiUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);

	// Check if the request was successful
	if ($response === false) {
	    die('Error fetching data from Fixer API.');
	}

	// Decode the JSON response
	$data = json_decode($response, true);
	$conversion_rates = isset($data['conversion_rates'][$targetCurrency])?$data['conversion_rates'][$targetCurrency]:'';
	echo $zarPrice = round(($priceUSD * $conversion_rates), 2);
    // echo json_encode($data);
    die;
}
