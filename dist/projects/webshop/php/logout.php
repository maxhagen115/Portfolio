<?php
session_start();
$_SESSION["login"] = null;
session_unset();
header('location: ../index.php?page=login')
?>