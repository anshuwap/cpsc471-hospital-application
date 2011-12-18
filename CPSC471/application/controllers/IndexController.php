<?php

/** Index Controller: HomePage and Connection  **/

class IndexController extends Zend_Controller_Action {


    /** Index * */
    public function indexAction() {
        
		
    }


    //User Connexion
    public function loginAction() {

        Zend_Loader::loadClass('FormAuth');
        $form = new FormAuth();
        $this->view->form = $form;
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $login = $form->getValue('login');
                $password = $form->getValue('pwd');
                
                //try to Auth the user
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter ());
                $authAdapter->setTableName('user')
                        ->setIdentityColumn('UserId')
                        ->setCredentialColumn('Pwd')
                        ->setIdentity($login)
                        ->setCredential($password);
                $authAuthenticate = $authAdapter->authenticate();
          
                
                if ($authAuthenticate->isValid()) {
                    //We get the user's informations and we store them 
                    $user = new Default_Model_User();
                    $row = $user->findUser($login);
                    
                    $sessionUser = new Zend_Session_Namespace('sessionUser');
                    $sessionUser->UserId = $login;
                    $sessionUser->FName = $row->FName;
                    $sessionUser->LName = $row->LName;
                    $sessionUser->Adress = $row->Adress;
                    $sessionUser->PhoneNumber = $row->PhoneNumber;
                    $sessionUser->UserType = $row->UserType;
                    
                    if ( strcmp($sessionUser->UserType,'PATIENT') == 0 ) {
                        $patient = new Default_Model_Patient();
                        $row = $patient->findPatient($sessionUser->FName, $sessionUser->LName, $sessionUser->Adress);
                        $sessionUser->PatientId = $row->PatientId;
                        $sessionUser->PreferedDoctor = $row->PreferedDoctor;
                        
                        $longterm = new Default_Model_LongTermPatient();
                        $row = $longterm->findLongTermPatient($sessionUser->PatientId);
                        $sessionUser->MealId = $row->MealId;
                        
                        $this->_helper->redirector('index', 'patient');
                        
                    } else if ( strcmp($sessionUser->UserType,'DOCTOR') == 0 ) {
                        $this->_helper->redirector('index', 'doctor');
                    }

                    $this->_helper->redirector('index', 'index');
                } else {
                    echo ' * User doesn\'t exist or wrong password';
                }
            }
            }
        }


    //To disconnect the user
    public function logoutAction() {

        Zend_Auth::getInstance ()->clearIdentity();
        Zend_Session::destroy();
        $this->_helper->redirector('index', 'index');
    }

}

