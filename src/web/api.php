<?php 

function makeCurlRequest( $endpoint, $payload, $auth = false) 
{	
	// if we need to authenticate the request.. 
	// add the username / password 
	$username = "dan@dogsbody.org";
	$password = "trustno1";
	
	if( $auth ) {
		$login = base64_encode($username.":".$password);
		$header  = array("Content-Type: application/xml", "Authorize: Basic " . $login);	
	} else {
		$header  = array("Content-Type: application/xml");			
	}

	//use cURL to send a request in xml, and receive the correct response.
	$ch = curl_init($endpoint);
	$ch = curl_init();
			
	$headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
	
	curl_setopt( $ch, CURLOPT_URL , $endpoint );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );	
	curl_setopt( $ch, CURLOPT_HTTPHEADER , $header);
	curl_setopt( $ch, CURLOPT_HTTPGET , 1);	
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

	$result = curl_exec($ch);

	if (curl_errno($ch) != 0)
	{
		// If a curl error occurred.
		print "CURL request failed. Error #" . curl_errno($ch) . "\n";
		print "EXTRA DETAIL: " . curl_error($ch) . "\n";
		curl_close($ch);
		return false;
	}

	$data = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
	return $data;
}

$endpoint = "https://api.staging.justgiving.com/decbf1d2/v1/fundraising/pages";


// function makeCurlRequest( $endpoint, $payload, $params = null, $header = array()) 
$response = makeCurlRequest($endpoint, $payload="",  $auth=true);

echo'<pre>';
print_r($response);
echo'</pre>';