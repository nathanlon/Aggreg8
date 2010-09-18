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
	$app_key = sfConfig::get('app_just_giving_app_key');
	$app_id = sfConfig::get('app_just_giving_app_id');	
	$page_url = str_replace("{applicationid}", $app_id, sfConfig::get('app_fundraising_list_all_sand'));	
	
// https://api.justgiving.com/{applicationid}/v1/fundraising/pages 	
	
echo $page_url;

die;
//Yes About Authentication »/
$page_create_data = <<<EOF
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


<<<<<<< HEAD
        $ctx = stream_context_create($params);
        $response = file_put_contents($page_url, $page_create_data, FILE_APPEND, $ctx);

echo'<pre>';
print_r($response);
echo'</pre>';
/*
	$stream = stream_context_create();
	$response = file_put_contents($page_url, $page_create_data);	
	echo'<pre>';
	print_r($response);
*/
=======
>>>>>>> 8c663e852922b86f9128e3bedc1a96b723fe088a
	die();
  }
}
