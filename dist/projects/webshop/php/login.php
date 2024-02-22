<?php
session_start();

include 'dbh.php';

if (isset($_SESSION['success_melding'])) {
  echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_melding'] . '</div>';
  $_SESSION['success_melding'] = null;
}
if (isset($_SESSION['error_melding'])) {
  echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_melding'] . '</div>';
  $_SESSION['error_melding'] = null;
}

if (isset($_POST['login-submit'])) {
  $email = $_POST['email'];
  $wachtwoord = $_POST['wachtwoord'];
  $login_lezen = $PDO->prepare("SELECT name, password, role, id FROM users WHERE email =:email");
  $login_lezen->execute(array(':email' => $email));
  $results = $login_lezen->fetch(PDO::FETCH_ASSOC);

  if (password_verify($wachtwoord, $results['password'])) {

    $_SESSION['login'] = true;
    $_SESSION['role'] = $results['role'];
    $_SESSION['id'] = $results['id'];
    if ($results['role'] == "admin") {
      $_SESSION['success_melding'] = 'Welkom '.ucfirst($results['name']);
      header('location: ../index.php?page=adminHome');
    } else if ($results['role'] == "user") {
      $_SESSION['success_melding'] = 'Welkom '.ucfirst($results['name']);
      header('location: ../index.php?page=home');
    }
  } else {
    $_SESSION['error_melding'] = 'Controleer uw Email en/of Wachtwoord';
    header('location: ../index.php?page=login');
  }
} else {
  $_SESSION['error_melding'] = 'Controleer uw Email en/of Wachtwoord';
  header('location: ../index.php?page=login');
}