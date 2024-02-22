<?php
if ($_SESSION['id']) {
    if ($_SESSION['role'] == "admin") {
        if (isset($_SESSION['error_melding'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_melding'] . '</div>';
            $_SESSION['error_melding'] = null;
        }
        if (isset($_SESSION['success_melding'])) {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_melding'] . '</div>';
            $_SESSION['success_melding'] = null;
        }
?>

        <div class="container-fluid">
            <div class="container">
                <div class="formBox">
                    <form action="php/productToevoegen.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1>Product toevoegen</h1>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="inputBox ">
                                    <div class="inputText">Product naam</div>
                                    <input type="text" name="productName" class="form-control" maxlength="25" required>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="inputBox ">
                                    <div class="inputText">Product beschrijving</div>
                                    <input type="text" name="productBeschrijving" class="form-control" maxlength="25" required>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="inputBox ">
                                    <div class="inputText">Prijs</div>
                                    <input type="number" name="productPrice" class="form-control" step="0.01" class="input" min="0.01" max="10000" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <input type="submit" class="btn btn-info" value="Versturen">
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