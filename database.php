<?php
ob_start();
session_start();
$servername = "localhost";
$username = "root";
$password = "";

try {
  $db = new PDO("mysql:host=$servername;dbname=getlabs", $username, $password);
  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
