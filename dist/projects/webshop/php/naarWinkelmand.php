<?php
session_start();
include '../php/dbh.php';

if(isset($_SESSION['login'])){

    $sql = "INSERT INTO user_cart (product_id, user_id) VALUES (:product_id, :user_id)";
    $sth = $PDO->prepare($sql);
    $sth->bindParam(':product_id', $_GET['product_id']);
    $sth->bindParam(':user_id', $_SESSION['id']);
    $sth->execute();
    header("location: ../index.php?page=winkelmand");
    
} else{
    $_SESSION['error_melding'] = 'U moet eerst inloggen om iets aan de winkelmand toe te voegen';
    header("location: ../index.php?page=login");
}
?>