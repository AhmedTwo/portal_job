<?php

class Company
{
    public $id;
    public $name;
    public $logo;
    public int $number_of_employees;
    public $industry;
    public $adress;
    public $latitude;
    public $longitude;
    public $description;
    public int $n_siret;

    public function __construct($name, $logo, $number_of_employees, $industry, $adress, $latitude, $longitude, $description, $n_siret, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->logo = $logo;
        $this->number_of_employees = $number_of_employees;
        $this->industry = $industry;
        $this->adress = $adress;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->description = $description;
        $this->n_siret = $n_siret;
    }

    public function addCompany($pdo)
    {
        $query = "
        INSERT INTO company (
        name, number_of_employees, industry, address,  latitude, longitude, description, n_siret, logo )
        VALUES ( :nom, :nbEmploye, :domaine, :adresse, :latitude, :longitude, :description, :n_siret, :logo )";

        $pdostmt = $pdo->prepare($query);

        $pdostmt->execute([
            ":nom" => $_POST["inputNom"],
            ":logo" => $_POST["inputLogo"],
            ":nbEmploye" => $_POST["inputNbEmploye"],
            ":domaine" => $_POST["inputDomaine"],
            ":adresse" => $_POST["inputAdresse"],
            ":latitude" => $_POST["inputLatitutde"],
            ":longitude" => $_POST["inputLongitude"],
            ":description" => $_POST["inputDescription"],
            ":n_siret" => $_POST["inputSiret"]
        ]);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        !empty($_POST["inputNom"]) &&
        !empty($_POST["inputNbEmploye"]) &&
        !empty($_POST["inputDomaine"]) &&
        !empty($_POST["inputAdresse"]) &&
        !empty($_POST["inputLatitutde"]) &&
        !empty($_POST["inputLongitude"]) &&
        !empty($_POST["inputDescription"]) &&
        !empty($_POST["inputSiret"]) &&
        !empty($_POST["inputLogo"])
    ) {

        $newCompany = new Company(
            htmlspecialchars($_POST["inputNom"]),
            htmlspecialchars($_POST["inputLogo"]),
            (int) htmlspecialchars($_POST["inputNbEmploye"]),
            htmlspecialchars($_POST["inputDomaine"]),
            htmlspecialchars($_POST["inputAdresse"]),
            htmlspecialchars($_POST["inputLatitutde"]),
            htmlspecialchars($_POST["inputLongitude"]),
            htmlspecialchars($_POST["inputDescription"]),
            htmlspecialchars($_POST["inputSiret"]),
            null
        );

        $newCompany->addCompany($pdo);

        header("Location: Company.php");
        exit();
    }
}
require_once '../partials/header.html.php';
