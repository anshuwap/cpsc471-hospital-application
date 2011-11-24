<?php

/**
 * Application bootstrap
 * 
 * @uses    Zend_Application_Bootstrap_Bootstrap
 * @package QuickStart
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    /**
     * Bootstrap autoloader for application resources
     * 
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload() {
        $autoloader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Default',
                    'basePath' => dirname(__FILE__),
                ));

        // Pour que les erreurs s'affichent
        error_reporting(E_ALL | E_STRICT);
        ini_set('display_errors', 1);
        
        // Chargement de la configuration
        $config =
                new Zend_Config_Ini(APPLICATION_PATH . '/configs/dbconfig.ini', 'general');
        $registry = Zend_Registry::getInstance();
        $registry->set('config', $config);
        // Mise en place de la BDD
        $db = Zend_Db::factory($config->db);
        Zend_Db_Table::setDefaultAdapter($db);


        return $autoloader;
    }

    /**
     * Bootstrap the view doctype
     * 
     * @return void
     */
    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    protected function _initSession()
    {
            Zend_Session::start();
            $sessionUser = new Zend_Session_Namespace('sessionUser');
    }

}
