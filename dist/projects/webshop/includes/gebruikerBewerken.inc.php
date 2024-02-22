<?php
if ($_SESSION['id']) {
    if ($_SESSION['role'] == "admin") {
        require 'php/dbh.php';
        $user_id = $_POST['gebruiker_id'];
        $query = $PDO->prepare("SELECT * FROM users WHERE id = $user_id");
        $query->execute();

        $row = $query->fetch();
        $naam = $row['name'];
?>

        <div class="container">
            <div class="row jsutify-content-center">
                <div class="col-8 profiel-container justift-content-center">
                    <br>
                    <h4>Gebruikersnaam wijzigen</h4>
                    <form action="php/gebruikerBewerken.php" method="post">
                        <div class="form-group">
                            <p>
                                <label for="titel">Gebruikersnaam:</label>
                                <input class="form-control" type="text" name="gebruiker_naam" value=<?php echo $row['name'] ?> id="firstName">
                            </p>
                            <input type="hidden" class="btn btn-info" name="wachtwoord" value=<?= $row['password'] ?>>
                            <input type="hidden" class="btn btn-info" name="userid" value=<?= $user_id ?>>
                            <input type="hidden" class="btn btn-info" name="checker" value='gebruiker_naam'>
                            <br>
                            <input type="submit" class="btn btn-info" value="Wijzig Naam">
                        </div>
                    </form>
                </div>

                <div class="col-8 profiel-container justift-content-center">
                    <br>
                    <h4>Wachtwoord wijzigen</h4>
                    <form action="php/gebruikerBewerken.php" method="post">
                        <div class="form-group">
                            <p>
                                <label for="titel">Wachtwoord:</label>
                                <input class="form-control" type="password" name="gebruiker_wachtwoord" id="firstName" required>
                            </p>
                            <input type="hidden" class="btn btn-info" name="gebruiker_naam" value=<?php echo $row['name'] ?>>
                            <input type="hidden" class="btn btn-info" name="userid" value=<?= $user_id ?>>
                            <input type="hidden" class="btn btn-info" name="checker" value='gebruiker_wachtwoord'>
                            <br>
                            <input type="submit" class="btn btn-info" value="Wijzig Wachtwoord">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <center>U heeft geen toegang voor deze pagina</center>
    <?php } ?>

<?php } else {
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>