<?php
if ($_SESSION['id']) {
include 'php/dbh.php';

$total = 0;
$teller = 0;

$sql = 'SELECT c.id, c.product_id, c.amount, p.product_name, p.product_price FROM user_cart c
        INNER JOIN products p ON c.product_id = p.product_id  WHERE user_id = :user_id';

$sth = $PDO->prepare($sql);
$sth->bindParam(':user_id', $_SESSION['id']);
$sth->execute();
$row = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach ($row as $value) {
    $price = $value['product_price'] * $value['amount'];
    $total += $price;
}

?>

<div class="bestelling">
    <h1>overzicht bestelling</h1>
    <?php if (isset($_SESSION['login'])) : ?>
        <?php foreach ($row as $userinfo) {    ?>
                <div class="grid-container" style="width: 600px; grid-template-columns: 330px 50px 59px 100px;">
                    <div style="text-align:left">
                        <h4><?php echo $userinfo['product_name']; ?></h4>
                    </div>
                    <div>
                        <p>Aantal:</p>
                    </div>
                    <div>
                        <p><?php echo $userinfo['amount'] ?></p>
                    </div>
                    <div>
                        <p>Prijs:€<?php echo $userinfo['product_price']; ?></p>
                    </div>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                </div>
        <?php    }    ?>
        <br>
        <p class="winkelmand-total-prijs">Totale prijs: €<?= $total ?></p>
        <br>
        <form action="php/bestellingPlaatsen.php" method="post">
            <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
            <input type="hidden" name="product_id" value="<?= $userinfo['product_id'] ?>">
            <input type="hidden" name="product_amount" value="<?= $userinfo['amount'] ?>">
            <input type="hidden" name="product_price" value="<?= $userinfo['product_price'] ?>">
            <input type="hidden" name="total_order_price" value="<?= $total ?>">
            <input class="btn btn-success" type="submit" value="Bestelling plaatsen">
        </form>
        <br>
        <form action="index.php?page=winkelmand" id="betaling" method="POST">
            <input class="btn btn-warning" type="submit" value="Terug naar winkelmand">
        </form>
        <br>
    <?php endif; ?>
</div>
<?php }else { 
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>