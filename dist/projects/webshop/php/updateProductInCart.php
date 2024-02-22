<?php
session_start();

include 'dbh.php';
$user_id = $_POST['user_id'];

foreach($_POST['product'] as $pid => $hoeveelheid) {
    $sql = 'UPDATE user_cart SET amount = :amount WHERE user_id= :user_id AND id= :id';

    $sth = $PDO->prepare($sql);
    $sth->execute(array(
        ':amount' => $hoeveelheid,
        ':user_id' => $user_id,
        ':id' => $pid
    ));

}
$_SESSION['success_melding'] = 'Producten zijn bijgewerkt';
header('location: ../index.php?page=winkelmand');

?>