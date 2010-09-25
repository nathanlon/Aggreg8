<?php

/**
 * Event form.
 *
 * @package    aggreg8
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventForm extends BaseEventForm
{
  public function configure()
  {
  }

    /**
     * Also need to create a JustGivingEvent object, if not already existing.
     * @param  $con
     * @return Event object
     */
    public function save($con = null) {


        $event = parent::save($con);

        //also, create a JustGivingEvent connecting to this.
        $jgEvent = Doctrine_Core::getTable('JustGivingEvent')->findOneByEvent($event->id);

        if ($jgEvent == false)
        {
            $jgEvent = new JustGivingEvent();
            $jgEvent->Event = $event;
            $jgEvent->save();
        }

        return $event;
    }

}
