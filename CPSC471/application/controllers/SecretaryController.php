<?php

class SecretaryController extends Zend_Controller_Action {
    
    public function indexAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        
        $secretarymodel = new Default_Model_Secretary();
        $secretary = $secretarymodel->findASecretary($sessionUser->UserId);
         
        $this->view->secretary = $secretary;
                
        $alertsmodel = new Default_Model_Alert();
        $lastalerts = $alertsmodel->findLastReceivedAlerts($sessionUser->UserId);
         
        $this->view->lastalerts = $lastalerts;    
    }
	
	public function userAction(){
		
	}
	public function appointmentAction(){
		
	}
	public function addsecretaryAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
	
		$user = new Default_Model_User();
		Zend_Loader::loadClass('FormAddSecretary');


		$form = new FormAddSecretary();
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$pwd = $form->getValue("pwd");
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$section = $form->getValue('section');
				$jobtitle = $form->getValue('jobtitle');
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($section == "" or $section == "N/A")
					$section = NULL;
				if ($jobtitle == "" or $jobtitle == "N/A")
					$jobtitle = NULL;
				$user->addSecretary($pwd, $fname, $lname, $address, $phone, $section, $jobtitle);
				$sessionUser->successMessage = "User Added Successfully!";
				$this->_helper->redirector('user', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Adding User";
			}
		}
	}
	public function adddoctorAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
	
		$user = new Default_Model_User();
		Zend_Loader::loadClass('FormAddDoctor');

		$form = new FormAddDoctor();
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$pwd = $form->getValue("pwd");
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$section = $form->getValue('section');
				$add_specialty = $form->getValue('addspecialty');
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($section == "" || $section == "N/A")
					$section = NULL;
				if ($add_specialty == "" || $add_specialty == "N/A")
					$add_specialty = NULL;
				$user->addDoctor($pwd, $fname, $lname, $address, $phone, $section, $add_specialty);
				$sessionUser->successMessage = "User Added Successfully!";
				$this->_helper->redirector('user', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Adding User";
			}
		}
	}
	public function adduserpatientAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		$user = new Default_Model_User();
		Zend_Loader::loadClass('FormAddUserPatient');

		$form = new FormAddUserPatient();
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$pwd = $form->getValue("pwd");
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$pdoc = $form->getValue('pdoc');
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($pdoc == "" or $pdoc == "N/A")
					$pdoc = NULL;
				$user->addUserPatient($pwd, $fname, $lname, $address, $phone, $pdoc);
				$sessionUser->successMessage = "User Added Successfully!";
				$this->_helper->redirector('user', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Adding User";
			}
		}
	}
	public function editsecretaryAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		$userid = $this->_request->getParam('userid');
                
		$user = new Default_Model_User();
		Zend_Loader::loadClass('FormEditSecretary');
		$p = $user->findSecretaryWithId($userid);
		$this->view->userid = $userid;
		$form = new FormEditSecretary($userid, $p->FName, $p->LName, $p->Adress, $p->PhoneNumber, $p->Section, $p->JobTitle);
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$pwd = $form->getValue("pwd_sec");
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$section = $form->getValue('section');
				$jobtitle = $form->getValue('jobtitle');
				if ($pwd == "N/A" || $pwd == "")
					$pwd = NULL;
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($section == "" or $section == "N/A")
					$section = NULL;
				if ($jobtitle == "" or $jobtitle == "N/A")
					$jobtitle = NULL;
				$user->editSecretary($userid, $pwd, $fname, $lname, $address, $phone, $section, $jobtitle);
				$sessionUser->successMessage = "User Edited Successfully!";
				$this->_helper->redirector('user', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Editing User";
			}
		}
	}
	public function editdoctorAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		$userid = $this->_request->getParam('userid');
		$user = new Default_Model_User();
		Zend_Loader::loadClass('FormEditDoctor');
		$p1 = $user->findDoctorWithId($userid);
		$p = $p1[0];
		
		$this->view->userid = $userid;
		$form = new FormEditDoctor($userid, $p->FName, $p->LName, $p->Adress, $p->PhoneNumber, $p->Section, $p1[1]);
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$pwd = $form->getValue("pwd");
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$section = $form->getValue('section');
				$del_specialty = $form->getValue('specialty');
				$add_specialty = $form->getValue('addspecialty');
				if ($pwd == "N/A" || $pwd == "")
					$pwd = NULL;
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($section == "" or $section == "N/A")
					$section = NULL;
				if ($add_specialty == "" or $add_specialty == "N/A")
					$add_specialty = NULL;
				$user->editDoctor($userid, $pwd, $fname, $lname, $address, $phone, $section, $del_specialty, $add_specialty);
				$sessionUser->successMessage = "User Edited Successfully";
				$this->_helper->redirector('user', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Editing User";
			}
		}
	}
	public function edituserpatientAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		$userid = $this->_request->getParam('userid');
		$user = new Default_Model_User();
		Zend_Loader::loadClass('FormEditUserPatient');
		$p = $user->findUserPatientWithId($userid);
       
		$this->view->userid = $userid;
     
		$form = new FormEditUserPatient($userid, $p->FName, $p->LName, $p->Adress, $p->PhoneNumber, $p->PreferedDoctor);
		$this->view->form = $form;
		$this->view->errorMessage = "";
		if($this->_request->isPost()){
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)){
				$pwd = $form->getValue("pwd");
				$fname = $form->getValue('fname');
				$lname = $form->getValue('lname');
				$address = $form->getValue('address');
				$phone = $form->getValue('phone');
				$pdoc = $form->getValue('pdoc');
				if ($pwd == "N/A" || $pwd == "")
					$pwd = NULL;
				if ($address == "N/A" || $address == "")
					$address = NULL;
				if($phone == "N/A" || $phone == "")
					$phone = NULL;
				if ($pdoc == "" or $pdoc == "N/A")
					$pdoc = NULL;
				$user->editUserPatient($userid, $pwd, $fname, $lname, $address, $phone, $pdoc);
				$sessionUser->successMessage = "User Edited Successfully!";
				$this->_helper->redirector('user', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Editing User";
			}
		}
	}
	
	public function deleteuserpatientAction(){
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		$patient = new Default_Model_Patient();
		$patientid = $this->_request->getParam('userid');
		$patient->deletePatient($patientid);
		$sessionUser->successMessage = "User Deleted Successfully!";
		$this->_helper->redirector('user', 'secretary');
	}
	public function searchsecretaryAction(){
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
                $this->view->allusers= $users->findUserWithName($fname, $lname);
            }
        } else {
            $this->view->allusers = $users->findAllUsers();
        }
	}
	public function searchdoctorAction()
	{
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
                $this->view->allusers= $users->findUserWithName($fname, $lname);
            }
        } else {
            $this->view->allusers = $users->findAllUsers();
        }
	}
	public function searchuserpatientAction(){
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
                $this->view->allusers= $users->findUserWithName($fname, $lname);
            }
        } else {
            $this->view->allusers = $users->findAllUsers();
        }
	
	}
	/****************************************************
	 * Defines all the patient actions
	 * 
	 ********************************************************/
	public function patientAction(){
		
	}
	public function deletepatientAction(){
		
		$sessionUser = new Zend_Session_Namespace('sessionUser');
		$patient = new Default_Model_Patient();
		$patientid = $this->_request->getParam('patientid');
		$patient->deletePatient($patientid);
		$sessionUser->successMessage = "Patient Deleted Successfully!";
		$this->_helper->redirector('patient', 'secretary');
		
		
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
				$sessionUser->successMessage = "Patient Added Successfully!";
				$this->_helper->redirector('patient', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Adding Patient";
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
				$sessionUser->successMessage = "Patient Edited Successfully!";
				$this->_helper->redirector('patient', 'secretary');
			}
			else
			{
				$this->view->errorMessage = "Error Editing Patient";
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
        
        public function mealplanAction() {
            
        //Show all meal plans
        $mealPlan = new Default_Model_MealPlan();
        $this->view->mealPlans = $mealPlan->mealPlans();
        }
        
        public function editmealplanAction() {
        $mealid = $this->_request->getParam('mealid');
            
        $mealplan = new Default_Model_MealPlan();
        Zend_Loader::loadClass('FormMealPlan');
        
        $m = $mealplan->findMealPlan($mealid);
        
        $form = new FormMealPlan($m);
        
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $type = $form->getValue('type');
                $sunday = $form->getValue('sunday');
                $monday = $form->getValue('monday');
                $tuesday = $form->getValue('tuesday');
                $wednesday = $form->getValue('wednesday');
                $thursday = $form->getValue('thursday');
                $friday = $form->getValue('friday');
                $saturday = $form->getValue('saturday');
                
                $mealplan->editMealPlan($mealid, $type, $sunday, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday);
                $this->_helper->redirector('mealplan', 'secretary');
            }
          }            
        }
        
        public function createmealplanAction() {
        Zend_Loader::loadClass('FormMealPlan');
        $mealplan = new Default_Model_MealPlan();
        
        $form = new FormMealPlan();
        
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $type = $form->getValue('type');
                $sunday = $form->getValue('sunday');
                $monday = $form->getValue('monday');
                $tuesday = $form->getValue('tuesday');
                $wednesday = $form->getValue('wednesday');
                $thursday = $form->getValue('thursday');
                $friday = $form->getValue('friday');
                $saturday = $form->getValue('saturday');
                
                $mealplan->createMealPlan($type, $sunday, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday);
                $this->_helper->redirector('mealplan', 'secretary');
            }
          }    
            
        }
        
        public function deletemealplanAction() {
            
             $mealid = $this->_request->getParam('mealid');
             $mealplan = new Default_Model_MealPlan();
             
             $res = $mealplan->deleteMealPlan($mealid);
             
             $this->_helper->redirector('mealplan', 'secretary');
        }
   
    
        public function doctorAction() {
            $doctormodel = new Default_Model_Doctor();
            $doctors = $doctormodel->findAllDoctor();
            
            $this->view->doctors = $doctors;
        }
}
    
?>
