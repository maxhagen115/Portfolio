<?php

$dbsernave = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "webshop";

$conn = "mysql:host=$dbsernave;dbname=$dbname;charset=utf8";
$PDO = new PDO($conn, $dbUsername, $dbPassword);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>