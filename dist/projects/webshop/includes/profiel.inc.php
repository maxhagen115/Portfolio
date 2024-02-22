<?php
if ($_SESSION['id']) {
    require 'php/dbh.php';
    $user_id = $_SESSION['id'];

    $user_query = $PDO->prepare("SELECT * FROM users WHERE id = $user_id");
    $user_query->execute();
    $user_row = $user_query->fetch();

    $naam = $user_row['name'];

    $query = $PDO->prepare("SELECT s.id, s.user_id, s.order_date, s.total_order_price, s.status_id,
op.id, op.product_id, op.amount, op.order_id, op.price,
p.product_name, st.status_name 
FROM orders s
LEFT JOIN order_products op ON s.id = op.order_id
LEFT JOIN products p ON op.product_id = p.product_id
LEFT JOIN status st ON s.status_id = st.id
WHERE user_id = :user_id");
    $query->bindValue(':user_id', $user_id);
    $query->execute();

    if (isset($_SESSION['success_melding'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_melding'] . '</div>';
        $_SESSION['success_melding'] = null;
    }
    if (isset($_SESSION['error_melding'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_melding'] . '</div>';
        $_SESSION['error_melding'] = null;
    }

?>

    <div class="container">
        <div class="row jsutify-content-center">
            <div class="col-8 profiel-container justift-content-center">
                <br>
                <h3>Profiel van <?= $naam ?></h3>
                <br>
                <h4>Gebruikersnaam wijzigen</h4>
                <form action="php/profielGebruikerGegevensWijzigen.php" method="post">
                    <div class="form-group">
                        <p>
                            <label for="titel">Gebruikersnaam:</label>
                            <input class="form-control" type="text" name="gebruiker_naam" value=<?php echo $user_row['name'] ?> id="firstName">
                        </p>
                        <input type="hidden" class="btn btn-info" name="wachtwoord" value=<?= $user_row['password'] ?>>
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
                <form action="php/profielGebruikerGegevensWijzigen.php" method="post">
                    <div class="form-group">
                        <p>
                            <label for="titel">Wachtwoord:</label>
                            <input class="form-control" type="password" name="gebruiker_wachtwoord" id="firstName" required>
                        </p>
                        <input type="hidden" class="btn btn-info" name="gebruiker_naam" value=<?php echo $user_row['name'] ?>>
                        <input type="hidden" class="btn btn-info" name="userid" value=<?= $user_id ?>>
                        <input type="hidden" class="btn btn-info" name="checker" value='gebruiker_wachtwoord'>
                        <br>
                        <input type="submit" class="btn btn-info" value="Wijzig Wachtwoord">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card" style="width: 8rem; left:880px;">
        <div class="card-body">
            Bestellingen
        </div>
    </div>

    <?php if ($query->rowCount() > 0) { ?>

        <?php while ($row = $query->fetch()) : ?>

            <?php
            if ($row['status_name'] == 'niet betaald') {
                $status = '<a style="color:red"> niet betaald</a>';
            } elseif (($row['status_name'] == 'betaald')) {
                $status = '<a style="color:green"> betaald</a>';
            }

            ?>
            <div class="card" style="width: 33rem; padding: 10px; left: 720px; top:50px;">
                <div class="card-body">
                    <h5 class="card-title">Bestelling nummer: <?= $row['order_id'] ?></h5>
                    <p class="card-text">Bestelling geplaatst op: <?= $row['order_date'] ?></p>
                    <p class="card-text">Totale bestelling prijs: €<?= $row['total_order_price'] ?></p>
                    <p class="card-text">Bestelling Status:<?= $status ?></p>
                    <form action="index.php?page=order" method="post">
                        <div class="form-group">
                            <input type="hidden" name="order_id" value=<?= $row['order_id'] ?>>
                            <input type="submit" class="btn btn-info" value="Bekijk bestelling">
                        </div>
                    </form>
                </div>
            </div>
            <br><br><br>
        <?php endwhile; ?>
    <?php } else { ?>
        <br><br><br>
        <center>U heeft geen bestellingen</center>
    <?php } ?>

<?php } else {
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>