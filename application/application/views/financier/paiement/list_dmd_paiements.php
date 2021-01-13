

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-alt"></i> Page de demande des paiements</h1>
            <p>Application web de gestion centralisée des activités scolaires Masomo_meneja</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-list-alt fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Page de demandes des paiements</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="container-fluid">
            <?php include_once ("application/views/auth/alert.php"); ?>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <div class="card border-primary">

                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="display-5">Liste des toutes les demandes de paiements</h3>
                        </div>
                        <div class="col-sm-4">
                            <form class="form-inline pull-right" method="post" action="<?= site_url($role_utilisateur.'/list_dmd_paiements'); ?>">

                                <div class="form-horizontal form-group-sm">

                                    <?php $array_periodes  = []; foreach ($data['periodes'] as $periode) :

                                        $array_periodes[$periode->annee_scolaire] = $periode->annee_scolaire;

                                    endforeach; ?>
                                    Année scolaire :
                                    <?=
                                    form_dropdown('annee_scolaire', $array_periodes, $data['select'],
                                        [
                                            'class' => 'form-control',
                                            'id' => 'annee_scolaire',
                                            'required'
                                        ]
                                    );
                                    ?>
                                </div>

                                <div class="form-horizontal">
                                    <div class="form-group-sm">
                                        <input type="submit" class="btn bleu text-white" name="submit" value="Afficher">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Matricule</th>
                                <th>Noms</th>
                                <th>Frais</th>
                                <th>Date paiment</th>
                                <th>Détails</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Matricule</th>
                                <th>Noms</th>
                                <th>Frais</th>
                                <th>Date paiment</th>
                                <th>Détails</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $count = 1; foreach ($data['dmd_paiements'] as $dmd_paiement): ?>
                                <tr class="">
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-uppercase"><?= $dmd_paiement->matricule_eleve; ?></td>
                                    <td class="text-uppercase"><?= $dmd_paiement->nom_complet; ?></td>
                                    <td class="text-uppercase"><?= $dmd_paiement->type_frais; ?></td>
                                    <td class="text-uppercase">Le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($dmd_paiement->date_paiement))) ?></td>
                                    <td class="text-center"><a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#details_paiement<?= $dmd_paiement->id; ?>" href="#">Voir plus</a></td>
                                </tr>
                                <div class="modal fade" id="details_paiement<?= $dmd_paiement->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <?= form_open('caissier/valider_dmd_paiement', '', ['id' => $dmd_paiement->id]) ?>
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 class="text-shadow-black text-center">Détail sur le paiement : <small><?= $dmd_paiement->code_validation; ?></small></h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body font-weight-bold">

                                                <div class="row">
                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label for="matricule_eleve">Matricule élève</label>
                                                            <input type="text" name="matricule_eleve" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $dmd_paiement->matricule_eleve ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nom_complet">Nom complet élève</label>
                                                            <input type="text" name="nom_complet" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                   value="<?= $dmd_paiement->nom_complet ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="annee_scolaire">Année scolaire</label>
                                                            <input type="text" name="annee_scolaire" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $dmd_paiement->annee_scolaire; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type_frais">Type frais</label>
                                                            <input type="text" name="type_frais" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                   value="<?= $dmd_paiement->type_frais; ?>" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="date_paiement">Date paiement</label>
                                                        <div class="form-group">
                                                            <?php if ($dmd_paiement->date_validation != NULL): ?>
                                                                <input type="text" name="date_paiement" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                       value="Payé le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($dmd_paiement->date_paiement))). " et enregistré le ". utf8_encode(strftime("%d-%m-%Y", strtotime($dmd_paiement->date_validation))); ?>" readonly>
                                                            <?php else: ?>
                                                                <input type="text" name="date_paiement" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                       value="Payé le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($dmd_paiement->date_paiement))); ?>" readonly>
                                                            <?php endif;?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="montant_paye">Montant payé</label>
                                                            <input type="text" name="montant_paye" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $dmd_paiement->montant_paye. " ". $dmd_paiement->devise; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="montant_complet">Montant complété</label>
                                                            <input type="text" name="montant_complet" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $dmd_paiement->montant_complet; ?>" readonly>
                                                        </div>
                                                        <?php if ($dmd_paiement->type_frais == "minerval"):?>
                                                            <div id="div_minerval" class="form-group">
                                                                <label for="mois">Période d'étude</label>
                                                                <input type="text" name="mois" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                       value="<?= $dmd_paiement->mois; ?>" readonly>
                                                                </select>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="form-group">
                                                                <label for="mois">Période d'étude</label>
                                                                <input type="text" name="mois" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                       value="annuel" readonly>
                                                                </select>
                                                            </div>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Numéro expéditeur</label>
                                                            <input class="form-control form-control-sm" type="text" name="numero_expediteur" value="<?= $dmd_paiement->numero_expediteur?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nom expéditeur</label>
                                                            <input class="form-control form-control-sm" type="text" name="nom_expediteur" value="<?= $dmd_paiement->nom_expediteur?>" readonly>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Date envoi</label>
                                                            <input class="form-control form-control-sm" type="text" name="date_envoi" value="<?= utf8_encode(strftime("%d-%m-%Y %T", strtotime($dmd_paiement->date_envoi)))?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Service mobile</label>
                                                            <input class="form-control form-control-sm" type="text" name="service_mobile" value="<?= $dmd_paiement->service_mobile?>" readonly>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col col-sm-12">
                                                        <button type="submit" class="btn btn-sm btn-block bg-bleu-mixed text-white">Valider demande de paiement</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>

</main>
