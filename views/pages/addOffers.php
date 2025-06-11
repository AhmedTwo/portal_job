<?php
session_start();
$offre = true;
require_once '../../config/database.php';
require_once '../../includes/choixContrat.php';
require_once '../../includes/choixEntreprise.php';
require_once 'C:\wamp64\www\portal_job\model\Offers.php';

?>


<div class="container">
  <br>
  <br>
  <h1 class="text-center m-5">Ajout d'une nouvelle Offre</h1>

  <form class="row g-3" method="POST">

    <div class="col-md-6">
      <label for="inputTitre" class="form-label">TITRE</label>
      <input type="text" class="form-control" id="inputTitre" name="inputTitre">
    </div>

    <div class="col-md-6">
      <label for="inputDescription" class="form-label">DESCRIPTION</label>
      <input type="text" class="form-control" id="inputDescription" name="inputDescription" required>
    </div>

    <div class="col-md-6">
      <label for="inputMission" class="form-label">MISSION</label>
      <input type="text" class="form-control" id="inputMission" name="inputMission" required>
    </div>

    <div class="col-md-6">
      <label for="inputAdresse" class="form-label">ADRESSE</label>
      <input type="text" class="form-control" id="inputAdresse" name="inputAdresse" required>
    </div>

    <div class="col-md-6">
      <label for="inputPoste" class="form-label">POSTE</label>
      <input type="text" class="form-control" id="inputPoste" name="inputPoste" required>
    </div>

    <div>
      <select class="form-select" id="inputEntreprise" name="inputEntreprise" aria-label="Floating label select example">
        <option selected>NOM ENTREPRISE</option>
        <?php foreach ($NameComapany as $ligne): ?>
          <option value="<?= $ligne["id_company"]; ?>"><?= $ligne["name"]; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <select class="form-select" id="inputContrat" name="inputContrat" aria-label="Floating label select example">
        <option selected>CHOISIR LE CONTRAT</option>
        <?php foreach ($contrat as $ligne): ?>
          <option value="<?= $ligne["id_contrat"]; ?>"><?= $ligne["name"]; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-6">
      <label for="inputTechnologie" class="form-label">TECHNOLOGIE</label>
      <input type="text" class="form-control" id="inputTechnologie" name="inputTechnologie" required>
    </div>

    <div class="col-md-6">
      <label for="inputPositif" class="form-label">POSITIFS</label>
      <input type="text" class="form-control" id="inputPositif" name="inputPositif" required>
    </div>

    <div class="col-md-6">
      <label for="inputDateCreation" class="form-label">DATE CREATION</label>
      <input type="date" class="form-control" id="inputDateCreation" name="inputDateCreation" required min="<?= date('Y-m-d') ?>">
    </div>

    <div class="col-md-6">
      <label for="inputImage" class="form-label">IMAGE URL</label>
      <input type="text" class="form-control" id="inputImage" name="inputImage" required>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>

  </form>
</div>

<br>
<?php require_once '../partials/footer.html.php'; ?>