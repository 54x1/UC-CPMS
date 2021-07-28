<?php
/*
 * Database config
 */

/* go here https://www.phpmyadmin.co/ to edit the database
*/
$host = "sql6.freemysqlhosting.net";
$username   = "sql6428004";
$password   = "B17vSF1Agi";
$dbname     = "sql6428004";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

try{
    $pdo_connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>
