<br><br><br><br>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
<?php endif; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <h1 class="text-center mb-4">Connexion</h1>
            <form action="" method="POST" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="inputEmail" id="inputEmail" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="inputMdp" class="form-label">Mot de passe</label>
                    <input type="password" name="inputMdp" id="inputMdp" class="form-control">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Se souvenir de moi !
                    </label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
                <div class="text-center mt-3">
                    <p>Vous n'avez pas de compte ? <a href="./views/pages/Inscription.html.php">Inscription !</a></p>
                    <p>Vous êtes une Compagnie ? <a href="./views/pages/NewCompany.html.php">Rejoignez-nous !</a></p>
                </div>
            </form>
        </div>
    </div>
</div>