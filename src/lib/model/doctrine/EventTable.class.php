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

}