<?php
session_start();

include 'dbh.php';

$sql = "DELETE FROM users WHERE id = :gebruiker_id";
$query = $PDO->prepare($sql);
$query->bindParam(':gebruiker_id', $_POST['gebruiker_id']);
$query->execute();

header('location: ../index.php?page=gebruikers');
