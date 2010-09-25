<?php

/**
 * default actions.
 *
 * @package    aggreg8
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions {

    public function preExecute() {
        $action = $this->getRequest()->getParameter('action');
        $module = $this->getRequest()->getParameter('module');
        $this->pageName = $module . ucfirst($action);
    }

    public function executeIndex(sfWebRequest $request) {

        list($this->events, $this->allEventsTotal) = Doctrine_Core::getTable('Event')->getEventsAndTotal();
    }

    /**
     * Executes index action, Gets the pages within each JustGivingEvent object under an event.
     *
     * @param sfRequest $request A request object
     */
    public function executeEvent(sfWebRequest $request) {
        $eventCode = $request->getParameter('event_code');

        $this->event = Doctrine_Core::getTable('Event')->findOneByCode($eventCode);

        //go through all the JustGivingEvent objects, finding pages.
        $pages = array();

        $jgEvents = Doctrine_Core::getTable('JustGivingEvent')->createQuery('jge')
            ->where('jge.event_id = ?', $this->event->id)
            ->execute();

        foreach ($jgEvents as $jgEvent)
        {
            // get a  list of funds by fund name
            $newPages = Doctrine_Core::getTable('Page')->createQuery('p')
                ->where('p.just_giving_event_id = ?', $jgEvent->id)
                ->execute();

            foreach ($newPages as $page)
            {
                $pages[] = $page;
            }
        }

        $this->pages = $pages;

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeForm(sfWebRequest $request) {
        $this->charityName = '';
        $this->charityCodeArray = array();
        //find the Just Giving Event Id.
        $eventCode = $request->getParameter('event_code');
        $this->event = Doctrine_Core::getTable('Event')->findOneByCode($eventCode);
        $firstJGEvent = $this->event->JustGivingEvent[0];
        $firstJGEventId = $firstJGEvent->id;

        $this->eventCode = $request->getParameter('event_code');
        $this->form = new PageCreationForm();
        $this->error = '';
        $this->form->setDefault('just_giving_event_id', $firstJGEventId);
        //$this->form->setDefault('charity_code', '2357');

        if ($request->isMethod(sfWebRequest::POST)) {
            $params = $request->getParameter($this->form->getName());

            $this->form->bind($params);

            if ($this->form->isValid()) {
                $existingShortPage = $params['existing_short_name'];

                if ($existingShortPage != '') {
                    $resp = JustGivingAPI::retrievePage($existingShortPage);

                    $title = (string) $resp->eventName;

                    if ($title != '') {
                        $page = new Page;
                        $page->title = $title;
                        $page->short_name = $existingShortPage;
                        $page->target_amount = (string) $resp->fundraisingTarget;
                        $page->charity_name = (string) $resp->charity->name;
                        $page->charity_code = (string) $resp->charity->registrationNumber;
                        $page->money_raised = (string) $resp->grandTotalRaisedExcludingGiftAid;
                        $page->user = (string) $resp->owner;
                        $page->just_giving_event_id = $firstJGEventId;
                        $page->save();

                        $this->getUser()->setFlash('message', 'The page with the title "' . $page->title . '" was found and added.');
                    }
                    else
                    {
                        $this->getUser()->setFlash('message', 'The page was not found.');
                    }
                }
                else
                {

                    $title = $params['title'];
                    $shortName = $params['short_name'];
                    $targetAmount = $params['target_amount'];
                    $charityCode = $params['charity_code'];
                    $charityName = $params['charity_name'];
                    $charitySearch = $params['charity_search'];
                    $jgEventId = $params['just_giving_event_id'];

                    //if searching for a charity, find it first.
                    if (($charitySearch != '') && ($charityCode == '')) {
                        $charityResp = JustGivingAPI::charitySearch($charitySearch);

                        if ($charityResp->error == '') {
                            $charityName = (string) $charityResp->charitySearchResults->charitySearchResult[0]->name;
                            $charityCode = (string) $charityResp->charitySearchResults->charitySearchResult[0]->charityId;

                            $this->form->setDefault('charity_code', $charityCode);
                            $this->charityName = $charityName;
                            $this->charityCodeArray = array('value' => $charityCode);

                            $this->form->setDefaults(array('charity_name' => $charityName));
                            $this->getUser()->setFlash('message', 'We have found a charity, click submit again to use this, or clear the charity id and try again.');
                            return;

                        }
                        else
                        {
                            $this->getUser()->setFlash('message', (string) $charityResp->error->desc);
                            return;
                        }
                    }


                    $response = JustGivingAPI::createPage('false', $charityCode, 'false',
                        $jgEventId, $title, 'false',
                        $shortName, $title, null,
                        $targetAmount);


                    if (!is_null($response)) {
                        $uri = (string) $response->next->uri;

                        if ($uri != '') {

                            $page = Doctrine_Core::getTable('Page')->create(array(
                                'title' => $title,
                                'short_name' => $shortName,
                                'target_amount' => $targetAmount,
                                'charity_code' => $charityCode,
                                'charity_name' => $charityName,
                                'just_giving_event_id' => $jgEventId
                            ));

                            $page->save();

                            $this->redirect($uri);
                        }
                        else
                        {
                            $this->getUser()->setFlash('message', 'Not able to create this JustGiving page.');
                        }
                    }
                }
            }
            else
            {
                $this->getUser()->setFlash('message', "Form is invalid.");
            }

        }
    }


}
