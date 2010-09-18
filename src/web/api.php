<?php 
// $callName, $endpoint, $params = null, $isXML = true, $isTestMode = false
// function makeCurlRequest($callName, $endpoint, $params = null, $isXML = true, $isTestMode = false) {		
function makeCurlRequest( $endpoint, $payload, $params = null, $isXML = true, $isTestMode = false) 
{	
	//add any parameters directly to the end point.
	if (!is_null($params))
	{
		$endpoint .= $params;
	}

	echo "\nfull endpoint is ".$endpoint;
	//use cURL to send a request in xml, and receive the correct response.
	$ch = curl_init($endpoint);
	$ch = curl_init();
	
	$login = base64_encode("dan@dogsbody.org:trustno1");

	$header  = array("Content-Type: application/xml", "Authorize: Basic " . $login);
	
/*
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
 'Authorization: ' . CJ_API_KEY)
 'X-Authorization: ' . );
*/	
	$headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
	
//    curl_setopt( $ch, CURLOPT_USERPWD, $username.':'.$password);	
	curl_setopt( $ch, CURLOPT_URL , $endpoint );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );	
	curl_setopt( $ch, CURLOPT_HTTPHEADER , $header);
	curl_setopt( $ch, CURLOPT_HTTPGET , 1);
	
	//curl_setopt( $ch, CURLOPT_POST   , 0); //was 1
	//curl_setopt( $ch, CURLOPT_POSTFIELDS , $payload );
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

	//auto process as a simplexml file if it is xml, otherwise return raw data
	/*
	if ($isXML)
	{
		//get the xml with no cdata parts to it.
		$data = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
	}
	else
	{
		$data = $result;
	}
*/

	$data = $result;
	return $data;
}

$endpoint = "https://api.staging.justgiving.com/decbf1d2/v1/fundraising/pages";



$params = ""; //,comments,attendees
/*
//Yes About Authentication »/
$payload = <<<EOF
<pageRegistration xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
<activityType i:nil="true" />
<attribution i:nil="true" />
<charityFunded>false</charityFunded>
<charityId>2357</charityId>
<charityOptIn>false</charityOptIn>
<eventDate i:nil="true" />
<eventId>355883</eventId>
<eventName i:nil="true" />
<justGivingOptIn>false</justGivingOptIn>
<pageShortName>my-test-pageegA9karGrUGm8B09tqlmIA</pageShortName>
<pageTitle>my test page title</pageTitle>
<reference i:nil="true" />
<targetAmount>2000</targetAmount>
</pageRegistration>
EOF;
*/
$payload= "";
// function makeCurlRequest( $endpoint, $payload, $params = null, $isXML = true, $isTestMode = false) {		
$xml = makeCurlRequest($endpoint, $payload, $params,  true);
echo'<pre>';
print_r($xml);
echo'</pre>';

// ZGFuQGRvZ3Nib2R5Lm9yZzp0cnVzdG5vMQ==
// ZGFuQGRvZ3Nib2R5Lm9yZzp0cnVzdG5vMQ==
