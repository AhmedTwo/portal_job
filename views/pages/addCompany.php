<?php
session_start();
$company = true;
require_once '../../config/database.php'; // Connexion PDO
require_once 'C:\wamp64\www\portal_job\model\Companys.php';
?>


<div class="container">
  <br>
  <br>
  <h1 class="text-center m-5">Ajout d'une nouvelle Compagnie</h1>

  <form class="row g-3" method="POST">
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

<br>
<br>
<br>
<br><br><br><br><br><br><br>
<?php require_once '../partials/footer.html.php'; ?>