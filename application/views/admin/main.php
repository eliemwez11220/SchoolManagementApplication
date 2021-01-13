<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin - School Application </title>
    <!-- icon -->
    <link rel="icon" href="<?= base_url(); ?>resources/img/congoagile.png">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/main.css">
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

    <link rel="stylesheet" type="text/css"
          href="<?= base_url('resources/') ?>plugins/bootstrap4.1.3/daterangepicker.css"/>
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


    </style>

</head>
<body class="grey lighten-3 app sidebar-mini rtl">

<!--Main Navigation-->
<header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar navbar navbar-dark danger-color-dark app-header">
        <div class="container-fluid">

            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="<?php echo base_url() . 'admin/dashboard'; ?>">
                <strong>School App</strong>
            </a>
            <a class="navbar-toggler app-sidebar__toggle" type="button" data-toggle="sidebar" href=""
                   aria-label="Hide Sidebar">
                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </a>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <!--                        <a href="#" class="nav-link waves-effect">-->
                        <!--                            <i class="fas fa-question"></i> Aide-->
                        <!--                        </a>-->

                        <a class="nav-link waves-effect" href="" target="_blank" data-toggle="modal"
                           data-target="#modalContactForm">
                            <i class="fa fa-question"></i> IT Support
                        </a>

                    </li>

                    <li data-toggle="tooltip" data-placement="bottom" class="nav-item dropdown">
                        <a class="nav-link waves-effect app-nav__item dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="app-sidebar__user-name text-capitalize text-s-on-small-only s-text">
                    <?= $this->session->fullname ?>
                </span>
                        </a>
                        <ul class="dropdown-menu settings-menu dropdown-menu-right">
                            <li><a class="dropdown-item"
                                   href="<?= base_url('admin/vue_profil'); ?>">
                                    Editer profil</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin/logout'); ?>"><i
                                            class="fa fa-sign-out fa-lg"></i>Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->

    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="position-fixed danger-color-dark app-sidebar" style="color: white">

       <div class="text-center">
            <!--
                 <a class="logo-wrapper waves-effect">
            <img src="<?= base_url() ?>resources/img/zad_learn.png" alt="School Management"
                 class="img-fluid h-50 w-100 text-center">
        </a>
            -->
       
        </div>
        <div class="list-group list-group-flush ">
            <a href="<?php echo base_url() . 'admin/dashboard'; ?>"
               class="danger-color-dark text-light list-group-item  <? if ($active = 'active') ?> list-group-item-action waves-effect <?php echo (uri_string() == 'admin/Dashboard' || uri_string() == 'admin/dashboard') ? "active" : ""; ?>"><i
                        class="fas fa-chart-line"></i> <strong style="color: #ffffff;">Tableau de bord</strong></a>
            <a href=" <?php echo base_url() . 'admin/agent'; ?>"
               class="danger-color-dark text-light list-group-item list-group-item-action waves-effect <?php echo (uri_string() == 'admin/agent') ? "active" : ""; ?>">
                <i class="far fa-address-card"></i> <strong style="color: #ffffff;">Gestion Utilisateurs</strong></a>

            <a href="<?php echo base_url('admin/classe'); ?>"
               class="danger-color-dark text-light list-group-item list-group-item-action waves-effect <?php echo (uri_string() == 'admin/classe') ? "active" : ""; ?>"><i
                        class="fas fa-bezier-curve"></i> <strong style="color: #ffffff;">Gestion Classes</strong></a>
            <a href="<?php echo base_url('admin/section'); ?>"
               class="danger-color-dark text-light list-group-item list-group-item-action waves-effect <?php echo (uri_string() == 'admin/section') ? "active" : ""; ?>"><i
                        class="fas fa-list-ol"></i> <strong style="color: #ffffff;">Gestion Sections</strong></a>
            <a href="<?php echo base_url('admin/option'); ?>"
               class="danger-color-dark text-light list-group-item list-group-item-action waves-effect <?php echo (uri_string() == 'admin/agence') ? "active" : ""; ?>"><i
                        class="fas fa-bezier-curve"></i> <strong style="color: #ffffff;">Gestion Options</strong></a>

            <a href="<?php echo base_url('admin/logout'); ?>"
               class="danger-color-dark text-light list-group-item list-group-item-action waves-effect"
               onclick="return confirm('Voulez-vous vraiment fermer la session ? notez que toutes les opéations encours seront annulées') ">
                <i class="fas fa-lock"></i> <strong style="color: #ffffff;">Deconnexion</strong></a>
        </div>

    </aside>
    <!-- Sidebar -->

