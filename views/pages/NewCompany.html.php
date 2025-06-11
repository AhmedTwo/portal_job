<!-- Nouvelle compagnie a créer
Faire un formulaire qui aura comme champs les infos de la table company de la bdd
pour l'envoi de ce formulaire, il sera envoyé a l'admin avec un systeme de mail,
et l'admin prendra en compte les infos recu et s'occupera d'une part de valider ou non et ensuite
de générer un identifiant qui sera un mail qui devra se terminer par "@company.com" afin d'avoir un role de company ! -->

<?php
session_start();
require_once '../partials/header.html1.php';
require_once '../../includes/traitement_formulaire.php';
?>

<div class="container">
    <br>
    <br>
    <h1 class="text-center m-5">Ajout d'une nouvelle Compagnie</h1>

    <form class="row g-3" method="POST" action="../../includes/traitement_formulaire.php">
        <div class="col-md-6">
            <label for="inputNom" class="form-label">NOM</label>
            <input type="text" class="form-control" id="inputNom" name="inputNom" required>
        </div>
        <div class="col-md-6">
            <label for="inputNbEmploye" class="form-label">NOMBRE EMPLOYEES</label>
            <input type="text" class="form-control" id="inputNbEmploye" name="inputNbEmploye" required>
        </div>
        <div class="col-md-6">
            <label for="inputDomaine" class="form-label">DOMAINE</label>
            <input type="text" class="form-control" id="inputDomaine" name="inputDomaine" required>
        </div>
        <div class="col-md-6">
            <label for="inputAdresse" class="form-label">ADRESSE</label>
            <input type="text" class="form-control" id="inputAdresse" name="inputAdresse" required>
        </div>
        <div class="col-md-6">
            <label for="inputLatitutde" class="form-label">LATITUDE</label>
            <input type="text" class="form-control" id="inputLatitutde" name="inputLatitutde" required>
        </div>
        <div class="col-md-6">
            <label for="inputLongitude" class="form-label">LONGITUDE</label>
            <input type="text" class="form-control" id="inputLongitude" name="inputLongitude" required>
        </div>
        <div class="col-md-6">
            <label for="inputDescription" class="form-label">DESCRIPTION</label>
            <input type="text" class="form-control" id="inputDescription" name="inputDescription" required>
        </div>
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">EMAIL</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" required>
        </div>
        <div class="col-md-6">
            <label for="inputSiret" class="form-label">N_SIRET</label>
            <input type="text" class="form-control" id="inputSiret" name="inputSiret" required>
        </div>
        <div class="col-md-6">
            <label for="inputLogo" class="form-label">LOGO</label>
            <input type="text" class="form-control" id="inputLogo" name="inputLogo" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>