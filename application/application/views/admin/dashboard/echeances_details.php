<!--Grid row-->
<div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-sm-12 mb-4">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h5 class="mb-2 mb-sm-0 pt-1 text-center text-uppercase font-weight-bold">
                    <a href="#" target="_blank">Détails des échéances</a>
                </h5>

            </div>

        </div>
        <!-- Heading -->
        <?php if (isset($passports)) { ?>

            <!--Card-->
            <div class="card">
                <div class="card-header text-uppercase text-center danger-color-dark text-light ">
                    Passeports à renouveler dans 90 jours
                </div>
                <!--Card content-->
                <div class="card-body">
                    <!-- tableau des echeances de passports -->
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-hover" id="dtMaterialDesignExample">
                            <thead class="danger-color-dark text-light lighten-4">
                            <tr>
                                <th class="text-center">#</th>
                                <th>N° Passport</th>
                                <!-- <th>Type Passport</th>
                                <th>Date delivrance</th>
                                <th>Lieu delivrance</th> -->
                                <th>Nationalite</th>
                                <th>Noms Visiteur</th>
                                <th>Département</th>
                                <th>Fin validite</th>
                                <th>Echéance</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 1;
                            //elements de calcul de la duree d'expiration
                            $date_jr = date('Y-m-d');
                            $date_fin_validite = '';
                            $calcul_jour = '';
                            $duree_echeance = '';
                            $echeances = 90;
                            foreach ($passports as $pp) {
                                //date d'expiration du visa
                                $date_fin_validite = $pp->date_fin_validite;
                                //calcul de jours qui reste si la date d'expiration du visa est superieur ou egale à la date du systeme
                                if ($date_fin_validite > $date_jr) {
                                    $d1 = new DateTime($pp->date_fin_validite);
                                    $d2 = new DateTime(date('Y/m/d'));
                                    $diff = $d1->diff($d2, true);
                                    //
                                    $duree_annee =  $diff->y;
                                    $duree_mois =  $diff->m;
                                    $duree_jours =  $diff->d;
                                    $total_mois = ($duree_annee * 12) + $duree_mois;
                                    $total_jours = ($total_mois * 30) + $duree_jours;
                                    if ($total_jours <= $echeances) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $count++; ?></td>
                                            <td class="text-uppercase"><?= $pp->passeport_numero; ?></td>
                                            <td class="text-capitalize"><?= $pp->nationalite; ?></td>
                                            <td class="text-capitalize"><?= $pp->visiteur_nom_complet; ?></td>
                                            <td class="text-capitalize"><?= $pp->departement_nom; ?></td>
                                            <td class="text-capitalize"
                                                style="font-weight: bold"><?= $pp->date_fin_validite; ?></td>
                                            <td class="text-capitalize text-danger" style="font-weight: bold">
                                                reste <?= $total_jours ?> jrs
                                            </td>
                                        </tr>
                                        <?php $total_rows = $count;
                                    }
                                } else {
                                    $duree_echeance = 0;
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/.Card-->
        <?php } ?>
        <!-- fin d'affichage des echeances de passporst -->
        <!-- Liste des echeances de visas à traiter dans 45 jours -->
        <?php if (isset($visas)) { ?>

            <!--Card-->
            <div class="card">
                <div class="card-header text-uppercase text-center danger-color-dark text-light">
                    Visas à renouveler dans 45 jours
                </div>
                <!--Card content-->
                <div class="card-body">
                    <!-- tableau des echeances de passports -->
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-hover" id="dtMaterialDesignExample">
                            <thead class="danger-color-dark text-light lighten-4">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Noms Visiteur</th>
                                <th>N° Passport</th>
                                <th>Nationalité</th>
                                <th>Type VISA</th>
                                <th>Date Obtention</th>
                                <th>Date Expiration</th>
                                <th>Echéance VISA</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($visas != "") {
                                $count = 1;
                                //elements de calcul de la duree d'expiration
                                $date_jour = date('Y-m-d');
                                $date_expiration = '';
                                $jours_calcul = '';
                                $duree_visa = '';
                                foreach ($visas as $visa) {
                                    //date d'expiration du visa
                                    $date_expiration = $visa->date_expire_visa;
                                    //calcul de jours qui reste si la date d'expiration du visa est superieur ou egale à la date du systeme
                                    if ($date_expiration > $date_jour) {
                                        //$jours_calcul = date_diff(new datetime ($date_jour), new datetime($date_expiration));
                                        $d1 = new DateTime($visa->date_expire_visa);
                                        $d2 = new DateTime(date('Y/m/d'));
                                        $diff = $d1->diff($d2, true);
                                        //
                                        $duree_annee =  $diff->y;
                                        $duree_mois =  $diff->m;
                                        $duree_jours =  $diff->d;
                                        $total_mois = ($duree_annee * 12) + $duree_mois;
                                        $tot_jours = ($total_mois * 30) + $duree_jours;
                                        //$duree_trouvee=$total_jours + $duree_jours;
                                        if (($tot_jours <= 45)) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $count++; ?></td>
                                                <td class="text-capitalize"><?= $visa->visiteur_nom_complet; ?></td>
                                                <td class="text-uppercase"><?= $visa->passeport_numero; ?></td>
                                                <td class="text-capitalize"><?= $visa->nationalite; ?></td>
                                                <td class="text-capitalize"><?= $visa->visa_nom; ?></td>
                                                <td class="text-capitalize"><?= $visa->date_obtention_visa; ?></td>
                                                <td class="text-capitalize"
                                                    style="font-weight: bold"><?= $visa->date_expire_visa; ?></td>
                                                <td class="text-capitalize text-danger" style="font-weight: bold">
                                                    Reste <?= $tot_jours; ?> jrs
                                                </td>
                                            </tr>
                                            <?php $total_rows = $count;
                                        }
                                    }
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/.Card-->
        <?php } ?>
        <!-- fin d'affichage des echeances de passporst --><!-- Liste des echeances de visas à traiter dans 45 jours -->
        <?php if (isset($cartes)) { ?>

            <!--Card-->
            <div class="card">
                <div class="card-header text-uppercase text-center danger-color-dark text-light ">
                    Cartes de travail à renouveler dans 90 jours
                </div>
                <!--Card content-->
                <div class="card-body">
                    <!-- tableau des echeances de passports -->
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-hover" id="dtMaterialDesignExample">
                            <thead class="blue-grey lighten-4">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Noms Visiteur</th>
                                <th>Département</th>
                                <th>Carte ID</th>
                                <th>Type Carte</th>
                                <th>Date Expiration</th>
                                <th>Echéance Carte</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($cartes != "") {
                                $count = 1;
                                //elements de calcul de la duree d'expiration
                                $date_jour = date('Y-m-d');
                                $date_expiration = '';
                                $jour_cal = '';
                                $duree_visa = '';
                                //boucle de donnees
                                foreach ($cartes as $carte) {
                                    //date d'expiration du visa
                                    $date_expiration = $carte->date_expiration;
                                    //calcul de jours qui reste si la date d'expiration du visa est superieur ou egale à la date du systeme
                                    if ($date_expiration > $date_jour) {
                                        //$calcul_jrs = date_diff(new datetime($date_expiration), new datetime ($date_jour));
                                        $d1 = new DateTime($carte->date_expiration);
                                        $d2 = new DateTime(date('Y-m-d'));
                                        $diff = $d1->diff($d2, true);
                                        //
                                        $duree_annee =  $diff->y;
                                        $duree_mois =  $diff->m;
                                        $duree_jours =  $diff->d;
                                        $total_mois = ($duree_annee * 12) + $duree_mois;
                                        $tot_jrs = ($total_mois * 30) + $duree_jours;
                                        if ($tot_jrs <= 90) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $count++; ?></td>
                                                <td class="text-capitalize"><?= $carte->visiteur_nom_complet; ?></td>
                                                <td class="text-capitalize"><?= $carte->departement_nom; ?></td>
                                                <td class="text-capitalize"><?= $carte->carte_numero ; ?></td>
                                                <td class="text-capitalize"><?= $carte->carte_type; ?></td>
                                                <td class="text-capitalize"
                                                    style="font-weight: bold"><?= $carte->date_expiration; ?></td>
                                                <td class="text-capitalize text-danger" style="font-weight: bold">
                                                    reste <?= $tot_jrs ?> jrs
                                                </td>
                                            </tr>
                                            <?php $total_rows = $count;
                                        }
                                    }
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/.Card-->
        <?php } ?>
        <!-- fin d'affichage des echeances de passporst -->
        <a href="<?= base_url() . "admin/dashboard/"; ?>" class="btn btn-danger btn-sm">
            <i class="fa fa-chevron-circle-left"></i> Revenir à la page précedente
        </a>
    </div>
    <!--Grid column-->
    <!--Grid column-->
</div>
<!--Grid row-->
