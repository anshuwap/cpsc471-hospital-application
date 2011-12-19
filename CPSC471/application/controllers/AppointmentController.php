
<?php


class AppointmentController extends Zend_Controller_Action {
    

    public function indexAction() {          
    }
	public function appointmentAction(){
		
	}
	public function patientappointmentAction(){
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
	public function roomappointmentAction(){
		
	}
	public function searchappointmentAction(){
		
	}
	public function doctorappointmentAction() {    
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        
        $id = $this->_request->getParam('patientid');
        
        
        $dateP = $this->_request->getParam('date');
        Zend_Loader::loadClass('FormSearchDate');
        $form = new FormSearchDate();
        
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $date = $form->getValue('Date');
            } else {
                $form->populate($formData);
            }
        } elseif ($dateP == null) {
            date_default_timezone_set('UTC');
            $date = date("Y-m-d"); //Date du jour
        } else {
            $date = $dateP;
        }

      
        $Heure[8] = '08:00:00';
        $Heure[9] = '09:00:00';
        $Heure[10] = '10:00:00';
        $Heure[11] = '11:00:00';
        $Heure[12] = '12:00:00';
        $Heure[13] = '13:00:00';
        $Heure[14] = '14:00:00';
        $Heure[15] = '15:00:00';
        $Heure[16] = '16:00:00';
        $Heure[17] = '17:00:00';
        $Heure[18] = '18:00:00';
        $Heure[19] = '19:00:00';
        $Heure[20] = '20:00:00';
        $Heure[21] = '21:00:00';
        $Heure[22] = '22:00:00';
        $Heure[23] = '23:00:00';
       


        $schedule= new Default_Model_Schedule();
        //$list = $schedule->ListDate($date, $doctorId);
        $patients = new Default_Model_Patient();
		$user = new Default_Model_User();
		$patient = $patients->findPatientWithId($id);
		
        
        $doctormodel = new Default_Model_Doctor();
		$doctors = $user->findAllUsers();
		if($patient->PreferedDoctor == NULL || $patient->PreferedDoctor == "")
			$pdoc = NULL;
			
		else {
			$pdoc = $user->findDoctorWithId($patient->PreferedDoctor);
			$pdoc = $pdoc[0];
		}
		
        $res = array();
		
		foreach($doctors as $d => $value)
		{
			for ($j = 8; $j < 24; $j = $j + 1) {
                $H = $Heure[$j];
                $res[$value->UserId][$j] = $schedule->Allocation2($value->UserId, $date, $H);
            }
		}

       
       
        
        $this->view->allusers = $doctors;
        $this->view->patient = $patient;
		$this->view->pdoc = $pdoc;
        $this->view->date = $date;
        $this->view->tab = $res;

    }
    }
?>