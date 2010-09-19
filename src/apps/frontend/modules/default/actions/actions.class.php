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

        $this->eventCode = $request->getParameter('event_code');
        $this->form = new PageCreationForm();

        $this->form->setDefault('just_giving_event_id', 1);

        if ($request->isMethod(sfWebRequest::POST))
        {
            $params = $request->getParameter($this->form->getName());

            $this->form->bind($params);

            if ($this->form->isValid())
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

                $uri = (string) $response->next->uri;

                if (!is_null($uri))
                {
                    //find the event id from the event code.
                    $event = Doctrine_Core::getTable('Event')->findOneByCode($this->eventCode);

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

                echo "URI = ".$uri;

                echo "TITLE IS ".$title;
            }
            else
            {
                echo "NOT VALID";
            }

        }
    }



}
