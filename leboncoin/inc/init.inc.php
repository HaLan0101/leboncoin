<?php
  $pdo = new PDO("mysql:host=localhost;dbname=leboncoin", "root", "" , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

  session_start();
  require_once("inc/fonction.inc.php");


?>