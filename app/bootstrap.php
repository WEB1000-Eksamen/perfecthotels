<?php
    /*
        initialisér php-funksjoner,
                    autoloading etc
    */
    session_start();
    // access to $config variable
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php';
    $config = config();
    
    // additional classes
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Hash.php';
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Database.php';
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'additionals' . DIRECTORY_SEPARATOR . 'PostBookingFn.php';
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'additionals' . DIRECTORY_SEPARATOR . 'GetBookingsFn.php';
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'additionals' . DIRECTORY_SEPARATOR . 'EditBookingsFn.php';