<?php

/**
 * Page filter form base class.
 *
 * @package    aggreg8
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'just_giving_page_code' => new sfWidgetFormFilterInput(),
      'charity_code'          => new sfWidgetFormFilterInput(),
      'charity_name'          => new sfWidgetFormFilterInput(),
      'money_raised'          => new sfWidgetFormFilterInput(),
      'just_giving_event_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('JustGivingEvent'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'just_giving_page_code' => new sfValidatorPass(array('required' => false)),
      'charity_code'          => new sfValidatorPass(array('required' => false)),
      'charity_name'          => new sfValidatorPass(array('required' => false)),
      'money_raised'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'just_giving_event_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('JustGivingEvent'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('page_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Page';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'just_giving_page_code' => 'Text',
      'charity_code'          => 'Text',
      'charity_name'          => 'Text',
      'money_raised'          => 'Number',
      'just_giving_event_id'  => 'ForeignKey',
    );
  }
}
