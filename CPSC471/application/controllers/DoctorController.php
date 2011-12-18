<?php

class DoctorController extends Zend_Controller_Action {
    
    public function indexAction() {
         $sessionUser = new Zend_Session_Namespace('sessionUser');
         
         $doctormodel = new Default_Model_Doctor();
         $doctor = $doctormodel->findDoctor($sessionUser->UserId);
         
         $this->view->doctor = $doctor;
         
         $specialitymodel = new Default_Model_Specialty();
         $specialities = $specialitymodel->findAllForADoctor($sessionUser->UserId);
         
         $this->view->specialities = $specialities;
         
         $schedulemodel = new Default_Model_Schedule();
         $nextappointment = $schedulemodel->findNext($sessionUser->UserId);
         
         $this->view->next = $nextappointment;
         
         $alertsmodel = new Default_Model_Alert();
         $lastalerts = $alertsmodel->findLastReceivedAlerts($sessionUser->UserId);
         
         $this->view->lastalerts = $lastalerts;

    }
    
}

?>
