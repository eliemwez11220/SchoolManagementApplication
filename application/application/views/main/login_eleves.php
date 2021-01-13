<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agile School Finance | Login Students</title>
    <!-- icon -->
    <link rel="icon" href="<?= base_url(); ?>resources/img/congoagile.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('resources/') ?>css/AdminLTE.min.css">

    <!--    <link rel="stylesheet" href="--><? //= base_url('resources/') ?><!--css/bootstrap.min.css">-->
    <link rel="stylesheet" href="<?= base_url('resources/') ?>mdb/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url('resources/') ?>mdb/css/mdb.min.css">
    <link rel="stylesheet" href="<?= base_url('resources/') ?>mdb/css/mdb.lite.css">
    <link rel="stylesheet" href="<?= base_url('resources/') ?>mdb/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('resources/') ?>css/font-awesome.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/style.min.css" rel="stylesheet">
    <style>

        .map-container {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-container iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
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
</head>
<body class="hold-transition" style="background-image: url('<?php echo base_url("resources/img/bg_two.jpg"); ?>');">
<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url() ?>" class="card-height-100">
            <img src="<?= base_url() ?>resources/img/zad_learn.png" alt="School Finance App"
                 class="w-25 h-50">
        </a>
    </div>
    <!-- /.login-logo -->
    <?php
    if (isset($page_error)) { ?>
        <div class="container" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="row">
                <h6 class="text-danger alert alert-light font-weight-bold text-center">
                    <?= $page_error; ?>
                </h6>
            </div>
        </div>
    <?php } ?>
    <!-- Material form login -->
    <div class="card border-primary">

        <h5 class="card-header bg-primary white-text text-center py-4 text-uppercase">
            <strong> FLORA College School</strong>
            <small>Authentification des élèves</small>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">
            <div class="text-center" style="color: #757575;" action="#!">
                <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                <form class="" action="<?= base_url() . 'main/login_eleves' ?>" method="post">
                    <!-- Email -->
                    <div class="md-form">
                        <input type="text" id="matricule" name="matricule" class="form-control" autofocus
                               value="<?= set_value('matricule'); ?>">
                        <label for="materialLoginFormEmail"> Saisissez votre numéro matricule</label>
                    </div>
                    <?= form_error('matricule', '<em class="text-danger">', '</em>') ?><br/>
                    <button class="btn btn-primary btn-block" type="submit"
                            value="Se connecter">Se connecter
                    </button>
                </form>
                <!-- Sign in button -->
                <br>
                <a href="<?php echo base_url() . 'main/'; ?>" class="btn btn-danger btn-block">Accueil</a>

            </div>
            <?php
            echo "<b class='text text-red'>" . $this->session->error_login . "</b>"; ?>
            <?= form_close() ?>
            <!-- Form -->

        </div>

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
<!-- jQuery 3 -->
<script src="<?= base_url('resources/') ?>mdb/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('resources/') ?>mdb/js/bootstrap.min.js"></script>
<script src="<?= base_url('resources/') ?>mdb/js/mdb.min.js"></script>
<script src="<?= base_url('resources/') ?>mdb/js/popper.min.js"></script>
</body>
</html>
