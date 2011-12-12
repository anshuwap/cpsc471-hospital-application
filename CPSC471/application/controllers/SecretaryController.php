<?php

class SecretaryController extends Zend_Controller_Action {
    
    public function indexAction() {
    
    }
	public function patientAction(){
		
	}
	public function deletepatientAction(){
		
	}
    public function addpatientAction(){
    	$sessionUser = new Zend_Session_Namespace('sessionUser');
		$patient = new Default_Model_Patient();
		Zend_Loader::loadClass('FormAddPatient');
		
		$form = new FormAddPatient();
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$pdoc = $form->getValue('pdoc');
				$ptype = $form->getValue('ptype');
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($pdoc == "" or $pdoc == "N/A")
					$pdoc = NULL;
				$patient->addPatient($fname, $lname, $address, $phone, $pdoc, $ptype);
				$sessionUser->successMessage = "User Added Successfully!";
				$this->_helper->redirector('patient', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Adding User";
			}
		}
	}
	public function editpatientAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		$patientid = $this->_request->getParam('patientid');
		$patient = new Default_Model_Patient();
		Zend_Loader::loadClass('FormEditPatient');
		$p = $patient->findPatientWithId($patientid);
		$this->view->patientid = $patientid;
		$form = new FormEditPatient($patientid, $p->FName, $p->LName, $p->Adress, $p->PhoneNumber, $p->PreferedDoctor, $p->PatientType);
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$pdoc = $form->getValue('pdoc');
				$ptype = $form->getValue('ptype');
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($pdoc == "" or $pdoc == "N/A")
					$pdoc = NULL;
				$patient->editPatient($patientid, $fname, $lname, $address, $phone, $pdoc, $ptype);
				$sessionUser->successMessage = "User Edited Successfully!";
				$this->_helper->redirector('patient', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Editing User";
			}
		}
	}
	public function searchpatientAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		

        $patients = new Default_Model_Patient();
        $this->view->allpatients = null;

        Zend_Loader::loadClass('FormSearchuser');
        $form = new FormSearchuser();
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $lname = $form->getValue('LName');
                $fname = $form->getValue('FName');
                $this->view->allpatients = $patients->findPatientWithName($fname, $lname);
            }
        } else {
            $this->view->allpatients = $patients->findAllPatients();
        }
	}
   
    
    
}
    
?>
