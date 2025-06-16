<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
$offre = true;
require_once '../partials/header.html.php';

if (!isset($_GET['id'])) {
    die("Offre introuvable !");
}

$id = (int) $_GET['id'];

$sql = "
    SELECT job_offers.*, e.name AS contrat 
    FROM job_offers
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    WHERE job_offers.id = :id
";
$pdostmt = $pdo->prepare($sql);
$pdostmt->execute(['id' => $id]);
$offre = $pdostmt->fetch(PDO::FETCH_ASSOC);

if (!$offre) {
    die("Offre non trouvée !");
}
?>

<div class="container my-5">
    <br>
    <br>
    <div class="text-center mb-5">
        <h1 class="display- fw-bold text-primary"><i class="fa-solid fa-briefcase"></i> <?= $offre['title'] ?></h1>
        <p class="lead text-muted">Découvrez tous les détails de cette opportunité</p>
    </div>

    <div class="card shadow-lg border-0 rounded-4 p-5">
        <div class="row g-5">
            <div class="col-md-5 text-center">
                <?php if (!empty($offre["image_url"])): ?>
                    <img src="<?= $offre["image_url"] ?>" alt="Image offre" class="img-fluid rounded-4 shadow" style="max-height: 300px;">
                <?php else: ?>
                    <div class="text-muted">Aucune image disponible</div>
                <?php endif; ?>
                <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'client' || $_SESSION['new_role'] === 'admin'): ?>
                    <div class="mb-3">
                        <br><br>
                        <a href="Postuler.html.php?id=<?= $offre["id"] ?>" type="submit" class="btn btn-primary" title="Voir les détails">
                            Postuler à l'offre
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-7">
                <h3 class="fw-bold mb-3">Description</h3>
                <p class="fs-5"><?= $offre["description"] ?></p>

                <h4 class="fw-semibold mt-4">Mission</h4>
                <p class="fs-5"><?= $offre["mission"] ?></p>

                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <strong>Ville :</strong> <span class="fs-5"><?= $offre["location"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Poste :</strong> <span class="fs-5"><?= $offre["category"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Entreprise :</strong> <span class="fs-5"><?= $offre["id_company"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Contrat :</strong> <span class="fs-5"><?= $offre["contrat"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Technologies :</strong> <span class="fs-5"><?= $offre["technologies_used"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Avantages :</strong> <span class="fs-5"><?= $offre["benefits"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Nombre de candidats :</strong> <span class="fs-5"><?= $offre["participants_count"] ?></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Date de création :</strong> <span class="fs-5"><?= date("d/m/Y", strtotime($offre["created_at"])) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php require_once '../partials/footer.html.php'; ?>