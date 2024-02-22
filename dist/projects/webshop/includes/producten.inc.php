<?php
if ($_SESSION['id']) {
require 'php/dbh.php';

$query = $PDO->prepare("SELECT * FROM products");
$query->execute();

$role = '';
if (!empty($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

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
    <div class="card">
        <div class="card-body">
            <p><?= $row['product_name'] ?></p>
            <form action="php/naarWinkelmand.php?product_id=<?php echo $row['product_id']; ?>" method="post">
                <div class="form-group">
                    <input type="hidden" class="btn btn-info" name="product_id" value=<?= $row['product_id'] ?>>
                    <input type="submit" class="btn btn-success" value="toevoegen aan winkelmand">
                </div>
            </form>
            <?php if ($role == "admin") { ?>
                <form action="php/productVerwijderen.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="product_id" value=<?= $row['product_id'] ?>>
                        <input type="submit" class="btn btn-danger" value="Product Verwijderen">
                    </div>
                </form>
                <form action="index.php?page=productBewerken" method="post">
                    <div class="form-group">
                        <input type="hidden" name="product_id" value=<?= $row['product_id'] ?>>
                        <input type="submit" class="btn btn-info" value="Product Wijzigen">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
<?php endwhile; ?>
<?php }else { 
    $_SESSION['error_melding'] = 'U moet eerst inloggen.';
    header('location: index.php?page=login');
} ?>