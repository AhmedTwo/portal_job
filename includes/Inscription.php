<?php
require_once 'C:\wamp64\www\portal_job\config\database.php';
require_once 'C:\wamp64\www\portal_job\model\Users.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        !empty($_POST["inputNom"]) &&
        !empty($_POST["inputPrenom"]) &&
        !empty($_POST["inputEmail"]) &&
        !empty($_POST["inputPassword"]) &&
        !empty($_POST["inputTelephone"]) &&
        !empty($_POST["inputVille"]) &&
        !empty($_POST["inputZipcode"]) &&
        !empty($_POST["inputQualification"]) &&
        !empty($_POST["inputPreference"]) &&
        !empty($_POST["choix"]) &&
        !empty($_FILES["inputCv"]["name"]) &&
        !empty($_FILES["inputPhoto"]["name"])

    ) {

        $role = (substr($_POST["inputEmail"], -strlen($_POST["inputEmail"])) === '@company.com') ? 'company' : 'client';
        // // substr extrait une sous-chaîne à partir de la fin de l'email indiqué dans le form
        // // -strlen calcule la longueur de la chaîne // - devant strlen(...) signifie : "pars depuis la fin".

        // Création des dossiers s'ils n'existent pas
        if (!is_dir('uploads/cv')) {
            mkdir('uploads/cv', 0777, true);
        }
        if (!is_dir('uploads/photos')) {
            mkdir('uploads/photos', 0777, true);
        }

        // Noms de fichiers uniques
        $cv = uniqid('cv_') . '_' . basename($_FILES["inputCv"]["name"]);
        $photo = uniqid('photo_') . '_' . basename($_FILES["inputPhoto"]["name"]);

        // Déplacement
        // Chemin temporaire du fichier stocké automatiquement par PHP.
        move_uploaded_file($_FILES["inputCv"]["tmp_name"], "uploads/cv/" . $cv);
        move_uploaded_file($_FILES["inputPhoto"]["tmp_name"], "uploads/photos/" . $photo);

        $newUser = new Users(
            $_POST["inputNom"],
            $_POST["inputPrenom"],
            $_POST["inputEmail"],
            md5($_POST["inputPassword"]),
            $role,
            $_POST["inputTelephone"],
            $_POST["inputVille"],
            $_POST["inputZipcode"],
            $cv,
            $_POST["inputQualification"],
            $_POST["inputPreference"],
            (int) $_POST["choix"],
            $photo
        );

        try {
            $id = $newUser->addUsers($pdo);
            if ($id) {
                header("Location:../index.php");
                exit();
            } else {
                echo "Échec de l'ajout en base.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "Erreur : cet email est déjà enregistré.";
            } else {
                echo "Erreur d'insertion : " . $e->getMessage();
            }
            
            // Attendre 2 secondes puis rediriger
            header("refresh:2;url=../views/pages/Inscription.html.php");
        }
    }        
}
