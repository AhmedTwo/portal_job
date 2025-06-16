<?php

class Offers
{
    public $id;
    public $title;
    public $description;
    public $mission;
    public $location;
    public $category;
    public $employment_type_id;
    public $technologies;
    public $benefits;
    public int $participants_count;
    public $created_at;
    public $image_url;
    public $id_company;

    public function __construct($title, $description, $mission, $location, $category, $employment_type_id, $technologies, $benefits, $created_at, $image_url, $id_company, $participants_count = 0, $id = null)
    // Mettre tous les paramètres facultatifs à la fin
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->mission = $mission;
        $this->location = $location;
        $this->category = $category;
        $this->employment_type_id = $employment_type_id;
        $this->technologies = $technologies;
        $this->benefits = $benefits;
        $this->participants_count = $participants_count;
        $this->created_at = $created_at;
        $this->image_url = $image_url;
        $this->id_company = $id_company;
    }

    public function addOffers($pdo)
    {

        $query = "
        INSERT INTO job_offers (title, description, mission, location, category, id_company, employment_type_id, technologies_used, benefits, created_at, image_url)
        VALUES ( :titre, :description, :mission, :adresse, :poste, :id_company, :contrat, :technologie, :positif, :dateCreation, :imageUrl)";

        $pdostmt = $pdo->prepare($query);

        $pdostmt->execute([
            ":titre" => $this->title,
            ":description" => $this->description,
            ":mission" => $this->mission,
            ":adresse" => $this->location,
            ":poste" => $this->category,
            ":id_company" => $this->id_company,
            ":contrat" => $this->employment_type_id,
            ":technologie" => $this->technologies,
            ":positif" => $this->benefits,
            ":dateCreation" => $this->created_at,
            ":imageUrl" => $this->image_url
        ]);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        !empty($_POST["inputTitre"]) &&
        !empty($_POST["inputDescription"]) &&
        !empty($_POST["inputMission"]) &&
        !empty($_POST["inputAdresse"]) &&
        !empty($_POST["inputPoste"]) &&
        !empty($_POST["inputEntreprise"]) &&
        !empty($_POST["inputContrat"]) &&
        !empty($_POST["inputTechnologie"]) &&
        !empty($_POST["inputPositif"]) &&
        !empty($_POST["inputDateCreation"]) &&
        !empty($_POST["inputImage"])
    ) {

        $newOffer = new Offers(
            htmlspecialchars($_POST["inputTitre"]),
            htmlspecialchars($_POST["inputDescription"]),
            htmlspecialchars($_POST["inputMission"]),
            htmlspecialchars($_POST["inputAdresse"]),
            htmlspecialchars($_POST["inputPoste"]),
            htmlspecialchars($_POST["inputContrat"]),
            htmlspecialchars($_POST["inputTechnologie"]),
            htmlspecialchars($_POST["inputPositif"]),
            htmlspecialchars($_POST["inputDateCreation"]),
            htmlspecialchars($_POST["inputImage"]),
            (int) $_POST["inputEntreprise"],
            0,
            null // Donc mettre aussi $id = null à la fin
        );

        $newOffer->addOffers($pdo);

        header("Location: NosOffres.php");
        exit();
    }
}
require_once '../partials/header.html.php';
