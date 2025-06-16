<?php
session_start();
require_once '../../config/database.php';
$company = true;
require_once '../partials/header.html.php';

?>

<div class="container">
    <br><br><br><br><br>
    <h1>OFFRES DE LA COMPAGNIE</h1>

    <?php

    if (!isset($_GET['id'])) {
        die("Offre introuvable !");
    }
    $id = (int) $_GET['id']; // Nettoyage de l'ID pour éviter des injections SQL

    // recuperation du details de la compagnie
    $pdostmt = $pdo->prepare("
SELECT * FROM company
WHERE id = :id
");
    $pdostmt->execute([':id' => $id]);
    $company = $pdostmt->fetch(PDO::FETCH_ASSOC);

    // var_dump($company);
    // die;

    if (!$company) {
        die("Offre non trouvée !");
    }

    // recuperation du details des offres de la compagnie
    $pdostmt1 = $pdo->prepare("
    SELECT job_offers.*, e.name AS contrat 
    FROM job_offers
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    WHERE id_company = :id
    ");
    $pdostmt1->execute([':id' => $id]);
    $offers = $pdostmt1->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table id="datatable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>COMPAGNIE</th>
                <th>NAME</th>
                <th>NB EMPLOYE</th>
                <th>DOMAINE</th>
                <th>ADRESSE</th>
                <th>LATITUDE</th>
                <th>LONGITUDE</th>
                <th>DESCRIPTION</th>
                <th>NOMBRE D'OFFRE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $company["id"]; ?></td>
                <td>
                    <img src="<?php echo $company["logo"]; ?>" width="100">
                </td>
                <td><?php echo $company["name"]; ?></td>
                <td><?php echo $company["number_of_employees"]; ?></td>
                <td><?php echo $company["industry"]; ?></td>
                <td><?php echo $company["address"]; ?></td>
                <td><?php echo $company["latitude"]; ?></td>
                <td><?php echo $company["longitude"]; ?></td>
                <td><?php echo $company["description"]; ?></td>
                <td><?php echo count($offers); ?></td>
            </tr>

        </tbody>
    </table>

    <table id="idTable" class="display">
        <thead>
            <tr>
                <th>TITRE</th>
                <th>CONTRAT</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offers as $ligne): ?>
                <tr>
                    <td><?= $ligne['title'] ?></td>
                    <td><?= $ligne['contrat'] ?></td>
                    <td>
                        <img src="<?= $ligne['image_url'] ?>" width="200" alt="Image de l'offre">
                    </td>
                    <td>
                        <a href="OffreDetails.php?id=<?= $ligne['id'] ?>" class="btn btn-success" title="Voir les détails">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <?php
    if (!$offers) {
        echo "<h1>COMPAGNIE SANS OFFRE !</h1>";
    }
    ?>

</div>

<br><br><br><br><br><br><br><br><br>
<?php require_once '../partials/footer.html.php'; ?>