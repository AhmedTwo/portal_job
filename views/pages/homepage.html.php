<?php
session_start();
require_once '../../config/database.php'; // Connexion PDO
$homepage = true;
require_once '../partials/header.html.php';

$sql = "
    SELECT job_offers.*,
           c.id AS id_company,
           c.logo AS company_logo,
           e.name AS contrat
    FROM job_offers 
    JOIN company AS c ON job_offers.id_company = c.id
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    ORDER BY id DESC LIMIT 3
";

$pdostmt = $pdo->prepare($sql);
$pdostmt->execute();
$Offres3 = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <div class="text-center mb-5">
        <br>
        <h1 class="display-5 fw-bold text-primary">📢 Les 3 offres les plus récentes</h1>
        <p class="text-muted">Découvrez les dernières opportunités publiées</p>
    </div>

    <div class="row g-4">
        <?php foreach ($Offres3 as $offre): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow rounded-4">
                    <div class="card-header bg-white text-center">
                        <a href="OffreCompany.php?id=<?= $offre['id_company'] ?>">
                            <img src="<?= $offre['company_logo'] ?>" alt="Logo entreprise" class="img-fluid" style="max-height: 100px;">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="min-height: 50px;"><?= $offre["title"] ?></h5>
                        <p class="card-text">
                            <span class="badge bg-secondary"><?= $offre["contrat"] ?></span>
                        </p>
                        <?php if (!empty($offre["image_url"])): ?>
                            <img src="<?= $offre["image_url"] ?>" class="img-fluid rounded mb-3" alt="Image offre">
                        <?php endif; ?>
                        <div class="d-grid">
                            <a href="OffreDetails.php?id=<?= $offre["id"] ?>" class="btn btn-success">
                                Voir les détails <i class="bi bi-arrow-right-circle ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<br>
<br>
<?php require_once '../partials/footer.html.php'; ?>