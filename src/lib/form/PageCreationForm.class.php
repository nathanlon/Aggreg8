<?php

/**
 * Page form.
 *
 * @package    aggreg8
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PageCreationForm extends sfForm
{

  public function configure()
  {
    $this->setWidgets(array(
      'charity_code'          => new sfWidgetFormInputText(),
      'just_giving_event_id'  => new sfWidgetFormInputHidden(),
      'target_amount'         => new sfWidgetFormInputText(),
      'short_name'            => new sfWidgetFormInputText(),
      'title'                 => new sfWidgetFormInputText(array('label'=>'Title')),
      'existing_short_name'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'charity_code'          => new sfValidatorPass(array('required' => false)),
      'just_giving_event_id'  => new sfValidatorPass(array('required' => false)),
      'target_amount'         => new sfValidatorNumber(array('required' => false)),
      'short_name'            => new sfValidatorPass(array('required' => false)),
      'title'                 => new sfValidatorPass(array('required' => false)),
      'existing_short_name'   => new sfValidatorPass(array('required' => false)),
    ));


    $this->widgetSchema->setNameFormat('page[%s]');

  }

    
}
