<?php
session_start();
require_once '../../config/database.php';
$dashboard = true;
require_once '../partials/header.html.php';
?>

<br><br>
<div class="d-flex">
    <nav class="flex-column bg-black p-3" style="height: 100vh; width: 250px;">
        <div class="navbar-brand mb-4" style="color:white;">Admin Dashboard</div>
        <ul class="nav flex-column">
        <li class="nav-item">
                <a class="nav-link active" href="Dashboard.html.php">👉 Home 👈</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#" onclick="chargement('UsersAdmin.html.php'); return false;">👉 Users 👈</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="chargement('NosOffres.php'); return false;">👉 Offers 👈</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="chargement('Company.php'); return false;">👉 Company 👈</a>
            </li>
        </ul>
    </nav>

    <div id="main-content" class="p-4" style="flex-grow: 1;">
        <?php require_once '../pages/DashboardCount.html.php'; ?>
    </div>
</div>

<script>
    function chargement(page) {
        fetch('../pages/' + page) // fetch() sert à faire une requête HTTP sans recharger la page.
            .then(response => {
                if (!response.ok) throw new Error("Erreur réseau");
                return response.text();
            })
            .then(html => {
                document.getElementById('main-content').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('main-content').innerHTML = "<p>Erreur lors du chargement du contenu.</p>";
                console.error(error);
            });
    }
</script>