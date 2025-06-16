<?php
session_start();
require_once 'C:\wamp64\www\portal_job\config\database.php';
$row = null;

if (!empty($_GET["idO"])) {
    $query = "
    SELECT job_offers.*, e.name AS contrat
    FROM job_offers 
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    WHERE job_offers.id = :id
    ";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["idO"]]);
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
    $query = "UPDATE job_offers 
              SET title = :title, mission = :mission, description = :description, location = :location, category = :category,
                  employment_type_id = :contrat, technologies_used = :technologies_used, benefits = :benefits, 
                  participants_count = :participants_count, created_at = :created_at, image_url = :image_url 
              WHERE id = :id";

    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "title" => $_POST["inputTitre"],
        "mission" => $_POST["inputMission"],
        "description" => $_POST["inputDescription"],
        "location" => $_POST["inputAdresse"],
        "category" => $_POST["inputPoste"],
        "contrat" => $_POST["inputContrat"],
        "technologies_used" => $_POST["inputTechnologie"],
        "benefits" => $_POST["inputPositif"],
        "participants_count" => $_POST["inputNombreParticipant"],
        "created_at" => $_POST["inputDateCreation"],
        "image_url" => $_POST["inputImage"],
        "id" => $_POST["myid"] // ici le nom correspond au :id dans la requête SQL
    ]);

    header("Location: NosOffres.php");
    exit();
}

// Inclure la vue uniquement après traitement
$offre = true;
require_once '../partials/header.html.php';
require_once '../pages/ModifOffre.html.php';
require_once '../partials/footer.html.php';
