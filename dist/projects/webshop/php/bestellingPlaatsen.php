<?php
include 'dbh.php';
session_start();

$pid = $_POST['product_id'];
$hoeveelheid = $_POST['product_amount'];
$price = $_POST['product_price'];
$total = $_POST['total_order_price'];

if (isset($_SESSION['id'])) {

date_default_timezone_set("Europe/Amsterdam");
$order_datum = date("Y-m-d h:i:sa");

$sql = "INSERT INTO orders (user_id, order_date, total_order_price) VALUES (:user_id, :order_date, :total_order_price)";
$sth = $PDO->prepare($sql);
$sth->bindParam(':order_date', $order_datum);
$sth->bindParam(':user_id', $_SESSION['id']);
$sth->bindParam(':total_order_price', $total);
$sth->execute();
$test_id = $PDO->lastInsertId();

$sql = "INSERT INTO order_products (product_id, amount, order_id, price) 
        SELECT user_cart.product_id, amount, :order_id, product_price
        FROM user_cart
            INNER JOIN products
            ON user_cart.product_id = products.product_id
        WHERE user_id = :user_id";

$sth = $PDO->prepare($sql);
$sth->bindParam(':order_id', $test_id );
$sth->bindParam(':user_id', $_SESSION['id'] );
$sth->execute();

$sql = "DELETE FROM user_cart WHERE user_id = :user_id";
$query = $PDO->prepare($sql);
$query->bindParam(':user_id', $_SESSION['id']);
$query->execute();

}

$_SESSION['success_melding'] = 'Bestelling geplaatst. Bestelling Datum: ' . $order_datum . '.' . ' Je kunt je bestelling zien in je profiel pagina.';
header('location: ../index.php?page=betalen');