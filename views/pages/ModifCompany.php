<?php
session_start();
require_once '../../config/database.php';
$row = null;

// Récupération des données
if (!empty($_GET["idC"])) {
    $query = "SELECT * FROM company WHERE id = :id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["idC"]]);
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

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "UPDATE company 
              SET name = :name, number_of_employees = :number_of_employees, industry = :industry, address = :address, latitude = :latitude,
                  longitude = :longitude, description = :description, n_siret = :n_siret , logo = :logo
              WHERE id = :id";

    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "name" => $_POST["inputNom"],
        "number_of_employees" => $_POST["inputMission"],
        "industry" => $_POST["inputDomaine"],
        "address" => $_POST["inputAdresse"],
        "latitude" => $_POST["inputLatitude"],
        "longitude" => $_POST["inputLongitude"],
        "description" => $_POST["inputDescription"],
        "n_siret" => $_POST["inputSiret"],
        "logo" => $_POST["inputLogo"],
        "id" => $_POST["myid"] // ici le nom correspond au :id dans la requête SQL
    ]);

    header("Location: Company.php");
    exit();
}

// Inclure la vue uniquement après traitement
$company = true;
require_once '../partials/header.html.php';
require_once './ModifCompany.html.php';
require_once '../partials/footer.html.php';
