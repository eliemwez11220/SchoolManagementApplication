<!--Grid row-->
<div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-md-12 mb-4">
        <!-- Heading -->

        <!--Card-->
        <div class="card">
            <!--Card content-->
            <div class="card-header bg-light">
                <div class="row">
                    <div class="pull-left col-sm-9">
                        <h3 class="text-left font-weight-bold text-uppercase py-4"><i class="fa fa-home "></i>
                            Traitement Demandes Visa</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Table  -->
                    <table id="dtMaterialDesignExample" class="table-sm table table-hover table-striped">
                        <thead class="danger-color-dark text-light lighten-4">
                        <tr>
                            <th>ID</th>
                            <th>Noms</th>
                            <th>Passeport</th>
                            <th>Agence</th>
                            <th>Dépôt</th>
                            <th>Retrait</th>
                            <th>Réception</th>
                            <th>Date envoi</th>
                            <th>VISA</th>
                            <th>Coût</th>
                            <th>Durée en Jrs</th>
                        </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>

                        <?php
                        if (isset($recus)) {
                            $count_recus = 1;
                            foreach ($recus as $visa_recus) {
                                $date_recus = $visa_recus->date_reception_visa;
                                $depot = $visa_recus->date_depot_visa;
                                if (!empty($date_recus) && ($depot == '' | $depot == '0000-00-00')) {?>
                                    <tr>
                                        <td><?= $count_recus++; ?></td>
                                        <td class="text-uppercase"><?= $visa_recus->visiteur_nom_complet; ?></td>
                                        <td><?= $visa_recus->passeport_numero; ?></td>
                                        <td><?= $visa_recus->agence_nom; ?></td>
                                        <td><?= $visa_recus->date_depot_visa; ?></td>
                                        <td><?= $visa_recus->date_retrait_visa; ?></td>
                                        <td class="text-danger"><?= $visa_recus->date_reception_visa; ?></td>
                                        <td><?= $visa_recus->date_envoi_visa; ?></td>
                                        <td><?= $visa_recus->visa_nom; ?></td>
                                        <td><?= $visa_recus->demande_cout_visa; ?></td>
                                        <!--  !-- traitement des dates -->
                                        <?php
                                        $d1 = new DateTime($visa_recus->date_reception_visa);
                                        $d2 = new DateTime(date('Y/m/d'));
                                        $diff = $d1->diff($d2, true);
                                        $nb_ans = $diff->y;
                                        $nb_mois = $diff->m;
                                        $nb_jrs = $diff->d;
                                        //total de jours calculés
                                        $total_mois = ($nb_ans * 12) + $nb_mois;
                                        $total_jours = ($total_mois * 30) + $nb_jrs;
                                        ?>
                                        <td style="<?= $total_jours > 30 ? 'color: green' : 'color: red'; ?>">
                                            <b><?= $total_jours; ?></b></td>

                                    </tr>
                                <?php }
                            };
                        } elseif (isset($traitees)) {
                            $count_traitees = 1;
                            foreach ($traitees as $visa_traitee) {
                                if (($visa_traitee->date_envoi_visa == '' | $visa_traitee->date_envoi_visa =='0000-00-00') &&
                                    !empty($visa_traitee->date_retrait_visa)) {?>
                                    <tr>
                                        <td><?= $count_traitees++; ?></td>
                                        <td class="text-uppercase"><?= $visa_traitee->visiteur_nom_complet; ?></td>
                                        <td><?= $visa_traitee->passeport_numero; ?></td>
                                        <td><?= $visa_traitee->agence_nom; ?></td>
                                        <td><?= $visa_traitee->date_depot_visa; ?></td>
                                        <td class="text-danger"><?= $visa_traitee->date_retrait_visa; ?></td>
                                        <td><?= $visa_traitee->date_reception_visa; ?></td>
                                        <td><?= $visa_traitee->date_envoi_visa; ?></td>
                                        <td><?= $visa_traitee->visa_nom; ?></td>
                                        <td><?= $visa_traitee->demande_cout_visa; ?></td>
                                        <!--  !-- traitement des dates -->
                                        <?php
                                        $d1 = new DateTime($visa_traitee->date_reception_visa);
                                        $d2 = new DateTime(date('Y/m/d'));
                                        $diff = $d1->diff($d2, true);
                                        $nb_ans = $diff->y;
                                        $nb_mois = $diff->m;
                                        $nb_jrs = $diff->d;
                                        //total de jours calculés
                                        $total_mois = ($nb_ans * 12) + $nb_mois;
                                        $total_jours = ($total_mois * 30) + $nb_jrs;
                                        ?>
                                        <td style="<?= $total_jours > 30 ? 'color: green' : 'color: red'; ?>">
                                            <b><?= $total_jours; ?></b></td>

                                    </tr>
                                <?php }
                            }
                        } elseif (isset($livrees)) {
                            $count_livrees = 1;
                            $annee_encours = date('Y');
                            foreach ($livrees as $visa_livree) {

                                //Recuperation de l'annee encours
                                $calcul = new datetime($visa_livree->date_envoi_visa);
                                $annee_livrees = $calcul->format("Y");
                                if ($annee_livrees == $annee_encours) {
                                $retirait_livrees = $visa_livree->date_retrait_visa;
                                $livrees_livrees = $visa_livree->date_envoi_visa;
                                $depot_livrees = $visa_livree->date_depot_visa;
                                if (!empty($retirait_livrees) && !empty($livrees_livrees) && !empty($depot_livrees)) { ?>
                                    <tr>
                                        <td><?= $count_livrees++; ?></td>
                                        <td class="text-uppercase"><?= $visa_livree->visiteur_nom_complet; ?></td>
                                        <td><?= $visa_livree->passeport_numero; ?></td>
                                        <td><?= $visa_livree->agence_nom; ?></td>
                                        <td><?= $visa_livree->date_depot_visa; ?></td>
                                        <td><?= $visa_livree->date_retrait_visa; ?></td>
                                        <td><?= $visa_livree->date_reception_visa; ?></td>
                                        <td class="text-danger"><?= $visa_livree->date_envoi_visa; ?></td>
                                        <td><?= $visa_livree->visa_nom; ?></td>
                                        <td><?= $visa_livree->demande_cout_visa; ?></td>
                                        <!--  !-- traitement des dates -->
                                        <?php
                                        $d1 = new DateTime($visa_livree->date_reception_visa);
                                        $d2 = new DateTime($visa_livree->date_retrait_visa);
                                        $diff = $d1->diff($d2, true);
                                        $nb_ans = $diff->y;
                                        $nb_mois = $diff->m;
                                        $nb_jrs = $diff->d;
                                        //total de jours calculés
                                        $total_mois = ($nb_ans * 12) + $nb_mois;
                                        $total_jours = ($total_mois * 30) + $nb_jrs;
                                        ?>
                                        <td style="<?= $total_jours > 30 ? 'color: green' : 'color: red'; ?>">
                                            <b><?= $total_jours; ?></b></td>

                                    </tr>
                                <?php }
                            }
                            }
                        } elseif (isset($encours)) {
                            $count_encours = 1;
                            foreach ($encours as $visa_encours) {
                                if (($visa_encours->date_retrait_visa == '' | $visa_encours->date_retrait_visa =='0000-00-00') &&
                                    ($visa_encours->date_envoi_visa == '' | $visa_encours->date_envoi_visa == '0000-00-00') &&
                                    !empty($visa_encours->date_depot_visa)) {?>
                                    <tr>
                                        <td><?= $count_encours++; ?></td>
                                        <td class="text-uppercase"><?= $visa_encours->visiteur_nom_complet; ?></td>
                                        <td><?= $visa_encours->passeport_numero; ?></td>
                                        <td><?= $visa_encours->agence_nom; ?></td>
                                        <td class="text-danger"><?= $visa_encours->date_depot_visa; ?></td>
                                        <td><?= $visa_encours->date_retrait_visa; ?></td>
                                        <td><?= $visa_encours->date_reception_visa; ?></td>
                                        <td><?= $visa_encours->date_envoi_visa; ?></td>
                                        <td><?= $visa_encours->visa_nom; ?></td>
                                        <td><?= $visa_encours->demande_cout_visa; ?></td>
                                        <!--  !-- traitement des dates -->
                                        <?php
                                        $d1 = new DateTime($visa_encours->date_reception_visa);
                                        $d2 = new DateTime(date('Y/m/d'));
                                        $diff = $d1->diff($d2, true);
                                        $nb_ans = $diff->y;
                                        $nb_mois = $diff->m;
                                        $nb_jrs = $diff->d;
                                        //total de jours calculés
                                        $total_mois = ($nb_ans * 12) + $nb_mois;
                                        $total_jours = ($total_mois * 30) + $nb_jrs;
                                        ?>
                                        <td style="<?= $total_jours > 30 ? 'color: green' : 'color: red'; ?>">
                                            <b><?= $total_jours; ?></b></td>

                                    </tr>
                                <?php }
                            };
                        }
                        //Affichage de toutes les demandes effectuées dans une meme agence
                        if (isset($agences_visas)) {
                            $count = 1;
                            if ($agences_visas != '') {
                                foreach ($agences_visas as $agences_visa):
                                    if (($agences_visa->date_envoi_visa == '' | $agences_visa->date_envoi_visa == '0000-00-00') |
                                        ($agences_visa->date_retrait_visa == '' | $agences_visa->date_retrait_visa == '0000-00-00') |
                                        ($agences_visa->date_depot_visa == '' | $agences_visa->date_depot_visa == '0000-00-00')) { ?>
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td class="text-uppercase"><?= $agences_visa->visiteur_nom_complet; ?></td>
                                            <td><?= $agences_visa->passeport_numero; ?></td>
                                            <td><?= $agences_visa->agence_nom; ?></td>
                                            <td><?= $agences_visa->date_depot_visa; ?></td>
                                            <td><?= $agences_visa->date_retrait_visa; ?></td>
                                            <td><?= $agences_visa->date_reception_visa; ?></td>
                                            <td><?= $agences_visa->date_envoi_visa; ?></td>
                                            <td><?= $agences_visa->visa_nom; ?></td>
                                            <td><?= $agences_visa->demande_cout_visa; ?></td>
                                            <!--  !-- traitement des dates -->
                                            <?php
                                            $d1 = new DateTime($agences_visa->date_reception_visa);
                                            $d2 = new DateTime(date('Y/m/d'));
                                            $diff = $d1->diff($d2, true);
                                            $nb_ans = $diff->y;
                                            $nb_mois = $diff->m;
                                            $nb_jrs = $diff->d;
                                            //total de jours calculés
                                            $total_mois = ($nb_ans * 12) + $nb_mois;
                                            $total_jours = ($total_mois * 30) + $nb_jrs;
                                            ?>
                                            <td style="<?= $total_jours > 30 ? 'color: green' : 'color: red'; ?>">
                                                <b><?= $total_jours; ?></b></td>

                                        </tr>
                                    <?php }
                                endforeach;
                            }
                        } ?>
                        </tbody>
                        <!-- Table body -->
                    </table>
                    <!-- Table  -->
                </div>
            </div>
            <!--/.Card-->
        </div>
        <a href="<?= base_url() . "admin/dashboard/"; ?>" class="btn btn-danger btn-sm">
            <i class="fa fa-chevron-circle-left"></i> Revenir à la page précedente
        </a>
        <!--Grid column-->
    </div>
</div>
