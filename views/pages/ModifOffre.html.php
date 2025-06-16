<?php
require_once '../../includes/choixContrat.php';
?>

<div class="container my-5">
    <div class="text-center mb-7">
        <h1 class="display-4 fw-bold text-primary"><i class="fa-solid fa-pen-to-square"></i> Modifier l'offre</h1>
        <p class="lead text-muted">Mettez à jour les informations de l'offre ci-dessous</p>
    </div>

    <?php if (!isset($row)) : ?>
        <div class="alert alert-danger text-center">Erreur de chargement des données.</div>
    <?php else : ?>
        <form method="POST" class="bg-light p-5 shadow rounded-4">
            <input type="hidden" name="myid" value="<?= $row['id'] ?>">

            <div class="row g-4">
                <div class="col-md-6">
                    <label for="inputTitre" class="form-label fw-semibold">Titre</label>
                    <input type="text" class="form-control form-control-lg" name="inputTitre" id="inputTitre" value="<?= $row['title'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputPoste" class="form-label fw-semibold">Poste</label>
                    <input type="text" class="form-control form-control-lg" name="inputPoste" id="inputPoste" value="<?= $row['category'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputAdresse" class="form-label fw-semibold">Adresse</label>
                    <input type="text" class="form-control form-control-lg" name="inputAdresse" id="inputAdresse" value="<?= $row['location'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputContrat" class="form-label fw-semibold">Type de contrat</label>
                    <select class="form-select form-select-lg" id="inputContrat" name="inputContrat">
                        <option selected><?= $row["contrat"]; ?></option>
                        <?php foreach ($contrat as $ligne): ?>
                            <option value="<?= $ligne["id_contrat"]; ?>"><?= $ligne["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label for="inputMission" class="form-label fw-semibold">Mission</label>
                    <textarea class="form-control form-control-lg" name="inputMission" id="inputMission" rows="4"><?= $row['mission'] ?></textarea>
                </div>

                <div class="col-12">
                    <label for="inputDescription" class="form-label fw-semibold">Description</label>
                    <textarea class="form-control form-control-lg" name="inputDescription" id="inputDescription" rows="4"><?= $row['description'] ?></textarea>
                </div>

                <div class="col-md-6">
                    <label for="inputTechnologie" class="form-label fw-semibold">Technologie(s)</label>
                    <input type="text" class="form-control form-control-lg" name="inputTechnologie" id="inputTechnologie" value="<?= $row['technologies_used'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputPositif" class="form-label fw-semibold">Points positifs</label>
                    <textarea class="form-control form-control-lg" name="inputPositif" id="inputPositif" rows="2"><?= $row['benefits'] ?></textarea>
                </div>

                <div class="col-md-6">
                    <label for="inputNombreParticipant" class="form-label fw-semibold">Nombre de participants</label>
                    <input type="number" class="form-control form-control-lg" name="inputNombreParticipant" id="inputNombreParticipant" value="<?= $row['participants_count'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="inputDateCreation" class="form-label fw-semibold">Date de création</label>
                    <input type="date" class="form-control form-control-lg" name="inputDateCreation" id="inputDateCreation" required min="<?= date('Y-m-d') ?>">
                </div>

                <div class="col-12">
                    <label for="inputImage" class="form-label fw-semibold">Image (URL)</label>
                    <input type="text" class="form-control form-control-lg" name="inputImage" id="inputImage" value="<?= $row['image_url'] ?>">
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fa-solid fa-floppy-disk"></i> Mettre à jour
                    </button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>