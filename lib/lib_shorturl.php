<?php
function shorturl($longUrl){
	// Get API key from : http://code.google.com/apis/console/
	$apiKey = 'cc138af60228592b7f7755c7a64bbfd74acef94f';

	$url = "https://api-ssl.bitly.com/v3/shorten?longUrl={$longUrl}&access_token={$apiKey}";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	 
	$arr_result = curl_exec($ch);
	 
	$arr_response = json_decode($arr_result);
	 
	//echo $arr_response->data->url;
	if(!isset($arr_response->data->url)){
		return $arr_response->error->message;
	}else{
		return $arr_response->data->url;
	} 
}

?>