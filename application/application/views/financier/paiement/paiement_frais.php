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
                    <!-- tables -->
                    <?php if (isset($paiements)) { ?>

                        <!--Card-->
                        <div class="card">
                            <div class="card-header user-header alt danger-color-dark">
                                <div class="media">
                                    <div class="media-body">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <h4 class="text-light text-uppercase font-weight-bold">
                                                   Les paiements de frais par des élèves
                                               </h4>
                                           </div>
                                           <div class="col-md-8 float-right">

                                            <form class="form-inline" method="post" action="<?= base_url(). 'financier/paiement' ?>">

                                                <div class="form-group" style="width: 80%!important;">

                                                    <?php $array_periodes  = array(); foreach ($periodes as $periode) :

                                                        $array_periodes[$periode->annee_scolaire] = $periode->annee_scolaire;

                                                    endforeach; ?>

                                                    <?=
                                                    form_dropdown('annee_scolaire', $array_periodes, $select,
                                                        array(
                                                            'class' => 'browser-default custom-select col-md-6',
                                                            'data-toggle' => 'tooltip',
                                                            'data-placement' => 'top',
                                                            'title' => 'Année scolaire',
                                                            'id' => 'annee_scolaire',
                                                            'required'
                                                        )
                                                    );
                                                    ?>
                                                    <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Afficher">
                                                </div>
                                            </form>
                                           </div>
                                       </div>
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
                                            <th>Elève payant</th>
                                            <th>Code validation</th>
                                            <th>Date paiement</th>
                                            <th>Montant payé</th>
                                            <th>Type frais</th>
                                            <th>Mois payé</th>
                                            <th>Reste</th>
                                            <th>Solde</th>
                                            <th>Statut</th>
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
                                                    <td class="text-uppercase"><?= $carte->nom_complet; ?></td>
                                                    <td class="text-uppercase"><?= $carte->code_validation; ?></td>
                                                    <td class="text-capitalize"><?= $carte->date_paiement; ?></td>
                                                    <td class="text-capitalize"><?= $carte->montant_paye.' '.$carte->devise; ?></td>
                                                    <td class="text-capitalize"><?= $carte->type_frais; ?></td>
                                                    <td class="text-capitalize"><?= $carte->mois; ?></td>
                                                    <td class="text-capitalize"><?= $carte->montant_restant; ?></td>
                                                    <td class="text-capitalize"><?= $carte->montant_complet; ?></td>
                                                    <td class="text-capitalize"><?= $carte->statut_paiement; ?></td>
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
