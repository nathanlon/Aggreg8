<?php

/**
 * default actions.
 *
 * @package    aggreg8
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		// get a  list of funds by fund name
		$p = Doctrine_Query::create()->select('p.*')
		  					   		 ->from('Page p');
		
		$this->pages = $p->execute();
		
		//
		$this->executeTestAPICalls();
				
	}

	// collection of API calls
	public function executeTestAPICalls() 
	{	
		// List of Fundraising Pages by Email
		// <-- Returns internal server error!
		$response = $this->donationRecieveStatus(1);

		// Account Create
		$response = $this->accountCreate($country="UK", 
										 $county_or_state="London", 
										 $line1="Flat 3", 
									  	 $line2="176 Shoreditch High Street", 
									     $postcode_or_zipcode="E1 6AX", 
									     $town_or_city="London", 
									  	 $email="justen.doherty@whitewater.biz", 
									     $first_name="Justen", 
									     $last_name="Doherty", 
									  	 $password="pa55w0rd", 
									     $reference="CharityHack 2010", 
									     $title="Mr");

		// List of Fundraising Pages by Email
		$response = $this->listAllFundRaisingPagesByEmail("dan@dogsbody.org");

		// List Fundraising Pages by Auth User
		$response = $this->listAllFundRaisingPagesForUser();

		// Charity Search
		$response = $this->charitySearch($term = "Cancer", 
							 			 $page = 1,
							 			 $page_size = 4);

		// Retrieve Page Donations		
		$response = $this->retrievePageDonations();

		// Create a Page
		$response =  $this->createPage($charity_funded 	   = "false" , 
								 	   $charity_id 		   = 2367 , 
								 	   $charity_opt_in 	   = "false", 
								 	   $event_id 		   = 9999, 
								 	   $event_name 		   = "TEST EVENT 2", 
								 	   $just_giving_opt_in = "false", 
								 	   $page_short_name    = "TEST EVENT 2", 
								 	   $page_title 		   = "PAGE TITLE 2", 
								 	   $activity_type_id   = "InMemory", 
								 	   $target_amount	   = 2000 );

	}

	// Gets the status of a donation using donationId. 
	// --------------------
	// HTTP Method: GET
	// Auth: No
	// 
	public function donationRecieveStatus($donation_id) 
	{
		if(!$donation_id) {
			return false; // throw an exception here
		} else {
				
			$url = sfConfig::get("app_donation_retrieve_status_sand");
			
			// add the search term
			$url .= "?donationId=".$donation_id;
			
			$resp = $this->makeCurlRequest( $url, $payload = "", $auth = false, $http_method = "GET" );
			
			return $resp;			
		}		
	}
		
	// Registers an account with JustGiving
	// ------------------------------------
	// HTTP Method: PUT
	// Auth: No
	//
	public function accountCreate($country, $county_or_state, $line1, 
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
		$resp = $this->makeCurlRequest( $url, $payload, $auth = true, $http_method = "PUT" );

		return $resp;		

	}
	
	// Lists all fundraising Pages for the supplied email. 
	// --------------------------
	// HTTP Method: GET
	// Auth: No
	//
	public function listAllFundRaisingPagesByEmail($email) 
	{
		if(!$email) {
			return false; // throw an exception here
		} else {
						
			$url = sfConfig::get("app_fundraising_list_all_sand");
			// add the search term
			$url .= "?email=".$email;
			
			$resp = $this->makeCurlRequest( $url, $payload = "", $auth = true, $http_method = "GET" );
			return $resp;			
		}				
	}
		
	// Lists all fundraising Pages for the Authenticated User. 
	// -------------------
	// HTTP Method: GET
	// Auth: Yes
	// 
	public function listAllFundRaisingPagesForUser() 
	{
		$url = sfConfig::get("app_fundraising_list_all_sand");
		$resp = $this->makeCurlRequest( $url, $payload = "", $auth = true, $http_method = "GET" );
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
	public function charitySearch($term, $page="", $page_size="") 
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
			$resp = $this->makeCurlRequest( $url, $payload = "", $auth = false, $http_method = "GET" );
			return $resp;					
		}
	}	
	
	// list all pages by email
	// -----------------------------
	// HTTP Method: GET
	// Auth: No	
	// Lists all fundraising Pages for the supplied email. 
	// 	
	public function retrievePageDonations() 
	{
		$url = sfConfig::get("app_account_list_all_pages_sand");
		$url = str_replace("{email}", sfConfig::get('app_email'), $url);

		// make the API call
		$resp = $this->makeCurlRequest( $url, $payload = "", $auth = false, $http_method = "GET" );
		return $resp;
	}
	
	// create a fund raising page 
	// --------------------------
	// HTTP Method: PUT 
	// Auth: Yes
	// Registers a Fundraising Page on the JustGiving.com website, 
	// for example justgiving.com/John-Vaughan-Fowler. 	
	// 
	public function createPage( $charity_funded , $charity_id , $charity_opt_in, 
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
		$resp = $this->makeCurlRequest( $url, $payload, $auth = true, $http_method = "PUT" );
		
		return $resp;
	}
	
	/**
	* Make the API call to JustGiving using CURL
	* $endpoint = URI of the webservice 
	* $payload = XML data to send
	* $auth = authentication required (true/false)  
	* $http_method = http request type ( GET / PUT / POST )
	*/
	public function makeCurlRequest( $endpoint, $payload, $auth = false, $http_method = null ) 
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
