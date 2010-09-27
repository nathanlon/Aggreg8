<?php

/**
 * event actions.
 *
 * @package    aggreg8
 * @subpackage event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends sfActions
{

    public function preExecute() {
        $action = $this->getRequest()->getParameter('action');
        $module = $this->getRequest()->getParameter('module');
        $this->pageName = $module . ucfirst($action);
    }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EventForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EventForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($event = Doctrine::getTable('Event')->find(array($request->getParameter('id'))), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $this->form = new EventForm($event);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));

    $params = $request->getParameter('event');

    $this->forward404Unless($event = Doctrine::getTable('Event')->find(array($params['id'])), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $this->form = new EventForm($event);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->forward404Unless($event = Doctrine::getTable('Event')->find(array($params['id'])), sprintf('Object event does not exist (%s).', $request->getParameter('id')));
    $event->delete();

    $this->redirect('@homepage');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $event = $form->save();

      //$this->redirect('@admin_event_edit?id='.$event->getId());
      $this->redirect('@homepage');
    }
  }
}
