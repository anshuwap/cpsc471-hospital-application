<?php

class PatientController extends Zend_Controller_Action {
    

    public function indexAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        //user rents
        $rent = new Default_Model_Rent();
        $this->view->userRents= $rent->userRents($sessionUser->PatientId);
        
        //user meal plan
        $mealPlan = new Default_Model_MealPlan();
        $this->view->userMealPlan = $mealPlan->findMealPlan($sessionUser->MealId);
        
        //user prefered doctor
        $doctor = new Default_Model_User;
        $this->view->PreferedDoctor = $doctor->findUser($sessionUser->PreferedDoctor);
        
    }
    
    public function viewmealplanAction() {
        
        $mealPlan = new Default_Model_MealPlan();
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        
        //Show the user meal plan
        $this->view->userMealPlan = $mealPlan->findMealPlan($sessionUser->MealId);
        
        //Show all meal plans
        $mealPlan = new Default_Model_MealPlan();
        $this->view->mealPlans = $mealPlan->mealPlans();
    }
    
    public function changemealplanAction() {
        
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        
        $newMealId = $this->_request->getParam('mealid');
        $longterm = new Default_Model_LongTermPatient();
        $longterm->changeMealPlan($sessionUser->PatientId, $newMealId);
        
        $sessionUser->MealId = $newMealId;
        
        $this->_helper->redirector('viewmealplan', 'patient');
           
    }
    
    public function viewrentalAction() {
        
        $book = new Default_Model_Book;
        $dvd = new Default_Model_DVD;
        
        $this->view->books = $book->findAll();
        $this->view->dvds = $dvd->findAll();

    }
    
    public function rentAction() {
        $sessionUser = new Zend_Session_Namespace('sessionUser');
        
        $rentalId = $this->_request->getParam('rentalid');
        $this->view->Name = $this->_request->getParam('rentalname');
        $this->view->Type = $this->_request->getParam('rentaltype');
        Zend_Loader::loadClass('FormRent');
        $form = new FormRent();
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $beginDate = $form->getValue('BeginDate');
                $endDate = $form->getValue('EndDate');
                
                $rent = new Default_Model_Rent();
                $Error = null;
                //On vérifie si le chauffeur est libre
                $res = $rent->rentIsPossible($rentalId, $beginDate, $endDate);
                foreach ($res as $tmp) {
                    $Error = 'The '.$this->view->Type." ".$this->view->Name." is not free";
                }
                
                if ($Error != null) {
                    echo "<script type=\"text/javascript\">alert('Impossible: " . $Error . "');</script>";
                } else {
                    $rent->addRent($rentalId, $sessionUser->PatientId, $beginDate, $endDate);
                    $this->_helper->redirector('index', 'patient');
                }
            }
        }
    }
    
}
    
?>
