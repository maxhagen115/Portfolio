<?php
if ($_SESSION['id']) {
    if ($_SESSION['role'] == "admin") {
        require 'php/dbh.php';
        $product_id = $_POST['product_id'];
        $query = $PDO->prepare("SELECT * FROM products WHERE product_id = $product_id");
        $query->execute();
        $row = $query->fetch();

        $p_id = $row['product_id'];
        $p_naam = $row['product_name'];
        $p_beschrijving = $row['product_description'];
        $p_prijs = $row['product_price'];

?>

        <div class="container">
            <div class="row jsutify-content-center">
                <div class="col-8 profiel-container justift-content-center">
                    <br>
                    <h4>Product wijzigen</h4>
                    <form action="php/productBewerken.php" method="post">
                        <div class="form-group">
                            <p>
                                <label for="titel">Product naam</label>
                                <input class="form-control" type="text" name="product_naam" value=<?php echo $row['product_name'] ?>>
                            </p>

                            <p>
                                <label for="titel">Product beschrijving</label>
                                <input class="form-control" type="text" name="product_beschrijving" value=<?php echo $row['product_description'] ?>>
                            </p>

                            <p>
                                <label for="titel">Product prijs</label>
                                <input class="form-control" type="text" name="product_prijs" value=<?php echo $row['product_price'] ?>>
                            </p>
                            <input type="hidden" class="btn btn-info" name="productid" value=<?= $row['product_id'] ?>>
                            <br>
                            <input type="submit" class="btn btn-info" value="Wijzig Product">
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