</header>
<!--Main Navigation-->

<main class="app-content" role="main">
    <div class="container-fluid mt-4">
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
        <!-- include the view -->
        <?php
        if (isset($view)) {
            $this->load->view($view);
        }
        ?>
    </div>
</main>
<!--Main layout-->
<footer class="page-footer text-center font-small mt-4  bg-danger">
    <!-- Social icons -->
    <div class="pb-4">
        <!--Copyright-->
        <div class="footer-copyright py-3">
            © 2019 - <?php echo date('Y'); ?> Copyright
            <a href="https://www.congoagile.net" target="_blank" class="text-uppercase"> Congo Agile</a>
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
        $tb = mb_split("/", current_url());
        $redirect = "";
        for ($i = 2; $i < count($tb); $i++) {
            $redirect = $redirect . $tb[$i] . "/";
        }
        ?>
        <form class="" action="<?= base_url() . 'Main/aide_super_admin/' . $redirect; ?>" method="post">
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
                        <input type="text" id="form34" name="name" class="form-control validate text-capitalize"
                               value=" <?= $this->session->fullname ?>">
                        <label data-error="nom invalide" data-success="correct" for="form34">Votre nom complet</label>
                    </div>

                    <div class="md-form mb-5">
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <input type="email" id="form29" name="email" class="form-control validate"
                               value=" <?= $this->session->email ?>">
                        <label data-error="Votre addresse email est incorrecte" data-success="correct" for="form29">Votre
                            adresse email</label>
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
                        <textarea type="text" id="form8" name="issue" class="md-textarea form-control"
                                  rows="4"></textarea>
                        <label data-error="" data-success="correct" for="form8">Decrivez votre problème</label>
                    </div>

                </div>
                <div class="modal-footer d-flex">
                    <input type="submit" class="btn btn-danger btn-block" value="Envoyer">
                </div>
            </div>
        </form>
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
                $this.attr("placeholder", "Recherche ...");
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
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                format: 'MM/DD/YYYY h:mm A'
            })
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
    <script>

        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"],
                datasets: [{
                    label: 'Rapport annuel de traitement des inscriptions de <?= date('Y');?>',
                    data: [<?= $demandes_par_mois[0];?>, <?= $demandes_par_mois[1];?>,<?= $demandes_par_mois[2];?>, <?= $demandes_par_mois[3];?>,
                        <?= $demandes_par_mois[4];?>, <?= $demandes_par_mois[5];?>,<?= $demandes_par_mois[6];?>,<?= $demandes_par_mois[7];?>,
                        <?= $demandes_par_mois[8];?>,<?= $demandes_par_mois[9];?>,<?= $demandes_par_mois[10];?>,<?= $demandes_par_mois[11];?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        //line
        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"],

                datasets: [{
                    label: "Demande encours",
                    backgroundColor: [
                        'rgba(105, 0, 132, .2)',
                    ],
                    borderColor: [
                        'rgba(200, 99, 132, .7)',
                    ],
                    borderWidth: 2,
                    //data: [65, 59, 80, 81, 56, 55, 59, 80, 81, 56, 55, 40]
                    data: [<?= $demandes_par_mois[0];?>, <?= $demandes_par_mois[1];?>,<?= $demandes_par_mois[2];?>, <?= $demandes_par_mois[3];?>,
                        <?= $demandes_par_mois[4];?>, <?= $demandes_par_mois[5];?>,<?= $demandes_par_mois[6];?>,<?= $demandes_par_mois[7];?>,
                        <?= $demandes_par_mois[8];?>,<?= $demandes_par_mois[9];?>,<?= $demandes_par_mois[10];?>,<?= $demandes_par_mois[11];?>],

                },
                    {
                        label: "Demandes traitées",
                        backgroundColor: [
                            'rgba(0, 137, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(0, 10, 130, .7)',
                        ],data: [<?= $demandes_par_mois[0];?>, <?= $demandes_par_mois[1];?>,<?= $demandes_par_mois[2];?>, <?= $demandes_par_mois[3];?>,
                            <?= $demandes_par_mois[4];?>, <?= $demandes_par_mois[5];?>,<?= $demandes_par_mois[6];?>,<?= $demandes_par_mois[7];?>,
                            <?= $demandes_par_mois[8];?>,<?= $demandes_par_mois[9];?>,<?= $demandes_par_mois[10];?>,<?= $demandes_par_mois[11];?>],


                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>


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
