<?php
require_once 'C:\wamp64\www\portal_job\config\database.php';

$query = "
SELECT name, id AS id_contrat
FROM employment_type;
";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute();
$contrat = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
