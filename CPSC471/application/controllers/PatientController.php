<?php

class PatientController extends Zend_Controller_Action {
    

    public function indexAction() {
        $this->_helper->redirector('index', 'index');
    }
    
    public function rentAction() {
        
    }
}
    
?>
