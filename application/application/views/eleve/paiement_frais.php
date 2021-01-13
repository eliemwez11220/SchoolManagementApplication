<?php
if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) { ?>
<div class="container" style="margin-top: 10px;margin-bottom: 10px;">
    <div class="row">
        <h6 class="text-dark">
            <?php include_once "application/views/alertes/alert-index.php"; ?>
        </h6>
    </div>
</div>
<?php } ?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->eleve; ?></b></span>
                        <div class="col-md-14">
                            <aside class="profile-nav alt">
                                <section class="card">
                                    <div class="card-header user-header alt danger-color-dark">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="text-light text-uppercase font-weight-bold">
                                                   Vos coordonnées d'identification
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="vue-lists text-uppercase">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <i class="fa fa-user"></i> Nom complet :
                                                        <span><b><?= $eleve['nom_complet'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-tasks"></i> Numéro matricule :
                                                        <span><b><?= $eleve['matricule_eleve'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-venus-double"></i> Genre :
                                                        <span><b><?= $eleve['genre'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-envelope-square"></i> Email Address:
                                                        <span><b class="text-lowercase"><?= $eleve['email'] ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <i class="fa fa-user"></i> Classe :
                                                        <span><b><?= $inscriptions['nom_classe'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-tasks"></i> Option suivie :
                                                        <span><b><?= $inscriptions['nom_option'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-venus-double"></i> Section d'étude:
                                                        <span><b><?= $inscriptions['nom_section'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-envelope-square"></i> Cycle scolaire:
                                                        <span><b class="text-lowercase"><?= $inscriptions['cycle'] ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </aside>
                        </div>

                        <br><br>

                    </div><!-- .row -->
                    <!-- tables -->
                    <?php if (isset($paiements)) { ?>

                        <!--Card-->
                        <div class="card">
                            <div class="card-header user-header alt danger-color-dark">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="text-light text-uppercase font-weight-bold">
                                            Mes paiements de frais
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!--Card content-->
                            <div class="card-body">
                                <!-- tableau des echeances de passports -->
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-hover"
                                           id="dtMaterialDesignExample">
                                        <thead class="danger-color-dark text-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Code validation</th>
                                            <th>Date paiement</th>
                                            <th>Montant payé</th>
                                            <th>Type frais</th>
                                            <th>Mois payé</th>
                                            <th>Reste</th>
                                            <th>Solde</th>
                                            <th>Mode</th>
                                            <th>Statut</th>
                                            <th>Année scolaire</th>
                                            <th>Numéro expéditeur</th>
                                            <th>Nom expéditeur</th>
                                            <th>Date d'envoi</th>
                                            <th>Service money</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($paiements != "") {
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($paiements as $carte) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $count++; ?></td>
                                                    <td class="text-uppercase"><?= $carte->code_validation; ?></td>
                                                    <td class="text-capitalize"><?= $carte->date_paiement; ?></td>
                                                    <td class="text-capitalize"><?= $carte->montant_paye.' '.$carte->devise; ?></td>
                                                    <td class="text-capitalize"><?= $carte->type_frais; ?></td>
                                                    <td class="text-capitalize"><?= $carte->mois; ?></td>
                                                    <td class="text-capitalize"><?= $carte->montant_restant; ?></td>
                                                    <td class="text-capitalize"><?= $carte->montant_complet; ?></td>
                                                    <td class="text-capitalize"><?= $carte->mode_paiement; ?></td>
                                                    <td class="text-capitalize"><?= $carte->statut_paiement; ?></td>
                                                    <td class="text-capitalize"><?= $carte->annee_scolaire; ?></td>
                                                    <td class="text-capitalize"><?= $carte->numero_expediteur; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nom_expediteur; ?></td>
                                                    <td class="text-capitalize"><?= $carte->date_envoi; ?></td>
                                                    <td class="text-capitalize"><?= $carte->service_mobile; ?></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.Card-->
                    <?php } ?>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </section><!-- /#right-panel -->
</div><!-- /#right-panel -->
