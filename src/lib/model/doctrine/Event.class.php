<?php

/**
 * Event
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    aggreg8
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Event extends BaseEvent
{
    /**
     * Updates this events money raised value.
     * @return void
     */
    public function updateMoneyRaised()
    {

        $total = 0;
        //get the event and look through all its pages.
        foreach ($this->JustGivingEvent as $jgEvent)
        {
            $pages = Doctrine_Core::getTable('Page')->findByJustGivingEventId($jgEvent->id);

            //get and save the amount raised for each page.
            foreach ($pages as $page)
            {
                $resp = JustGivingAPI::retrievePage($page->short_name);

                $moneyRaised = (string) $resp->grandTotalRaisedExcludingGiftAid;
                $page->money_raised = $moneyRaised;
                $page->save();

                if ($moneyRaised > 0) {
                    $total += $moneyRaised;
                }

            }
        }

        //save the events total.
        $this->total_money = $total;
        $this->save();
    }

}
