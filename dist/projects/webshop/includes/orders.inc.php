<?php
if ($_SESSION['id']) {
    if ($_SESSION['role'] == "admin") {
        require 'php/dbh.php';

        $query = $PDO->prepare("SELECT s.id, s.user_id, u.name, s.order_date, s.total_order_price, st.status_name FROM orders s
                        INNER JOIN users u ON s.user_id = u.id
                        INNER JOIN status st ON s.status_id = st.id");
        $query->execute();

        while ($row = $query->fetch()) :

            if ($row['status_name'] == 'niet betaald') {
                $status = '<p style="color:red">niet betaald</p>';
            } elseif (($row['status_name'] == 'betaald')) {
                $status = '<p style="color:green">betaald</p>';
            }
?>
            <div class="card" style="width: 33rem; padding: 10px; left: 720px; top:50px;">
                <div class="card-body">
                    <h5 class="card-title">Bestelling nummer: <?= $row['id'] ?></h5>
                    <p class="card-text">Gebruiker naam: <?= $row['name'] ?></p>
                    <p class="card-text">Bestelling geplaatst op: <?= $row['order_date'] ?></p>
                    <p class="card-text">Totale bestelling prijs: €<?= $row['total_order_price'] ?></p>
                    <p class="card-text">Bestelling Status:<?= $status ?></p>
                    <form action="index.php?page=order" method="post">
                        <div class="form-group">
                            <input type="hidden" name="order_id" value=<?= $row['id'] ?>>
                            <input type="submit" class="btn btn-info" value="Bekijk bestelling">
                        </div>
                    </form>
                </div>
            </div>
            <br>
        <?php endwhile; ?>
    <?php } else { ?>
        <center>U heeft geen toegang voor deze pagina</center>
    <?php } ?>

<?php } else {
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>