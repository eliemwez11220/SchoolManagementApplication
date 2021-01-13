<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Application - Agile School Management </title>
    <!-- icon -->
    <link rel="icon" href="<?= base_url(); ?>resources/img/emar.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/style.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/addons/datatables.min.css" rel="stylesheet">
    <!-- DataTables Select CSS -->
    <link href="<?= base_url('resources/') ?>mdb-v2/css/addons/datatables-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('resources/') ?>plugins/bootstrap4.1.3/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


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
        .main-container{
            width:1000px;
            margin: auto;
            padding: 10px;

        }
    </style>
    <script type="text/javascript">
        function print_report() {
            window.print();
        }
        function ouvrir_onglet() {
            window.opener;
        }
    </script>
</head>
<body class="grey lighten-3 app sidebar-mini rtl">

<!--Main Navigation-->
<header>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar navbar navbar-dark danger-color-dark">
        <div class="container-fluid">

            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="#">
                <strong class="">Agile School Management</strong>
            </a>

            <!--            <a class="app-sidebar__toggle text-dark" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>-->

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                  <li class="nav-item">
                      <a class="nav-link waves-effect" href="<?php echo base_url(). 'main/'; ?>">
                          <i class="fa fa-home"></i> Accueil
                      </a>
                  </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="" target="_blank" data-toggle="modal"
                           data-target="#modalContactForm">
                            <i class="fa fa-question"></i> IT Support
                        </a>

                    </li>
                    <li data-toggle="tooltip" data-placement="bottom" class="nav-item dropdown">
                        <a class="nav-link waves-effect app-nav__item dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="app-sidebar__user-name text-capitalize text-s-on-small-only s-text">
                    <?= $this->session->username ?>
                </span>
                        </a>
                        <ul class="dropdown-menu settings-menu dropdown-menu-right">

                            <li><a class="dropdown-item" href="<?= base_url('main/logout'); ?>"><i
                                            class="fa fa-sign-out fa-lg"></i>Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->

    <div class="content main-container" style="margin-top: 70px;">
        <?php
        if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) { ?>
            <div class="container" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="row">
                    <h6 class="text-dark">
                        <?php include_once "application/views/alertes/alert-index.php"; ?>
                    </h6>
                </div>
            </div>
        <?php } ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <!-- Heading -->
                                <div class="card mb-4 wow fadeIn">
                                    <!--Card content-->
                                    <div class="card-body d-sm-flex justify-content-between">
                                        <h4 class="mb-2 mb-sm-0 pt-1">
                                            <span>Réinitialiser votre mot de passe</span>
                                        </h4>
                                    </div>
                                </div>
                                <!-- Heading -->
                            </div>
                            <div class="box-body">
                                <?php echo form_open(base_url('main/password_reset_via_email')); ?>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="" class="control-label"><span class="text-danger">*</span>Votre adresse email</label>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" <?= form_error('email') ? 'is-invalid' : 'is-valid'; ?>"/>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label"><span class="text-danger">*</span>Nouveau Mot de passe</label>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="nvo_mot_pass" <?= form_error('nvo_mot_pass') ? 'is-invalid' : 'is-valid'; ?>  minlength="6" maxlength="50"
                                                   value="<?= set_value('nvo_mot_pass'); ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label"><span class="text-danger">*</span>Confirmer le mot de passe</label>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="conf_mot_pass" <?= form_error('conf_mot_pass') ? 'is-invalid' : 'is-valid'; ?> minlength="6" maxlength="50"  value="<?= set_value('conf_mot_pass'); ?>"/>
                                        </div>
                                    </div>

                                </div>

                                <input type="submit" class="btn btn-outline-danger" value="Reinitialiser">
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <br><br><br><br><br><br><br><br><br>
    </div>

    <!-- AIDE-->
    <footer class="page-footer font-small wow fadeIn danger-color-dark fixed-bottom">
        <!-- Social icons -->
        <div class="pb-4">
            <!--Copyright-->
            <div class="footer-copyright py-3 text-light text-center">
                © 2019 - <?php echo date('Y'); ?> Copyright
                <a href="https://www.congoagile.net" target="_blank"> Congo Agile</a>
                <small>Informatique Vision Totale</small>
            </div>
            <!--/.Copyright-->
        </div>
        <!-- Social icons -->
    </footer>

    <!-- AIDE-->

    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <?php
            $tb = mb_split("/",current_url());
            $redirect = $tb[count($tb)-2]."/".$tb[count($tb)-1];
            ?>
            <form class="" action="<?= base_url(). 'main/aide/'.$redirect; ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Ecrivez-nous</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <i class="fas fa-user prefix grey-text"></i>
                            <input type="text" id="form34" name="name" class="form-control validate">
                            <label data-error="nom invalide" data-success="correct" for="form34">Votre nom complet</label>
                        </div>

                        <div class="md-form mb-5">
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input type="email" id="form29" name="email" class="form-control validate">
                            <label data-error="Votre addresse email est incorrecte" data-success="correct" for="form29">Votre adresse email</label>
                        </div>
                        <!---->
                        <div class="md-form mb-5">
                            <i class="fas fa-tag prefix grey-text"></i>
                            <input type="text" id="form32" name="subject" class="form-control validate">
                            <label data-error="" data-success="correct" for="form32">Sujet</label>
                        </div>
                        <!---->
                        <div class="md-form">
                            <i class="fas fa-pencil prefix grey-text"></i>
                            <textarea type="text" id="form8" name="issue" class="md-textarea form-control" rows="4"></textarea>
                            <label data-error="" data-success="correct" for="form8">Decrivez votre problème</label>
                        </div>

                    </div>
                    <div class="modal-footer d-flex">
                        <input type="submit" class="btn btn-danger btn-block"  value="Envoyer">
                    </div>
                </div>
            </form>
        </div>
    </div>


        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="<?= base_url('resources/') ?>mdb-v2/js/jquery-3.4.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="<?= base_url('resources/') ?>mdb-v2/js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="<?= base_url('resources/') ?>mdb-v2/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="<?= base_url('resources/') ?>mdb-v2/js/mdb.min.js"></script>

        <!-- DataTables JS -->
        <script src="<?= base_url('resources/') ?>mdb-v2/js/addons/datatables.min.js"></script>

        <!-- DataTables Select JS -->
        <script src="<?= base_url('resources/') ?>mdb-v2/js/addons/datatables-select.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>-->
        <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>-->

        <script type="text/javascript" src="<?= base_url(); ?>assets/js/alert.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/main.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/select2.min.js"></script>


        <script type="text/javascript">

            // Material Design example
            $(document).ready(function () {
                $('#dtMaterialDesignExample').DataTable();
                $('#dtMaterialDesignExample_wrapper').find('label').each(function () {
                    $(this).parent().append($(this).children());
                });
                $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
                    const $this = $(this);
                    $this.attr("placeholder", "Rechercher info");
                    $this.className("form-control-lg");
                    $this.removeClass('form-control-sm');
                });
                $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
                $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
                $('#dtMaterialDesignExample_wrapper select').removeClass(
                    'custom-select custom-select-sm form-control form-control-sm');
                $('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
                $('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
                $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
            });
        </script>

        <!-- Initializations -->
        <script type="text/javascript">
            // Animations initialization
            new WOW().init();
            //function for datatable
            $(function () {
                $('table').DataTable();
            });
        </script>

        <script type="text/javascript">
            if (document.location.hostname == 'pratikborsadiya.in') {
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                            (i[r].q = i[r].q || []).push(arguments)
                        }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
                ga('create', 'UA-72504830-1', 'auto');
                ga('send', 'pageview');
            }
            $('#demoDate').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
                todayHighlight: true
            });

            $('#demoSelect').select2();

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Datemask dd/mm/yyyy
                $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
                //Datemask2 mm/dd/yyyy
                $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
                //Money Euro
                $('[data-mask]').inputmask()

                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'})
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                    {
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function (start, end) {
                        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                    }
                )

                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                })

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                })
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                })
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                })

                //Colorpicker
                $('.my-colorpicker1').colorpicker()
                //color picker with addon
                $('.my-colorpicker2').colorpicker()

                //Timepicker
                $('.timepicker').timepicker({
                    showInputs: false
                })
            })
        </script>
        <!-- Charts -->


        <!--Google Maps-->
        <script src="https://maps.google.com/maps/api/js"></script>
        <script>
            // Regular map
            function regular_map() {
                var var_location = new google.maps.LatLng(40.725118, -73.997699);

                var var_mapoptions = {
                    center: var_location,
                    zoom: 14
                };

                var var_map = new google.maps.Map(document.getElementById("map-container"),
                    var_mapoptions);

                var var_marker = new google.maps.Marker({
                    position: var_location,
                    map: var_map,
                    title: ""
                });
            }

            $(".agence").click(function () {

                event.preventDefault();

                let agence = document.getElementsByClassName("agence").textContent;

                $.ajax({
                    url: "<?php echo base_url('Agent/Test');?>",

                    success: function (result) {

                        document.getElementsByClassName("agence").textContent = result;
                        document.getElementById("dtMaterialDesignExample").DataTable().ajax().reload();
                        //$("#div1").html(result);
                    },
                    error: function (error) {
                        alert("Une erreur est survenue");
                    }
                });
            });


        </script>
</body>

</html>
