<?php 

class JustGivingAPI 
{
	// constructor
	private $username;
	private $password;


	// Gets the status of a donation using donationId. 
	// --------------------
	// HTTP Method: GET
	// Auth: No
	//
	public static function donationRecieveStatus($donation_id) 
	{
		if(!$donation_id) {
			return false; // throw an exception here
		} else {

			$url = sfConfig::get("app_donation_retrieve_status_sand");

			// add the search term
			$url .= "?donationId=".$donation_id;

			$resp = self::makeCurlRequest( $url, $payload = "", $auth = false, $http_method = "GET" );

			return $resp;			
		}		
	}

	// Registers an account with JustGiving
	// ------------------------------------
	// HTTP Method: PUT
	// Auth: No
	//
	public static function accountCreate($country, $county_or_state, $line1,
								  $line2, $postcode_or_zipcode, $town_or_city, 
								  $email, $first_name, $last_name, 
								  $password, $reference, $title) {

$payload = <<<XMLDOC
<registration xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
  <acceptTermsAndConditions>true</acceptTermsAndConditions>
<address>
    <country>$country</country>
    <countyOrState>$county_or_state</countyOrState>
    <line1>$line1</line1>
    <line2>$line2</line2>
    <postcodeOrZipcode>$postcode_or_zipcode</postcodeOrZipcode>
    <townOrCity>$town_or_city</townOrCity>
</address>
  <email>$email</email>
  <firstName>$first_name</firstName>
  <lastName>$last_name</lastName>
  <password>$password</password>
  <reference>$reference</reference>
  <title>$title</title>
</registration>		
XMLDOC;

		$url = sfConfig::get('app_account_create_sand');

		// make the API call
		$resp = self::makeCurlRequest( $url, $payload, $auth = true, $http_method = "PUT" );

		return $resp;		

	}

	// Lists all fundraising Pages for the supplied email. 
	// --------------------------
	// HTTP Method: GET
	// Auth: No
	//
	public static function listAllFundRaisingPagesByEmail($email)
	{
		if(!$email) {
			return false; // throw an exception here
		} else {

			$url = sfConfig::get("app_fundraising_list_all_sand");
			// add the search term
			$url .= "?email=".$email;

			$resp = self::makeCurlRequest( $url, $payload = "", $auth = true, $http_method = "GET" );
			return $resp;			
		}				
	}

	// Lists all fundraising Pages for the Authenticated User. 
	// -------------------
	// HTTP Method: GET
	// Auth: Yes
	// 
	public static function listAllFundRaisingPagesForUser()
	{
		$url = sfConfig::get("app_fundraising_list_all_sand");
		$resp = self::makeCurlRequest( $url, $payload = "", $auth = true, $http_method = "GET" );
		return $resp;
	}

	// search for a charity
	// --------------------
	// HTTP Method: GET
	// Auth: No
	// 
	// $term =  q String
	// 			page - for pagination
	// 			pageSize - restricts result set
	// 
	public static function charitySearch($term, $page="", $page_size="")
	{
		if(!$term) {
			return false; // throw an exception here
		} else {

			$url = sfConfig::get("app_search_charity_search_sand");
			$url = str_replace("{email}", sfConfig::get('app_email'), $url);

			// add the search term
			$url .= "?q=".$term;

			(!empty($page)) ? $url.= "&page=".$page : $url.="";
			(!empty($page_size)) ? $url.= "&pageSize=".$page_size : $url.="";

			// make the API call
			$resp = self::makeCurlRequest( $url, $payload = "", $auth = false, $http_method = "GET" );
			return $resp;					
		}
	}	

	// list all pages by email
	// -----------------------------
	// HTTP Method: GET
	// Auth: No	
	// Lists all fundraising Pages for the supplied email. 
	// 	
	public static function retrievePageDonations()
	{
		$url = sfConfig::get("app_account_list_all_pages_sand");
		$url = str_replace("{email}", sfConfig::get('app_email'), $url);

		// make the API call
		$resp = self::makeCurlRequest( $url, $payload = "", $auth = false, $http_method = "GET" );
		return $resp;
	}

	// create a fund raising page 
	// --------------------------
	// HTTP Method: PUT 
	// Auth: Yes
	// Registers a Fundraising Page on the JustGiving.com website, 
	// for example justgiving.com/John-Vaughan-Fowler. 	
	// 
	public static function createPage( $charity_funded , $charity_id , $charity_opt_in,
								$event_id, $event_name, $just_giving_opt_in, 
								$page_short_name, $page_title, $activity_type_id, 
								$target_amount ) {

$payload = <<<XMLDOC
<pageRegistration xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
<activityType i:nil="true" />
<attribution i:nil="true" />
  <charityFunded>$charity_funded</charityFunded>
  <charityId>$charity_id</charityId>
  <charityOptIn>$charity_opt_in</charityOptIn>
<eventDate i:nil="true" />
  <eventId>$event_id</eventId>
<eventName i:nil="true" />
  <eventName>$event_name</eventName>
  <justGivingOptIn>$just_giving_opt_in</justGivingOptIn>
  <pageShortName>$page_short_name</pageShortName>
  <pageTitle>$page_title</pageTitle>
  <activityTypeId>$activity_type_id</activityTypeId>
<reference i:nil="true" />
  <targetAmount>$target_amount</targetAmount>
</pageRegistration>
XMLDOC;

		$url = sfConfig::get('app_fundraising_create_sand');

		// make the API call
		$resp = self::makeCurlRequest( $url, $payload, $auth = true, $http_method = "PUT" );

		return $resp;
	}

