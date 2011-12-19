<?php


class ScheduleController extends Zend_Controller_Action {
    

    public function indexAction() {          
    }
    
    public function viewscheduleAction() {    
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        
        $id = $this->_request->getParam('doctorid');
        
        if ( $id ==null ) {
            $doctorId = $sessionUser->UserId;
        } else {
            $doctorId = $id;
        }
        
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

        $Heure[0] = '08:00:00';
        $Heure[1] = '09:00:00';
        $Heure[2] = '10:00:00';
        $Heure[3] = '11:00:00';
        $Heure[4] = '12:00:00';
        $Heure[5] = '13:00:00';
        $Heure[6] = '14:00:00';
        $Heure[7] = '15:00:00';
        $Heure[8] = '16:00:00';
        $Heure[9] = '17:00:00';
        $Heure[10] = '18:00:00';
        $Heure[11] = '19:00:00';
        $Heure[12] = '20:00:00';
        $Heure[13] = '21:00:00';
        $Heure[14] = '22:00:00';
        $Heure[15] = '23:00:00';
       


        $schedule= new Default_Model_schedule();
        $list = $schedule->ListDate($date, $doctorId);
        
        $patientmodel = new Default_Model_Patient();

        $patient = array();
        $patientName = array();
        $nbrPatient = 0;

        foreach ($list as $temp) :
            if (!in_array($temp->PatientId, $patient)) {
                $patient[] = $temp->PatientId;
                
                $patienttemp = $patientmodel->findPatientWithId($temp->PatientId);
                $patientName[] = $patienttemp->LName." ".$patienttemp->FName;
                $nbrPatient = $nbrPatient + 1;
            }
        endforeach;
        
        
        $res = array();

        for ($i = 0; $i < $nbrPatient; $i = $i + 1) {
            for ($j = 0; $j < 16; $j = $j + 1) {
                $H = $Heure[$j];
                $res[$i][$j] = $schedule->Allocation($doctorId, $patient[$i], $date, $H);
            }
        }
       
        
        $this->view->line = $nbrPatient;
        $this->view->patient = $patient;
        $this->view->patientname = $patientName;
        $this->view->date = $date;
        $this->view->tab = $res;

    }
    
    public function viewappointmentAction() {  
        $ScheduleId = $this->_request->getParam('Sid');
        
        $schedule = new Default_Model_Schedule();
        $res = $schedule->findAAppointment($ScheduleId);
        
        $this->view->app = $res;
    }
    
}
?>
