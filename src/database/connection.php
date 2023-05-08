<?php

use ES_DataVault\Logger\Level;

global $dbconfig, $Logger_db;
$db = new mysqli($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['database'], $dbconfig['port']);
if(!$db->connect_error){
    $Logger_db->log_message('Cannot connect to database.', Level::ERROR, 'database');
    $Logger_db->log_message('Connect failed reason: '. $db->connect_error, Level::DEBUG, 'database');
}