	/**
	*
	*/
	public static function getListOfUrls()
	{		
		$url_ar['account_create']['sand']='https://api.staging.justgiving.com/50694b0a/v1/account';
		/*
		# --------------------  
		# Just Giving API URLs
		# --------------------
		# Account
		  account_create_sand: 
		  account_create_live: https://api.justgiving.com/50694b0a/v1/account 
		#  List All Pages (http://apimanagement.justgiving.com/wiki/account-list-all-pages)
		  account_list_all_pages_sand: https://api.staging.justgiving.com/50694b0a/v1/account/{email}/pages 
		  account_list_all_pages_live: https://api.justgiving.com/50694b0a/v1/account/{email}/pages 
		# Donation
		#  Retrieve Status (http://apimanagement.justgiving.com/wiki/donation-retrieve-status)
		  donation_retrieve_status_sand: https://api.staging.justgiving.com/50694b0a/v1/donation/{donationId}/status 
		  donation_retrieve_status_live: https://api.justgiving.com/50694b0a/v1/donation/{donationId}/status  
		# Fundraising
		#  Create (http://apimanagement.justgiving.com/wiki/page-create)
		  fundraising_create_sand: https://api.staging.justgiving.com/50694b0a/v1/fundraising/pages  
		  fundraising_create_live: https://api.justgiving.com/50694b0a/v1/fundraising/pages  
		#  Is ShortName Registered (http://apimanagement.justgiving.com/wiki/page-is-shortName-registered)
		  fundraising_is_shortname_registered_sand: https://api.staging.justgiving.com/50694b0a/v1/fundraising/pages/{pageShortName} 
		  fundraising_is_shortname_registered_live: https://api.justgiving.com/50694b0a/v1/fundraising/pages/{pageShortName} 
		#  List All (http://apimanagement.justgiving.com/wiki/page-list-all)
		  fundraising_list_all_sand: https://api.staging.justgiving.com/50694b0a/v1/fundraising/pages  
		  fundraising_list_all_live: https://api.justgiving.com/50694b0a/v1/fundraising/pages 
		#  Retrieve Donations For Page
		  fundraising_retrieve_donations_for_page_sand: https://api.staging.justgiving.com/50694b0a/v1/fundraising/pages/{pageShortName}/donations 
		  fundraising_retrieve_donations_for_page_live: https://api.justgiving.com/50694b0a/v1/fundraising/pages/{pageShortName}/donations 
		#  Retrieve Page
		  fundraising_retrieve_page_sand: https://api.staging.justgiving.com/50694b0a/v1/fundraising/pages/{pageShortName} 
		  fundraising_retrieve_page_live: https://api.justgiving.com/50694b0a/v1/fundraising/pages/{pageShortName} 
		#  Upload Image
		#  Update Story
		# Search
		#  Charity Search (http://apimanagement.justgiving.com/wiki/search-charity-search)
		  search_charity_search_sand: https://api.staging.justgiving.com/50694b0a/v1/charity/search 
		  search_charity_search_live: https://api.justgiving.com/50694b0a/v1/charity/search		
		*/
	}


	/**
	* Make the API call to JustGiving using CURL
	* $endpoint = URI of the webservice 
	* $payload = XML data to send
	* $auth = authentication required (true/false)  
	* $http_method = http request type ( GET / PUT / POST )
	*/
	public static function makeCurlRequest( $endpoint, $payload, $auth = false, $http_method = null )
	{	
		if(!$http_method) {

			return false; // should probably throw an exception here..

		} else {

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

			if($http_method == "GET") {
				curl_setopt( $ch, CURLOPT_HTTPGET , 1);	
			} else if($http_method == "POST") {								
				curl_setopt( $ch, CURLOPT_POST , 1);					
			} else if($http_method == "PUT") {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');  
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			} else {
				curl_setopt( $ch, CURLOPT_HTTPGET , 1);					
			}

			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

			$result = curl_exec($ch);

			if (curl_errno($ch) != 0)
			{
				print "CURL request failed. Error #" . curl_errno($ch) . "\n";
				print "EXTRA DETAIL: " . curl_error($ch) . "\n";
				curl_close($ch);
				return false;
			}

			$data = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
			return $data;			
		}
	}	
}
?>