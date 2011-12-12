<?php


class FormRent extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('rent');

        $day = new Zend_Date(null, Zend_Date::ISO_8601);
        $BeginDate = new Zend_Form_Element_Text('BeginDate');
        $BeginDate ->setLabel('From :');
        $BeginDate->setrequired(true);
        $BeginDate->setValue($day->toString('YYYY-MM-dd'));
        $BeginDate->addValidator('Date', 'YYYY-MM-DD',array('messages' => 'The format of the date is YYYY-MM-DD'));
        
        $EndDate = new Zend_Form_Element_Text('EndDate');
        $EndDate ->setLabel('To :');
        $EndDate->setrequired(true);
        $EndDate->addValidator('Date', 'YYYY-MM-DD',array('messages' => 'The format of the date is YYYY-MM-DD'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Rent');
        $this->addElements(array($BeginDate, $EndDate, $submit));
        
    }
}

?>
