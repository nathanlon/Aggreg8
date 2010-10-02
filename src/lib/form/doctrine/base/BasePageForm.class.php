<?php

/**
 * Page form base class.
 *
 * @method Page getObject() Returns the current form's model object
 *
 * @package    aggreg8
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'just_giving_page_code' => new sfWidgetFormInputText(),
      'charity_code'          => new sfWidgetFormInputText(),
      'charity_name'          => new sfWidgetFormInputText(),
      'money_raised'          => new sfWidgetFormInputText(),
      'just_giving_event_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('JustGivingEvent'), 'add_empty' => true)),
      'user'                  => new sfWidgetFormInputText(),
      'target_amount'         => new sfWidgetFormInputText(),
      'short_name'            => new sfWidgetFormInputText(),
      'title'                 => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'just_giving_page_code' => new sfValidatorPass(array('required' => false)),
      'charity_code'          => new sfValidatorPass(array('required' => false)),
      'charity_name'          => new sfValidatorPass(array('required' => false)),
      'money_raised'          => new sfValidatorNumber(array('required' => false)),
      'just_giving_event_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('JustGivingEvent'), 'required' => false)),
      'user'                  => new sfValidatorPass(array('required' => false)),
      'target_amount'         => new sfValidatorNumber(array('required' => false)),
      'short_name'            => new sfValidatorPass(array('required' => false)),
      'title'                 => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('page[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Page';
  }

}
