<?php
if ($_SESSION['id']) {
    include 'php/dbh.php';

    $productArr = array();
    $total = 0;

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

    if (isset($_SESSION['success_melding'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_melding'] . '</div>';
        $_SESSION['success_melding'] = null;
    }
    if (isset($_SESSION['error_melding'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_melding'] . '</div>';
        $_SESSION['error_melding'] = null;
    }

?>
    <div class="cart">
        <h1 class="product-th">overzicht winkelmand</h1>
        <?php if (isset($_SESSION['login'])) : ?>
            <form action="php/updateProductInCart.php" method="POST">
                <?php if (count($row) > 0) { ?>
                    <?php foreach ($row as $userinfo) {  ?>
                        <div class="grid-container">
                            <div>
                                <h4><?php echo $userinfo['product_name']; ?></h4>
                            </div>
                            <div>
                                <p>Aantal:</p>
                            </div>
                            <div>
                                <input name="product[<?= $userinfo['id'] ?>]" type="number" min="1" max="5" value="<?= $userinfo['amount'] ?>">
                            </div>
                            <div>
                                <p>Prijs:€<?php echo $userinfo['product_price']; ?></p>
                            </div>
                            <div>
                                <a class="product-text" href="php/verwijderProductUitUserCart.php?removeid=<?php echo $userinfo['id']; ?>">Verwijder</a>
                            </div>
                            <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                        </div>
                    <?php    }   ?>
                    <br>
                    <p>Totale prijs: €<?= $total ?></p>
                    <button class="btn btn-info" type="submit">Producten bijwerken</button>
            </form>
            <br>
            <form action="index.php?page=bestellingPlaatsen" method="POST">
                <input class="btn btn-warning" type="submit" value="Naar betalen">
            </form>
            <br>
        <?php  } else {
        ?><br>
            <p>U heeft niks in uw winkelmandje</p>
        <?php } ?>
    </div>
<?php endif; ?>

<?php } else {
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>