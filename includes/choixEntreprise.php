<?php
require_once 'C:\wamp64\www\portal_job\config\database.php';

$query = "
SELECT name, id AS id_company
FROM company
;";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute();
$NameComapany = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
