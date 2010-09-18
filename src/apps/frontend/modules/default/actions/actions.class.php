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
	echo str_replace("{applicationid}", $app_id, sfConfig::get('app_fundraising_list_all_live'));	

//	$url = str_repace("{applicationid}",$app_id, sfConfig::get('fundraising_list_all_sand'));
//	$url_to_send = str_repace("{pageShortName}",$app_id, $url);
	die();
  }
}
