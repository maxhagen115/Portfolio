<?php
if ($_SESSION['id']) {
    require 'php/dbh.php';
    $active = 'home';

    if (isset($_SESSION['success_melding'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_melding'] . '</div>';
        $_SESSION['success_melding'] = null;
    }
    if (isset($_SESSION['error_melding'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_melding'] . '</div>';
        $_SESSION['error_melding'] = null;
    }

?>

<?php } else {
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>


