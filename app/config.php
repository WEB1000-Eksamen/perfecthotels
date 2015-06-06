<?php

function config () {
    
    $config = array(
        
        "debug" => true,
        "database" => array(
            "username" => "root",
            "password" => "",
            "provider" => "mysql",
            "host" => "localhost",
            "dbname" => "web-is-gr11w"
        )
        
    );
    
    return $config;
}