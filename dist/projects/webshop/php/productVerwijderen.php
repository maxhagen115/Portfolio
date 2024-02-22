<?php
session_start();

include 'dbh.php';

$sql = "DELETE FROM products WHERE product_id = :product_id";
$query = $PDO->prepare($sql);
$query->bindParam(':product_id', $_POST['product_id']);
$query->execute();

$_SESSION['success_melding'] = 'Product Verwijderd';
header('location: ../index.php?page=producten');
