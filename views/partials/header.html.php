<!doctype html>
<html lang="fr" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Gestion</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../../css/styles.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <h2><?php if (isset($_SESSION['new_nom'])): ?>
                        <span class="navbar-text text-white me-3">
                            Bonjour, <?= htmlspecialchars($_SESSION['new_nom']) ?> !
                        </span>
                    <?php else: ?>
                        <span class="navbar-text text-white me-3">
                            Bonjour, invité !
                        </span>
                    <?php endif; ?>
                </h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">

                        <li class="nav-item">
                            <a class="nav-link <?php echo !empty($homepage) ? "active" : "" ?>" aria-current="page" href="./homepage.html.php">ACCUEIL</a>
                        </li>

                        <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'company'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo !empty($offre) ? "active" : "" ?>" href="../pages/mesOffres.php">MES OFFRES</a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'client' || $_SESSION['new_role'] === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo !empty($offre) ? "active" : "" ?>" href="./Nosoffres.php">NOS OFFRES</a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'client' || $_SESSION['new_role'] === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo !empty($company) ? "active" : "" ?>" href="./Company.php">NOS COMPAGNIES</a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'company'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo !empty($company) ? "active" : "" ?>" href="../pages/maCompany.php">MA COMPAGNIE</a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo !empty($dashboard) ? "active" : "" ?>" href="../pages/Dashboard.html.php">DASHBOARD</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo !empty($contact) ? "active" : "" ?>" href="./contact.php">CONTACT</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo !empty($profil) ? "active" : "" ?>" href="./profil.html.php">PROFIL</a>
                        </li>

                    </ul>
                    <div class="d-flex">
                        <a href="../../includes/Deconnexion.php"><button class="btn btn-outline-success" type="submit">SE DECONNECTER</button></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>