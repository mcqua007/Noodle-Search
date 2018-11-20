<?php
ob_start();  //output bufering only execute when done loading or something?


try {
    $con = new PDO("mysql:dbname=noodle;host=localhost", "root", "root");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //set the error mode to error mode warning
} catch (PDOException $e) {
    echo"Connection failed: ". $e->getMessage();
}
