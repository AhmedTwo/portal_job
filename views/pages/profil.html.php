<?php

session_start();
$profil = true;

require_once '../../config/database.php';
require_once '../partials/header.html.php';
require_once 'C:\wamp64\www\portal_job\model\Users.php';

if (isset($_SESSION['new_id'])) {
    $newProfil = new Users();
    $newProfil->readProfil($pdo,$_SESSION['new_id']);
} else {
    echo "Vous devez être connecté pour voir votre profil.";
}

$profilData = null;

if (isset($_SESSION['new_id'])) {
    $newProfil = new Users();
    $profilData = $newProfil->readProfil($pdo, $_SESSION['new_id']);
}
?>

    <link rel="stylesheet" href="/portal_job/css/profil.css">


<?php if ($profilData): ?>
    <h1>MON PROFIL</h1>
    <div class="profil-container">
        <img class="profil-photo" src="<?= htmlspecialchars($profilData['photo']) ?>" alt="Photo de profil">
        <div class="profil-info">
            <h3><?= htmlspecialchars($profilData['prenom'] . ' ' . $profilData['nom']) ?></h3>
            <p><span>Email :</span> <?= htmlspecialchars($profilData['email']) ?></p>
            <p><span>Téléphone :</span> <?= htmlspecialchars($profilData['telephone']) ?></p>
            <p><span>Ville :</span> <?= htmlspecialchars($profilData['ville']) ?> (<?= htmlspecialchars($profilData['code_postal']) ?>)</p>
            <p><span>CV :</span> <a href="/portal_job/includes/uploads/cv/<?= basename($profilData['cv_pdf']) ?>" target="_blank">Voir le CV</a></p>
            <p><span>Qualification :</span> <?= htmlspecialchars($profilData['qualification']) ?></p>
            <p><span>Préférences :</span> <?= htmlspecialchars($profilData['preference']) ?></p>
            <p><span>Disponible :</span> <?= $profilData['disponibilite'] ? 'Oui' : 'Non' ?></p>
            <p><span>Rôle :</span> <?= htmlspecialchars($profilData['role']) ?></p>
        </div>
    </div>
<?php else: ?>
    <p style="text-align: center;">Vous devez être connecté pour voir votre profil.</p>
<?php endif; ?>
