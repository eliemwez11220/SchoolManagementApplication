
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Error Application - Agile School Management </title>
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
                        <a class="nav-link waves-effect" href="" target="_blank" data-toggle="modal"
                           data-target="#modalContactForm">
                            <i class="fa fa-question"></i> IT Support
                        </a>

                    </li>

                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->


    <div class="text-center text-secondary" style="padding: 50px;">

        <h1 class="display-1 text-danger font-title font-weight-bold">404</h1>
        <h3 class="display-4 font-title text-danger font-weight-bold">Page non trouvée</h3>

        <h4 class="text-danger">
            La page que vous tentez d'afficher n'existe pas ou une autre erreur s'est produite.
        </h4>
        <h4>
            Vous pouvez revenir à <a class="text-danger font-weight-bold" href="javascript:history.back()">la page précédente</a> ou aller à
            <a class="text-danger font-weight-bold" href="/">la page d'accueil</a>.
        </h4>

    </div>

    <!-- les fenetres pop-up modals -->
    <!-- Infos ratio -->
    <!-- AIDE-->

    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <?php
            $tb = mb_split("/",current_url());
            $redirect = $tb[count($tb)-2]."/".$tb[count($tb)-1];
            ?>
            <form class="" action="<?= base_url(). 'Main/aide/'.$redirect; ?>" method="post">
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
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin","Juillet","Août","Septembre","Octobre","Novembre","Decembre"],
                datasets: [{
                    label: '# Statistique de visa de  <?= date('Y');?>',
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

