<?php
session_start();
require_once '../../config/database.php'; // Connexion PDO
$offre = true;
require_once '../partials/header.html.php';

// Récupération des offres
$sql = "
    SELECT job_offers.*,
           c.id AS id_company, c.logo AS company_logo,
           e.name AS contrat
    FROM job_offers 
    JOIN company AS c ON job_offers.id_company = c.id
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    ORDER BY id asc
";
$pdostmt = $pdo->prepare($sql);
$pdostmt->execute();
$offres = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <br>
    <h1 class="mb-4">TOUTES LES OFFRES</h1>

    <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin' || $_SESSION['new_role'] === 'company'): ?>
        <div class="mb-4">
            <a href="addOffers.php" class="btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                Ajouter une offre
            </a>
        </div>
    <?php endif; ?>

    <table id="idTable" class="display table table-bordered table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>LOGO COMPAGNIE</th>
                <th>POSTE</th>
                <th>CONTRAT</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offres as $offre): ?>
                <tr>
                    <td>
                        <a href="OffreCompany.php?id=<?= $offre['id_company'] ?>">
                            <img src="<?= $offre['company_logo'] ?>" width="100" alt="Logo entreprise">
                        </a>
                    </td>
                    <td><?= htmlspecialchars($offre['title']) ?></td>
                    <td><?= htmlspecialchars($offre['contrat']) ?></td>
                    <td>
                        <!-- Détails -->
                        <a href="OffreDetails.php?id=<?= $offre['id'] ?>" class="btn btn-success" title="Voir les détails">
                            Voir l'offre
                        </a>
                        <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'): ?>
                            <!-- Modifier -->
                            <a href="ModifOffre.php?idO=<?= $offre['id'] ?>" class="btn btn-primary" title="Modifier">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                </svg>
                            </a>
                            <!-- Supprimer -->
                            <a href="../../includes/delete.php?idO=<?= $offre['id'] ?>" class="btn btn-danger"
                                onclick="return confirm('Es-tu sûr de vouloir supprimer cette offre ?')" title="Supprimer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../partials/footer.html.php'; ?>