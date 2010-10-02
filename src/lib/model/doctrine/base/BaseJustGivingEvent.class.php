<?php

/**
 * BaseJustGivingEvent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property varchar $jg_event_code
 * @property integer $event_id
 * @property Event $Event
 * @property Doctrine_Collection $Page
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method varchar             getJgEventCode()   Returns the current record's "jg_event_code" value
 * @method integer             getEventId()       Returns the current record's "event_id" value
 * @method Event               getEvent()         Returns the current record's "Event" value
 * @method Doctrine_Collection getPage()          Returns the current record's "Page" collection
 * @method JustGivingEvent     setId()            Sets the current record's "id" value
 * @method JustGivingEvent     setJgEventCode()   Sets the current record's "jg_event_code" value
 * @method JustGivingEvent     setEventId()       Sets the current record's "event_id" value
 * @method JustGivingEvent     setEvent()         Sets the current record's "Event" value
 * @method JustGivingEvent     setPage()          Sets the current record's "Page" collection
 * 
 * @package    aggreg8
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJustGivingEvent extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('just_giving_event');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('jg_event_code', 'varchar', 20, array(
             'type' => 'varchar',
             'length' => 20,
             ));
        $this->hasColumn('event_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Event', array(
             'local' => 'event_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Page', array(
             'local' => 'id',
             'foreign' => 'just_giving_event_id'));
    }
}