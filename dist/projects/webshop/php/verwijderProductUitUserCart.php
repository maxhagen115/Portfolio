<?php
session_start();

require '../php/dbh.php';

if (isset($_SESSION['id'])) {

$sql = "DELETE FROM user_cart WHERE id = :cart_id AND user_id = :userID";
$sth = $PDO->prepare($sql);
$sth->bindParam(':cart_id', $_GET['removeid']);
$sth->bindParam(':userID', $_SESSION['id']);
$sth->execute();

header('location: ../index.php?page=winkelmand');
}
else { header('location:../index.php?page=login'); }
?>