<?php
session_start();
require_once '../../config/database.php';
$row = null;

if (!empty($_GET["idU"])) {
    $query = "
    SELECT *
    FROM users 
    WHERE id = :id
    ";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["idU"]]);
    $row = $pdostmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        require_once '../partials/header.html.php';
        echo "<p class='alert alert-warning'>Offre non trouvée.</p>";
        require_once '../partials/footer.html.php';
        exit();
    }
} else {
    require_once '../partials/header.html.php';
    echo "<p class='alert alert-danger'>Aucun ID transmis.</p>";
    require_once '../partials/footer.html.php';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "UPDATE users 
              SET nom = :nom, prenom = :prenom, email = :email, password = :password, role = :role
              WHERE id = :id";

    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "nom" => $_POST["inputNom"],
        "prenom" => $_POST["inputPrenom"],
        "email" => $_POST["inputEmail"],
        "password" => $_POST["inputMdp"],
        "role" => $_POST["inputRole"],
        "id" => $_POST["myid"] // ici le nom correspond au :id dans la requête SQL
    ]);

    header("Location: UsersAdmin.html.php");
    exit();
}

// Inclure la vue uniquement après traitement
$dashboard = true;
require_once '../partials/header.html.php';
require_once './ModifUsers.html.php';
require_once '../partials/footer.html.php';
