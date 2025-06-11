<?php
include_once("../config/database.php");

if (!empty($_GET["idO"])) {
    $query = "delete from job_offers where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idO"]]);
    $objstmt->closeCursor();
    header("Location:../views/pages/NosOffres.php");
}

if (!empty($_GET["idC"])) {
    $query = "delete from company where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idC"]]);
    $objstmt->closeCursor();
    header("Location:../views/pages/Company.php");
}

if (!empty($_GET["idU"])) {
    $query = "delete from users where id=:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id" => $_GET["idU"]]);
    $objstmt->closeCursor();
    header("Location:../views/pages/UsersAdmin.html.php");
}
