<?php
include 'dbh.php';
session_start();

$payment_method = $_POST['payment_method'];
$order_id = $_POST['order_id'];
$user_id = $_SESSION['id'];

if (isset($_SESSION['id'])) {

$sql = "UPDATE orders SET payment_method_id ='$payment_method' WHERE id = $order_id";
$sth = $PDO->prepare($sql);
$sth->execute();

$sql = "UPDATE orders SET status_id = 2 WHERE id = $order_id";
$sth = $PDO->prepare($sql);
$sth->execute();

}

$_SESSION['success_melding'] = 'Bestelling betaald. Je kunt deze terug vinden in uw profiel.';
header('location: ../index.php?page=home');