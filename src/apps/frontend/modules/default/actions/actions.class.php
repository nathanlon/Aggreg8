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
    public function executeIndex(sfWebRequest $request)
	{
        
    }

	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeEvent(sfWebRequest $request)
	{
        $eventCode = $request->getParameter('event_code');
        
        $this->event = Doctrine_Core::getTable('Event')->findOneByCode($eventCode);

		// get a  list of funds by fund name
		$p = Doctrine_Query::create()->select('p.*')
		  					   		 ->from('Page p');
                                     //->where();


		$this->pages = $p->execute();
        
	}


    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeForm(sfWebRequest $request)
    {
        //find the Just Giving Event Id.
        $eventCode = $request->getParameter('event_code');
        $event = Doctrine_Core::getTable('Event')->findOneByCode($eventCode);
        $firstJGEvent = $event->JustGivingEvent[0];
        $firstJGEventId = $firstJGEvent->id;

        $this->eventCode = $request->getParameter('event_code');
        $this->form = new PageCreationForm();
        $this->error = '';
        $this->form->setDefault('just_giving_event_id', $firstJGEventId);
        $this->form->setDefault('charity_code', '2357');

        if ($request->isMethod(sfWebRequest::POST))
        {
            $params = $request->getParameter($this->form->getName());

            $this->form->bind($params);

            if ($this->form->isValid())
            {
                $existingShortPage = $params['existing_short_name'];

                if ($existingShortPage != '')
                {
                    $resp = JustGivingAPI::retrievePage($existingShortPage);

                    $title = (string) $resp->eventName;

                    if ($title != '')
                    {
                        $page = new Page;
                        $page->title =          $title;
                        $page->short_name =     $existingShortPage;
                        $page->target_amount =  (string) $resp->fundraisingTarget;
                        $page->charity_name =   (string) $resp->charity->name;
                        $page->charity_code =   (string) $resp->charity->registrationNumber;
                        $page->money_raised =   (string) $resp->grandTotalRaisedExcludingGiftAid;
                        $page->user =           (string) $resp->owner;
                        $page->just_giving_event_id = $firstJGEventId;
                        $page->save();

                        $this->getUser()->setFlash('message', 'The page with the title "'.$page->title.'" was found and added.');
                    }
                    else
                    {
                        $this->getUser()->setFlash('message', 'The page was not found.');
                    }
                }
                else
                {

                    $title =        $params['title'];
                    $shortName =    $params['short_name'];
                    $targetAmount = $params['target_amount'];
                    $charityCode =  $params['charity_code'];
                    $jgEventId =    $params['just_giving_event_id'];


                    $response = JustGivingAPI::createPage('false' , $charityCode , 'false',
                                    $jgEventId, $title, 'false',
                                    $shortName, $title, null,
                                    $targetAmount );
                    if (!is_null($response))
                    {
                        $uri = (string) $response->next->uri;

                        if ($uri != '')
                        {
                            //find the event id from the event code.
                            //$event = Doctrine_Core::getTable('Event')->findOneByCode($this->eventCode);

                            $page = Doctrine_Core::getTable('Page')->create(array(
                                'title'      =>      $title,
                                'short_name' =>      $shortName,
                                'target_amount' =>   $targetAmount,
                                'charity_code' =>    $charityCode,
                                'just_giving_event_id' => $jgEventId
                                //'JustGivingEventId' => $jgEventId
                            ));

                            $page->save();

                            $this->redirect($uri);
                        }
                        else
                        {
                            $this->error = 'Not able to create this JustGiving page.';
                        }
                    }
                }
            }
            else
            {
                $this->error = "Form is invalid.";
            }

        }
    }



}
