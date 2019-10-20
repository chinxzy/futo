<?php 
     session_start();
     require_once 'Dependencies.php';
     header("Content-Type: application/json; charset=UTF-8");
     $Instruction = json_decode($_POST["x"], false);
?>