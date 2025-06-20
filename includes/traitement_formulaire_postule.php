<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Chemins corrects avec __DIR__ pour éviter les problèmes de chemins relatifs
require_once dirname(__DIR__) . '/config/database.php';
require dirname(__DIR__) . '/vendor/autoload.php';

if (!isset($_GET['id'])) {
    die("Offre introuvable !");
}

// Récupère l'offre en question
$id = (int) $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupération des détails de l'offre
    $query = "
    SELECT job_offers.*, e.name AS contrat, c.name AS company_name 
    FROM job_offers
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    LEFT JOIN company c ON job_offers.id_company = c.id
    WHERE job_offers.id = :id
    ";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(['id' => $id]);
    $offre = $pdostmt->fetch(PDO::FETCH_ASSOC);

    if (!$offre) {
        die("Offre non trouvée !");
    }

    // Gestion des fichiers uploadés
    $cv_file = $_FILES['inputCv']['name'] ?? 'Non fourni';
    $lettre_file = $_FILES['inputLettre']['name'] ?? 'Non fourni';

    // Construction correcte du message
    $message = "
    Bonjour {$_POST['inputPrenom']} {$_POST['inputNom']},

    Votre candidature à l'offre suivante : {$offre['title']}
    Venant de l'entreprise suivante : {$offre['company_name']}

    A bien été reçue. Voici un récapitulatif des informations que vous avez transmises :

    NOM : {$_POST['inputNom']}
    PRÉNOM : {$_POST['inputPrenom']}
    VILLE : {$_POST['inputVille']}
    CODE POSTAL : {$_POST['inputZipcode']}
    TÉLÉPHONE : {$_POST['inputTelephone']}
    EMAIL : {$_POST['inputEmail']}

    MOTIVATION :
    {$_POST['inputMotivation']}

    LETTRE DE MOTIVATION : {$lettre_file}
    CV : {$cv_file}

    Notre équipe étudiera attentivement votre dossier et vous contactera si votre profil correspond à nos attentes.
    
    Cordialement,
    L'équipe Recrutement
    ";

    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ajc95ajc@gmail.com'; // Ton adresse Gmail
        $mail->Password = 'csyc eevh mqki ozbw'; // Ton mot de passe d'application Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Infos mail
        $mail->setFrom($_POST['inputEmail'], $_POST['inputNom'] . ' ' . $_POST['inputPrenom']);
        $mail->addAddress('ajc95ajc@gmail.com'); // adresse destinataire
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Subject = "Candidature pour l'offre: {$offre['title']}";
        $mail->Body = $message;

        // Ajout des pièces jointes si présentes
        if ($_FILES['inputCv']['tmp_name'] && $_FILES['inputCv']['error'] == 0) {
            $mail->addAttachment($_FILES['inputCv']['tmp_name'], $_FILES['inputCv']['name']);
        }

        if ($_FILES['inputLettre']['tmp_name'] && $_FILES['inputLettre']['error'] == 0) {
            $mail->addAttachment($_FILES['inputLettre']['tmp_name'], $_FILES['inputLettre']['name']);
        }

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        $mail->send();

        // ✅ Incrémentation du nombre de participants
        $updateSql = "UPDATE job_offers SET participants_count = participants_count + 1 WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute(['id' => $id]);

        echo "<div class='alert alert-success text-center'>Votre candidature a été envoyée avec succès!</div>";
        echo '<meta http-equiv="refresh" content="2;url=/salah%20projet/views/pages/NosOffres.php">';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>Erreur : {$mail->ErrorInfo}</div>";
    }
}
