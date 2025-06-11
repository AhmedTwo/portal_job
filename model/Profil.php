<?php

class Profil
{
    public function readProfil($pdo, $userId)
    {
        $query = '
        SELECT u.nom, u.prenom, u.email, u.role, p.telephone, p.ville, p.code_postal, p.cv_pdf, p.qualification, p.preference, p.disponibilite, p.photo
        FROM profil p
        JOIN users u ON u.id = p.user_id
        WHERE p.user_id = :user_id
        ';

        $stmt = $pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // On retourne les données au lieu d'afficher
    }
}
