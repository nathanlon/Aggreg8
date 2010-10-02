<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    aggreg8
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'code'        => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'total_money' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'        => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'total_money' => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
