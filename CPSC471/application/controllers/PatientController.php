<?php

class PatientController extends Zend_Controller_Action {
    

    public function indexAction() {
        $this->_helper->redirector('index', 'index');
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
}
    
?>
