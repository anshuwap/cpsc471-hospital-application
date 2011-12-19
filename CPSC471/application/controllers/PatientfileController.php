<?php


class PatientfileController extends Zend_Controller_Action {
    

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
    
    public function editpatientfileAction() {
        
        $patientId = $this->_request->getParam('patientid');
        $doctorId = $this->_request->getParam('doctorid');
        $date = $this->_request->getParam('date');
        
        $patient = new Default_Model_Patient();
        $ourPatient = $patient->findPatientWithId($patientId);
        
        $user = new Default_Model_User();
        $ourDoctor = $user->findUser($doctorId);
        
        $patientFile = new Default_Model_PatientFile();
        $ourPatientFile = $patientFile->findAPatientFile($patientId, $doctorId, $date);
        
        Zend_Loader::loadClass('FormEditpatientfile');
         
        $form = new FormEditpatientfile($ourPatient->LName." ".$ourPatient->FName
                , $ourDoctor->LName." ".$ourDoctor->FName, $date, $ourPatientFile->LenghtOfVisit
                , $ourPatientFile->TypeOfVisit, $ourPatientFile->Description
                , $ourPatientFile->DoctorNotes);
        $this->view->form = $form;
        if ($this->_request->isPost()) {
           $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
               $patientFile->editAPatientFile($patientId, $doctorId, $date,
                       $form->getValue('date'), $form->getValue('length'),
                       $form->getValue('type'), $form->getValue('desc'),
                       $form->getValue('notes'));
               $this->_helper->redirector('browsepatientfile', 'patientfile');
            }
            
        }  
             
    }
    
    public function createpatientfileAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        $patientfile = new Default_Model_PatientFile();
        
        Zend_Loader::loadClass('FormCreatepatientfile');      
        $form = new FormCreatepatientfile();
        $this->view->form = $form;
         if ($this->_request->isPost()) {
           $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $patientfile->createAPatientFile( $form->getValue('patient'), $sessionUser->UserId,
                       $form->getValue('date'), $form->getValue('length'),
                       $form->getValue('type'), $form->getValue('desc'),
                       $form->getValue('notes'));
                $this->_helper->redirector('browsepatientfile', 'patientfile');
            }
         }
         
    }
}

?>
