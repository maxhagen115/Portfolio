<?php
session_start();

include 'dbh.php';

$naam =  htmlspecialchars($_POST['productName']);
$price =  htmlspecialchars($_POST['productPrice']);
$beschrijving =  htmlspecialchars($_POST['productBeschrijving']);

$sql = 'SELECT * FROM products';
$querry = $PDO->prepare($sql);
$querry->execute();
while ($row = $querry->fetch()) {
    if ($naam == $row['product_name']) {
        $naamingebruik = true;
    }
}
if ($naamingebruik == true) {
    $_SESSION['error_melding'] = 'Naam al in gebruik';
    header('location: ../index.php?page=productToevoegen');
} else {
    $sql = "INSERT INTO products (product_name, product_description, product_price)
        VALUES(:product_name , :product_description , :product_price )";
    $querry = $PDO->prepare($sql);
    $querry->execute(array(
        ':product_name'       => $naam,
        ':product_description'      => $beschrijving,
        ':product_price'    => $price,
    ));
    $_SESSION['success_melding'] = 'Product Aangemaakt';
    header('location: ../index.php?page=productToevoegen');
}
