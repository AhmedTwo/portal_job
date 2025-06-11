<div class="container mt-5">

    <h2 class="mb-4">Modifier une compagnie</h2>

    <?php if (!isset($row)) : ?>
        <div class="alert alert-danger text-center">Erreur de chargement des données.</div>
    <?php else : ?>
        <form method="POST" class="bg-light p-5 shadow rounded-4">
            <input type="hidden" name="myid" value="<?= $row['id'] ?>">

            <div class="row g-4">
                <div class="col-12">
                    <label for="inputNom" class="form-label fw-semibold">NOM</label>
                    <input type="text" class="form-control form-control-lg" name="inputNom" id="inputNom" value="<?= $row['name'] ?>" required>
                </div>

                <div class="col-12">
                    <label for="inputNbEmploye" class="form-label fw-semibold">NB EMPLOYES</label>
                    <textarea class="form-control form-control-lg" name="inputNbEmploye" id="inputNbEmploye" rows="3" required><?= $row['number_of_employees'] ?></textarea>
                </div>

                <div class="col-12">
                    <label for="inputDomaine" class="form-label fw-semibold">DOMAINE</label>
                    <textarea class="form-control form-control-lg" name="inputDomaine" id="inputDomaine" rows="3" required><?= $row['industry'] ?></textarea>
                </div>

                <div class="col-12">
                    <label for="inputAdresse" class="form-label fw-semibold">Adresse</label>
                    <input type="text" class="form-control form-control-lg" name="inputAdresse" id="inputAdresse" value="<?= $row['address'] ?>" required>
                </div>

                <div class="col-12">
                    <label for="inputLatitude" class="form-label fw-semibold">LATITUDE</label>
                    <input type="text" class="form-control form-control-lg" name="inputLatitude" id="inputLatitude" value="<?= $row['latitude'] ?>" required>
                </div>

                <div class="col-12">
                    <label for="inputLongitude" class="form-label fw-semibold">LONGITUDE</label>
                    <input type="text" class="form-control form-control-lg" name="inputLongitude" id="inputLongitude" value="<?= $row['longitude'] ?>" required>
                </div>

                <div class="col-12">
                    <label for="inputDescription" class="form-label fw-semibold">DESCRIPTION</label>
                    <input type="text" class="form-control form-control-lg" name="inputDescription" id="inputDescription" value="<?= $row['description'] ?>" required>
                </div>

                <div class="col-12">
                    <label for="inputSiret" class="form-label fw-semibold">N_SIRET</label>
                    <input type="text" class="form-control form-control-lg" name="inputSiret" id="inputSiret" value="<?= $row['n_siret'] ?>" required>
                </div>

                <div class="col-12">
                    <label for="inputLogo" class="form-label fw-semibold">LOGO</label>
                    <input type="text" class="form-control form-control-lg" name="inputLogo" id="inputLogo" value="<?= $row['logo'] ?>" required>
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