<?php
session_start(); // Démarre une session PHP (nécessaire pour utiliser $_SESSION)
require_once './config/database.php';

if (isset($_SESSION['new_id'])) {
    header('Location:./views/pages/homepage.html.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["inputEmail"];
    $password = md5($_POST["inputMdp"]);

    $query = "SELECT * FROM users WHERE email = :email";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(['email' => $email]);
    $user = $pdostmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        // ici on stocke les infos importantes dans la session
        $_SESSION['new_id'] = $user['id'];
        $_SESSION['new_email'] = $user['email'];
        $_SESSION['new_nom'] = $user['nom'];
        $_SESSION['new_role'] = $user['role'];

        header('Location:./views/pages/homepage.html.php');
        exit;
    } else if (!empty($email) && !empty($password)) {
        $error = "L'identifiant et/ou mot de passe est incorrect !";
    } else {
        $error = "Les champs sont vides, veuillez les remplir !";
    }
}
