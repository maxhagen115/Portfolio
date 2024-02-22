<?php
session_start();
include  'dbh.php';
if (isset($_POST['register-submit'])) {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $pwd = $_POST['wachtwoord'];

    $stmtRegister = $PDO->prepare("SELECT * FROM users WHERE email = :email");
    $stmtRegister->execute(array(
        ':email' => $email,
    ));

    if ($stmtRegister->rowCount() == 0) {

        $wachtwoord = password_hash($pwd, PASSWORD_DEFAULT);
        $stmtRegister = $PDO->prepare("INSERT into users (name, email, password) values (:name, :email, :password)");
        $stmtRegister->execute(array(
            'name' => $naam,
            'email' => $email,
            'password' => $wachtwoord,
        ));
        $_SESSION['success_melding'] = 'Geregistreerd. log nu in.';
        header("location: ../index.php?page=login");
    } else {

        $_SESSION['error_melding'] = 'deze gebruiker bestaat al';
        header("location: ../index.php?page=register");
    }
}
?>