

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>School Management | Login application</title>
    <!-- icon -->
    <link rel="icon" href="<?= base_url(); ?>resources/img/congoagile.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?= base_url('resources/') ?>css/AdminLTE.min.css">
    <!--    <link rel="stylesheet" href="--><?//= base_url('resources/') ?><!--css/bootstrap.min.css">-->
    <link rel="stylesheet" href="<?= base_url('resources/') ?>mdb/css/bootstrap.min.css">

    <style>

        .map-container{
            overflow:hidden;
            padding-bottom:56.25%;
            position:relative;
            height:0;
        }
        .map-container iframe{
            left:0;
            top:0;
            height:100%;
            width:100%;
            position:absolute;
        }
    </style>
    <!-- Theme style -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">
        body {
            font-family: Segoe UI, Roboto, sans-serif !important;
        }

        .bg-image {
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="hold-transition login-page bg-image"
style="background:cover; background-image: url('<?php echo base_url("resources/img/home_bg.jpg");?>');">

<div class="login-box">
   
   

    <!-- Material form login -->
    <div class="card border-primary">
 <!-- /.login-logo  -->
 <div class="login-logo card-header info-color white-text text-center  bg-primary">
        <a href="<?=base_url()?>" class="card-height-100">
            <img src="<?=base_url()?>resources/img/zad_learn.png" alt="School Finance App"
            class="w-25 h-25">
        </a>
    </div>


        <?php
        if (isset($page_error)) { ?>
            <div class="container" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="row">
                    <h6 class="small text-danger alert alert-light font-weight-bold text-center">
                        <?= $page_error; ?>
                    </h6>
                </div>
            </div>
        <?php } ?>
        <?php if (! empty($admin_exist)) { ?>
        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">
            <!-- Form -->
            <!--            --><?//= form_open(site_url('Main/Agent_login')) ?>
            <div class="text-center" style="color: #757575;" action="#!">
                <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                <form class="" action="<?= base_url(). 'main/login' ?>" method="post">
                    <!-- Email -->
                    <br/>
                    <div class="form-group">
                        <div class="md-form">
                            <input type="text" id="username" name="username" class="form-control bg-light border-primary" value="<?= set_value('username');?>" 
                            placeholder="Nom utilisateur"  autofocus style="border-radius: 100px;">
                            <!--                        <label for="materialLoginFormEmail">Username</label>-->
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <div class="md-form">
                            <input type="password" class="form-control bg-light border-primary" id="password" name="password" placeholder="Mot de passe" style="border-radius: 100px;">
                            <!--                        <label for="materialLoginFormPassword">Password</label>-->
                        </div>
                    </div>
                    
                        <div class="text-right">
                            <!-- Forgot password -->
                            <a href="<?php echo base_url(). 'main/reset_password'; ?>">Mot de passe oublié?</a>
                        </div>
                    
                    <input class="btn btn-primary btn-block" type="submit" value="SE CONNECTER" style="border-radius: 100px;"/>
                </form>
                <!-- Sign in button -->
            </div>
           
            <?=form_close()?>
            <!-- Form -->
            &nbsp;
            <div>
                <!-- Forgot password -->
                <a href="<?php echo base_url(). 'main/eleves'; ?>"
                  class="btn btn-info btn-block" style="border-radius: 100px;">Se connecter comme Elève</a>
            </div>
        </div>
        <?php } else {?>
            <div class="text-justify">
                <h5>Bienvenue dans l'application de gestion financières et comptables de paiements de frais et
                    de gestion des inscriptions des élèves ainsi que le managment de systèmes d'information.
                    <p>Veuillez configurer le compte administrateur pour démarrer l'application <b>School Finance</b>.</p></h5>
            </div>
            <div class="card-footer btn-primary text-center">
                <a href="<?php echo base_url(); ?>" class="btn btn-info"
                   data-toggle="modal" data-target=".modal-abonnement">Créer compte administrateur
                    <i class="fa fa-chevron-circle-right fa-lg"></i></a>
            </div>
        <?php } ?>
    </div>
    <!-- Material form login -->
</div>

<footer class="page-footer font-small wow fadeIn danger-color-dark fixed-bottom">
    <!-- Social icons -->
    <div class="pb-4">
        <!--Copyright-->
        <div class="footer-copyright py-3 text-light text-center">
            © 2019 - <?php echo date('Y'); ?> Copyright
            <a href="https://congoagile.com" target="_blank"> Trecazad Limited</a>
            <small>Agence digitale</small>
        </div>
        <!--/.Copyright-->
    </div>
    <!-- Social icons -->
</footer>
<!-- /.login-box -->
<div class="modal fade modal-abonnement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true" id="modal-abonnement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-uppercase bg-info text-light text-center">
                <h4 class="modal-title" id="exampleModalCenterTitle">
                    Configuration de l'administrateur
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?= site_url('main/creer_compte_admin'); ?>" method="post">
                            <div class="font-weight-bold">
                                <div class="form-group">
                                    <label class="control-label" id="nom_complet">Nom complet admin: </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-users"></i></div>
                                        </div>
                                        <input type="text" name="nom_complet" id="nom_complet" value="<?= set_value('nom_complet'); ?>"
                                               placeholder="Ex: EMAR RUCHI MOHAMED"
                                               class="form-control text-capitalize<?= (form_error('nom_complet')) ? 'is-invalid' : '' ?>" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Pseudonyme admin : </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                                        </div>
                                        <input type="text" name="username" id="username" value="<?= set_value('usename'); ?>"
                                               placeholder="Nom de connexion"
                                               class="form-control <?= (form_error('username')) ? 'is-invalid' : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Adresse email admin : </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i>@</i></div>
                                        </div>
                                        <input type="email" name="email" id="email" value="<?= set_value('email'); ?>"
                                               placeholder="Adresse e-mail admin"
                                               class="form-control <?= (form_error('email')) ? 'is-invalid' : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mot de passe :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                                        </div>
                                        <input type="password" name="password" id="password"
                                               placeholder="Créer votre mot de passe"
                                               class="form-control <?= (form_error('mot_de_passe')) ? 'is-invalid' : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Confirmation mot de passe :</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               placeholder="Confirmer votre mot de passe créé"
                                               class="form-control <?= (form_error('password_confirmation')) ? 'is-invalid' : '' ?>">
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-info">
                                    Créer compte administrateur
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery 3 -->
<script src="<?= base_url('resources/') ?>mdb/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('resources/') ?>mdb/js/bootstrap.min.js"></script>
<script src="<?= base_url('resources/') ?>mdb/js/mdb.min.js"></script>
<script src="<?= base_url('resources/') ?>mdb/js/popper.min.js"></script>
</body>
</html>
