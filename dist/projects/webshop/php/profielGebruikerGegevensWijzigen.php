<?php
session_start();
include '../php/dbh.php';


if($_POST['checker'] == 'gebruiker_wachtwoord'){
    $gebruiker_naam = $_POST['gebruiker_naam'];
    $gebruiker_wachtwoord = password_hash($_POST['gebruiker_wachtwoord'], PASSWORD_DEFAULT) ;
    $user_id = $_POST['userid'];

        $query = $PDO->prepare("UPDATE users SET name = '$gebruiker_naam' , password = '$gebruiker_wachtwoord' WHERE id = $user_id");
        $query->execute();
    
        $_SESSION['success_melding'] = 'Wachtwoord gewijzigd';
        header('location: ../index.php?page=profiel');

}elseif($_POST['checker'] == 'gebruiker_naam'){
    $gebruiker_naam = $_POST['gebruiker_naam'];
    $gebruiker_wachtwoord = $_POST['gebruiker_wachtwoord'];
    $user_id = $_POST['userid'];
        $query = $PDO->prepare("UPDATE users SET name = '$gebruiker_naam' , password = '$gebruiker_wachtwoord' WHERE id = $user_id");
        $query->execute();
    
        $_SESSION['success_melding'] = 'Gebruikersnaam gewijzigd';
        header('location: ../index.php?page=profiel');
}
