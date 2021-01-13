<!--Grid row-->
<div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-md-9 mb-4">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">
            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">
                <h5 class="mb-2 mb-sm-0 pt-1 text-center text-uppercase ">
                    Description du ratio des expatriés
                </h5>
            </div>
        </div>
        <!-- Heading -->
        <!--Card-->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="text-justify">
                    Notice: Le pourcentage du <b class="text-danger"> ratio de l'effectif expatrié</b> est obtenu à
                    partir du
                    nombre total des
                    agents MMG et du nombre total des expatriés ayant le statut
                    <b class="text-danger"> Employe</b> et dont leurs cartes de travail sont encore valides.
                    Ce pourcentage lorsqu'il atteint une valeur supérieure à 6.5, une alerte sera directment déclenchée
                    pour vous
                    prevenir.
                </h5>
            </div>
            <!--Card content-->
            <div class="card-body">
                <div class="col-sm-6 text-md-on-small-only text-center offset-sm-3">

                    <?php
                    $total_expatries = 0;
                    $count_expatries = 0;
                    //recherche du nombre des expatriés
                    foreach ($expatries as $carte) {
                        $date_expiration = $carte->date_expiration;
                        if ($carte->statut_nom == "Employe" && $carte->nationalite != "Congolaise") {
                            $date_jour = date('Y-m-d');
                            if ($date_expiration > $date_jour) {
                                $count_expatries++;
                                $total_expatries = $count_expatries;
                            }
                        }
                    }
                    //recherche du nombre des agents mmg à partir de la dernière mise à jour effectuée
                    $effectif_agents = 0;
                    foreach ($agents_effectifs as $agent) {
                        $effectif_agents = $agent->nombre_agent;
                    }
                    $coefficient = '';
                    $pre = 00;
                    $valeur = '';
                    if ($effectif_agents > 0) {
                        $coefficient = ($total_expatries * 100) / $effectif_agents;
                        if ($coefficient > 6.5) { ?>

                            <div class="img-fluid">
                                <span class="text-center display-4 text-danger">
                                    <?php
                                    $valeur = round($coefficient, $pre);
                                    echo $valeur; ?>
                                    <small style="font-size: 20px!important;">%</small>
                                    <marquee behavior="" direction="top">
                                        <small style="font-size: 20px!important;">Attention coefficient élevé</small>
                                    </marquee>
                                </span>
                            </div>
                            <hr>
                            <h4>Ratio Expatriés.</h4>
                        <?php } else { ?>
                            <div class="img-fluid">
                                <span class="text-center display-4 text-dark">
                                <?php
                                $valeur = substr($coefficient, 0, 3);
                                echo $valeur; ?>
                                    <small style="font-size: 30px!important;">%</small>
                            </span>
                            </div>
                            <hr>
                            <h4>Ratio Expatriés</h4>

                        <?php }
                    } ?>
                </div>
            </div>
        </div>
        <!--/.Card-->
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-3 mb-4">
        <!--Card for echeances-->
        <div class="card mb-4">
            <div class="card-body">
                <!-- List group links -->
                <div class="list-group list-group-flush">
                    <h4 class="text-uppercase">Effectifs</h4>
                    <a href="<?= base_url() . 'admin/ratio'; ?>"
                       class="list-group-item list-group-item-action waves-effect text-uppercase">Expatriés
                        <span class="badge badge-info badge-pill pull-right">
                            <?php
                            $total_rows = 0;
                            $count = 0;
                            $date_jour = date('Y-m-d');
                            foreach ($expatries as $carte) {
                                $date_expiration = $carte->date_expiration;
                                if ($carte->statut_nom == "Employe" && $carte->nationalite != "Congolaise") {
                                    $date_jour = date('Y-m-d');
                                    if ($date_expiration > $date_jour) {
                                        $count++;
                                        $total_rows = $count;
                                    }
                                }
                            }
                            echo $total_rows;
                            ?>
                        </span>
                    </a><a href="<?= base_url() . 'admin/ratio'; ?>"
                           class="list-group-item list-group-item-action waves-effect text-uppercase">agents MMG
                        <span class="badge badge-info badge-pill pull-right">
                            <?php
                            foreach ($agents_effectifs as $agent) {
                                echo $agent->nombre_agent;
                            }
                            ?>
                        </span>
                    </a>
                </div>
            </div>
            <!--/.Card-->
        </div>
        <!--Grid column-->
    </div>
    <!--Grid row-->
