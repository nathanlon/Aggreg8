<?php


class EventTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Event');
    }

    public function getEventsAndTotal()
    {
        $eventTable = $this->getInstance();

        $events = $eventTable->findAll();


        $total = 0;
        foreach ($events as $event)
        {
            $total += $event->total_money;
        }

        return array($events, $total);

    }

    /**
     * If a event code is passed in, finds this and updates money on this,
     * otherwise, updates all money accross all events.
     * @param  $eventCode optional.
     * @return void
     */
    public function updateMoneyRaised($eventCode = null)
    {

        if ($eventCode != null)
        {
            //find one events money raised - can also call the event directly.
            $event = $this->findOneByCode($eventCode);
            $event->updateMoneyRaised();
        }
        else
        {
            //find all the events, and update money raised for all.
            $events = $this->findAll();

            foreach($events as $event)
            {
                $event->updateMoneyRaised();
            }
        }
    }
}