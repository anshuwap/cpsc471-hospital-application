<?php


class ScheduleController extends Zend_Controller_Action {
    

    public function indexAction() {          
    }
    
    public function viewscheduleAction() {    
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        $doctorId = $sessionUser->UserId;
        
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

        $Heure[0] = '00:00:00';
        $Heure[1] = '01:00:00';
        $Heure[2] = '02:00:00';
        $Heure[3] = '03:00:00';
        $Heure[4] = '04:00:00';
        $Heure[5] = '05:00:00';
        $Heure[6] = '06:00:00';
        $Heure[7] = '07:00:00';
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
       


        $schedule= new Default_Model_schedule();
        $list = $schedule->ListDate($date);
        
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
            for ($j = 0; $j < 24; $j = $j + 1) {
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
