<?php
if ($_SESSION['id']) {
    require 'php/dbh.php';

    $query = $PDO->prepare("SELECT * FROM users WHERE role = 'user' ");
    $query->execute();

    if (isset($_SESSION['success_melding'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_melding'] . '</div>';
        $_SESSION['success_melding'] = null;
    }
    if (isset($_SESSION['error_melding'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_melding'] . '</div>';
        $_SESSION['error_melding'] = null;
    }

    while ($row = $query->fetch()) :
?>
        <div style="padding-left: 100px;" class="card">
            <div style="padding:3.25rem;" class="card-body">
                <p>Naam: <?= $row['name'] ?> - Email: <?= $row['email'] ?></p>
                <form action="php/gebruikerVerwijderen.php" method="post">
                    <div class="form-group">
                        <input type="hidden" class="btn btn-info" name="gebruiker_id" value=<?= $row['id'] ?>>
                        <input type="submit" class="btn btn-danger" value="Gebruiker Verwijderen">
                    </div>
                </form>
                <form action="index.php?page=gebruikerBewerken" method="post">
                    <div class="form-group">
                        <input type="hidden" class="btn btn-info" name="gebruiker_id" value=<?= $row['id'] ?>>
                        <input type="submit" class="btn btn-info" value="Gebruiker Bewerken">
                    </div>
                </form>
            </div>
        </div>
    <?php endwhile; ?>

<?php } else {
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>