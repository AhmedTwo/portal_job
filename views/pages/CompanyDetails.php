<?php
session_start();
require_once '../../config/database.php';
$company = true;
require_once '../partials/header.html.php';
?>

<div class="container my-5">

    <h1 class="mb-4">Détail de la compagnie</h1>

    <?php
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { // !is_numeric ???
        die("ID invalide ou non fourni !");
    }

    $id = (int) $_GET['id'];

    $sql = "SELECT * FROM company WHERE id = :id";
    $pdostmt = $pdo->prepare($sql);
    $pdostmt->bindParam(':id', $id, PDO::PARAM_INT); // a quoi sa sert ??
    $pdostmt->execute();
    $company = $pdostmt->fetch(PDO::FETCH_ASSOC);

    if (!$company) {
        die("Compagnie introuvable !");
    }
    ?>

    <table id="datatable" class="display table table-striped table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Employés</th>
                <th>Secteur</th>
                <th>Adresse</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Description</th>
                <th>N_Siret</th>
                <th>Logo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $company["id"] ?></td>
                <td><?= htmlspecialchars($company["name"]) ?></td>
                <td><?= htmlspecialchars($company["number_of_employees"]) ?></td>
                <td><?= htmlspecialchars($company["industry"]) ?></td>
                <td><?= htmlspecialchars($company["address"]) ?></td>
                <td><?= htmlspecialchars($company["latitude"]) ?></td>
                <td><?= htmlspecialchars($company["longitude"]) ?></td>
                <td><?= nl2br(htmlspecialchars($company["description"])) ?></td>
                <td><?= htmlspecialchars($company["n_siret"]) ?></td>
                <td><img src="<?= htmlspecialchars($company["logo"]) ?>" width="200" alt="Logo de la compagnie"></td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php require_once '../partials/footer.html.php'; ?>