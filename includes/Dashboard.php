<?php
require_once 'C:\wamp64\www\portal_job\config\database.php'; // Un seul require_once suffira !

// Fonction pour récupérer des données
function fetchAll($pdo, $query, $params = [])
{
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute($params);
    return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
}

$users3 = fetchAll($pdo, "SELECT * FROM users ORDER BY id DESC LIMIT 3");
$usersAll = fetchAll($pdo, "SELECT * FROM users");
$offreAll = fetchAll($pdo, "SELECT * FROM job_offers");
$companyAll = fetchAll($pdo, "SELECT * FROM company");

?>


<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">📢 Les 3 Users les plus récents</h1>
    </div>

    <table id="idTable" class="display table table-bordered table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>PRENOM</th>
                <th>EMAIL</th>
                <th>MOT DE PASSE</th>
                <th>RÔLE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users3 as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user['prenom']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<hr>
<h1 class="mb-4">Tableau de bord Admin</h1>