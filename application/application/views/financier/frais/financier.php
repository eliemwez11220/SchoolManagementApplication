

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-home"></i> Page d'accueil</h1>
            <p>Gestion des opérations comptables et financières sur l'apurement de paiement des frais académiques ISS/Lubumbashi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Page d'accueil</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="container-fluid">
            <?php include_once ("application/views/auth/alert.php"); ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Nom d'utilisateur : <?= $data['ut']->nom_ut;?></h3>
                <div class="tile-body text-justify">
                    L'institut superieur de statistique étant une organisation ordonnée de grande renommée, mérite d'être doté des moyens et outils
                    modernes des nouvelles technologies de l'information et de la communication afin de garantir au mieux la gestion de ses divers
                    processus internes.
                </div>
                <div class="tile-body text-justify">
                    Soyez attentifs aux interactions y afferant, car toute manipulation prise en compte, impacte le système entier.
                </div>
                <div class="tile-footer"><a class="btn btn-outline-danger" href="<?= base_url('auth/deconnexion');?>"> <span class="fa fa-sign-out"></span> Déconnexion</a></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Détails du role <?= $data['ut']->role_ut;?></h3>
                </div>
                <div class="tile-body text-justify">
                    Entant que secrétaire général académique de l'Iss, vous avez comme mission principale l'identification de tous les étudiants de l'institut.
                    Vos privilèges, vous permettent soit d'ajouter un nouvel étudiant, soit d'en supprimer ou soit d'apporter certaines modifications sur ses coordonnées.
                    les fonctionnalités de votre role, sont situées à votre gauche de l'écran, vous pouvez cliquer sur un des onglets pour voir cela!

                </div>
            </div>
        </div>

    </div>
</main>