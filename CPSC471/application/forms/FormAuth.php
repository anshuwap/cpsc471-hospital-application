<?php
class FormAuth extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('auth');

        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login :');
        $login->setrequired(true);

        $pwd = new Zend_Form_Element_Password('pwd');
        $pwd->setLabel('Password :');
        $pwd->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Sign In');
        $this->addElements(array($login, $pwd, $submit));
        
    }

}
?>