<?php
    /*
        initialisér php-funksjoner,
                    autoloading etc
    */
    session_start();
    // access to $config variable
    require_once dirname(__FILE__) . '\config.php';
    $config = config();
    
    // additional classes
    require_once dirname(__FILE__) . '\classes\Hash.php';
    require_once dirname(__FILE__) . '\classes\Database.php';