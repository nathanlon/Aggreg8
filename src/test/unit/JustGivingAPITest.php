<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(20, new lime_output_color());

$configuration = ProjectConfiguration::getApplicationConfiguration( 'frontend', 'test', true);


$t->comment('->donationRecieveStatus()');


// List of Fundraising Pages by Email
// <-- Returns internal server error!
$response = JustGivingAPI::donationRecieveStatus(1);


$t->isnt($response, null, 'Works');

// Account Create
$response = JustGivingAPI::accountCreate($country="UK", 
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


$t->isnt($response, null, 'Works');

// List of Fundraising Pages by Email
$response = JustGivingAPI::listAllFundRaisingPagesByEmail("dan@dogsbody.org");


$t->isnt($response, null, 'Works');

// List Fundraising Pages by Auth User
$response = JustGivingAPI::listAllFundRaisingPagesForUser();


$t->isnt($response, null, 'Works');

// Charity Search
$response = JustGivingAPI::charitySearch($term = "Cancer", 
                                 $page = 1,
                                 $page_size = 4);

$t->isnt($response, null, 'Works');

// Retrieve Page Donations		
$response = JustGivingAPI::retrievePageDonations();


$t->isnt($response, null, 'Works');

// Create a Page
$response =  JustGivingAPI::createPage($charity_funded 	   = "false" , 
                               $charity_id 		   = 2367 , 
                               $charity_opt_in 	   = "false", 
                               $event_id 		   = 9999, 
                               $event_name 		   = "TEST EVENT 2", 
                               $just_giving_opt_in = "false", 
                               $page_short_name    = "TEST EVENT 2", 
                               $page_title 		   = "PAGE TITLE 2", 
                               $activity_type_id   = "InMemory", 
                               $target_amount	   = 2000 );

$t->isnt($response, null, 'Works');