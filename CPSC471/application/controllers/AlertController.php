<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlertController
 *
 * @author pierre
 */
class AlertController extends Zend_Controller_Action {

    public function indexAction() {      
    }

    public function viewreceivedalertsAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');

        $alert = new Default_Model_Alert();
        $this->view->userAlerts = $alert->findReceivedAlerts($sessionUser->UserId);
    }

    public function sendalertAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');

        $receiverId = $this->_request->getParam('receiverid');
        $receiverName = $this->_request->getParam('receivername');

        Zend_Loader::loadClass('FormAlert');
        $form = new FormAlert($receiverName);
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $desc = $form->getValue('desc');

                $alert = new Default_Model_Alert();
                $alert->addAlert($sessionUser->UserId, $receiverId, $desc);

                $this->_helper->redirector('viewreceivedalerts', 'alert');
            }
        }
    }

    public function browseusersAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        $users = new Default_Model_User();
        $this->view->allusers = null;

        Zend_Loader::loadClass('FormSearchuser');
        $form = new FormSearchuser();
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $lname = $form->getValue('LName');
                $fname = $form->getValue('FName');
                $this->view->allusers = $users->findUserWithName($lname, $fname);
            }
        } else {
            $this->view->allusers = $users->findAllUsers();
        }
    }

}

?>
