<?php
if ($_SESSION['id']) {
    require 'php/dbh.php';
    $order_id = $_POST['order_id'];
    $query = $PDO->prepare("SELECT s.id, s.user_id, s.order_date, s.total_order_price, s.status_id, u.name, st.status_name
                        FROM orders s
                        INNER JOIN users u ON s.user_id = u.id
                        INNER JOIN status st ON s.status_id = st.id
                        WHERE s.id = $order_id");
    $query->execute();
    $row = $query->fetch();

    $producten_query = $PDO->prepare("SELECT *,p.product_name  
                                  FROM order_products
                                  INNER JOIN products p ON order_products.product_id = p.product_id
                                  WHERE order_id = $order_id");
    $producten_query->execute();

    if ($row['status_name'] == 'niet betaald') {
        $status = '<a style="color:red"> niet betaald</a>';
        $paybutton = '<form action="index.php?page=Bestellingbetalen" method="POST">
        <div class="form-group">
            <input type="hidden" name="order_id" value=' . $row['id'] . '>
            <input type="submit" class="btn btn-info" value="Betaal hier">
        </div>
    </form>';
    } elseif (($row['status_name'] == 'betaald')) {
        $status = '<a style="color:green"> betaald</a>';
        $paybutton = '';
    }

?>

    <div class="card" style="width: 33rem; padding: 10px; left: 720px; top:50px;">
        <div class="card-body">
            <h5 class="card-title">Bestelling nummer: <?= $row['id'] ?></h5>
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <p class="card-text">Gebruiker naam: <?= $row['name'] ?></p>
            <?php } ?>

            <p class="card-text">Bestelling geplaatst op: <?= $row['order_date'] ?></p>
            <p class="card-text">Totale bestelling prijs: €<?= $row['total_order_price'] ?></p>
            <p class="card-text">Bestelling Status:<?= $status ?></p>
            <?= $paybutton ?>
        </div>
    </div>
    <br><br><br><br>
    <div class="card" style="width: 11rem; left:880px;">
        <div class="card-body">
            Producten besteld
        </div>
    </div>
    <br>
    <?php while ($producten = $producten_query->fetch()) : ?>
        <div class="card" style="width: 55rem; left: 540px;">
            <div class="card-body">
                <div class="grid-container" style="border:0px; width: 700px; grid-template-columns: 350px 100px 200px;">
                    <div>
                        <h4>product naam: <?= $producten['product_name'] ?></h4>
                    </div>
                    <div>
                        <p>Aantal: <?= $producten['amount'] ?></p>
                    </div>
                    <div>
                        <p>Gekocht voor Prijs: €<?= $producten['price'] ?></p>
                    </div>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                </div>
            </div>
        </div>
        <br>
    <?php endwhile; ?>

<?php } else {
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>