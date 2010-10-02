<?php

/**
 * JustGivingEvent filter form base class.
 *
 * @package    aggreg8
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJustGivingEventFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'jg_event_code' => new sfWidgetFormFilterInput(),
      'event_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'jg_event_code' => new sfValidatorPass(array('required' => false)),
      'event_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Event'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('just_giving_event_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'JustGivingEvent';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'jg_event_code' => 'Text',
      'event_id'      => 'ForeignKey',
    );
  }
}
