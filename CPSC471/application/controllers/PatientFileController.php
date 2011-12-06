<?php


class PatientFileController extends Zend_Controller_Action {
    

    public function indexAction() {          
    }
    
    public function browsepatientfileAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        
        $patientFile = new Default_Model_PatientFile();
        $this->view->allfiles = null;

        Zend_Loader::loadClass('FormSearchuser');
        $form = new FormSearchuser();
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $lname = $form->getValue('LName');
                $fname = $form->getValue('FName');
                $this->view->allfiles = $patientFile->findPatientFileWithName($lname, $fname);
            }
        } else {
            $this->view->allfiles = $patientFile->findAllPatientFiles();
        }
    }
}

?>
