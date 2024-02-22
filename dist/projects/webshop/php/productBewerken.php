<?php
session_start();

require 'dbh.php';

$p_id = $_POST['productid'];
$p_naam = $_POST['product_naam'];
$p_beschrijving = $_POST['product_beschrijving'];
$p_prijs = $_POST['product_prijs'];

$query = $PDO->prepare("UPDATE products SET product_name = '$p_naam', product_description = '$p_beschrijving', product_price = '$p_prijs' WHERE product_id = $p_id");
$query->execute();

$_SESSION['success_melding'] = 'Product is bewerkt';
header('location: ../index.php?page=producten');

?>