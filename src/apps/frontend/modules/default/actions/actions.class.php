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
		
		$this->eventTotal = '123.00';//$event->total_money;

        
	}


}
