

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> Page de mes paiements des frais</h1>
            <p>Application web de gestion centralisée des activités scolaires Masomo_meneja</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-money fa-lg"></i></li>
            <li class="breadcrumb-item text-lowercase"><a href="#">Page de mes paiements des frais</a></li>
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
                            <h5 class="text-center">
                                Demande de paiement de l'élève <small class="text-bleu"><?= $data['el']->matricule_eleve. " <span class='font-weight-bold text-shadow-black text-capitalize'>".
                                    $data['el']->nom_complet. " </span>". $data['el']->nom_classe. " ". $data['el']->nom_option; ?></small></small>
                            </h5>
                        </div>
                        <div class="col-sm-4">
                            <form class="form-inline pull-right" method="post" action="<?= site_url($role_utilisateur.'/paiements_el'); ?>">

                                <div class="form-horizontal form-group-sm">

                                    <?php $array_cursus  = []; foreach ($data['cursus'] as $cursus) :

                                        $array_cursus[$cursus->annee_scolaire] = $cursus->annee_scolaire;

                                    endforeach; ?>
                                    Année scolaire :
                                    <?=
                                    form_dropdown('annee_scolaire', $array_cursus, $data['select'],
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

                <form action="<?= base_url('eleve/dmd_paiement'); ?>" method="post">
                    <div class="card-body font-weight-bold">

                        <div class="row">
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label for="matricule_eleve">Matricule élève</label>
                                    <input type="text" name="matricule_eleve" class="form-control form-control-sm font-weight-bold is-valid"
                                           value="<?= $data['el']->matricule_eleve ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nom_complet">Nom complet élève</label>
                                    <input type="text" name="nom_complet" class="form-control form-control-sm font-weight-bold is-valid"
                                           value="<?= $data['el']->nom_complet ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="annee_scolaire">Année scolaire</label>
                                    <input type="text" name="annee_scolaire" class="form-control form-control-sm font-weight-bold is-valid"
                                          value="<?= $data['el']->annee_scolaire ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="type_frais">Type frais</label>
                                    <select name="type_frais" id="select_frais" class="form-control form-control-sm font-weight-bold <?= form_error('type_frais') ? 'is-invalid' : 'is-valid'; ?>" required>
                                        <option disabled selected>Choisir le type de frais</option>
                                        <?php foreach ($data['frais'] as $frais) : ?>
                                            <option value="<?= $frais->type_frais; ?>" <?= set_select('type_frais', $frais->type_frais); ?> data-toggle="tooltip" data-placement="right" title="tooltip">
                                                <?= $frais->type_frais." | ". $frais->montant_fixe ." ". $frais->devise." | Taux : ". $frais->taux_change.
                                                " | Soit : "; ?><?php echo ($frais->devise == "USD") ? ($frais->montant_fixe * $frais->taux_change). " CDF" : (round($frais->montant_fixe / $frais->taux_change, 1)). " USD"?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="date_paiement">Date paiement</label>
                                <div class="form-group">
                                    <input type="date" name="date_paiement" class="form-control form-control-sm font-weight-bold <?= form_error('date_paiement') ? 'is-invalid' : 'is-valid'; ?> "
                                           value="<?= date('Y-m-d') ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="montant_paye">Montant payé</label>
                                    <input data-toggle="tooltip" data-placement="top" title="En chiffre SVP!" type="text" name="montant_paye" class="form-control form-control-sm font-weight-bold <?= form_error('montant_paye') ? 'is-invalid' : 'is-valid'; ?> "
                                           value="<?= set_value('montant_paye'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="devise">Devise</label>
                                    <select class="form-control form-control-sm font-weight-bold <?= form_error('devise') ? 'is-invalid' : 'is-valid'; ?>" name="devise" required>
                                        <option disabled selected>Choisir devise</option>
                                        <option value="USD">USD</option>
                                        <option value="CDF">CDF</option>
                                    </select>
                                </div>
                                <div id="div_minerval" class="form-group" style="display: none;">
                                    <label for="mois">Période d'étude</label>
                                    <select class="form-control form-control-sm font-weight-bold <?= form_error('mois') ? 'is-invalid' : 'is-valid'; ?>" name="mois" required>
                                        <option disabled selected>Choisir le mois</option>
                                        <?php foreach ($data['mois'] as $mois) : ?>
                                            <option value="<?= $mois->mois; ?>" <?= set_select('mois', $mois->mois); ?>>
                                                <?= $mois->mois ; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label for="numero_expediteur">Numéro expéditeur</label>
                                    <input type="text" name="numero_expediteur" data-toggle="tooltip" data-placement="top" title="En chiffre SVP!"
                                           class="form-control form-control-sm font-weight-bold is-valid" required>
                                </div>
                                <div class="form-group">
                                    <label for="nom_expediteur">Nom expéditeur</label>
                                    <input type="text" name="nom_expediteur" data-toggle="tooltip" data-placement="top" title="Le nom lié au numéro ci-haut!"
                                           class="form-control form-control-sm font-weight-bold is-valid" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_envoi">Date envoi</label>
                                    <input type="datetime-local" name="date_envoi" data-toggle="tooltip" data-placement="top" title="Date et heure contenues dans le SMS de confirmation"
                                           class="form-control form-control-sm font-weight-bold is-valid" required>
                                </div>
                                <div class="form-group">
                                    <label for="numero_service">Service mobile</label>
                                    <select name="service_mobile" id="numero_service" class="form-control form-control-sm font-weight-bold <?= form_error('service_mobile') ? 'is-invalid' : 'is-valid'; ?>" required>
                                        <option disabled selected>Choisir un service mobile</option>
                                        <?php foreach ($data['services'] as $service) : ?>
                                            <option value="<?= $service->numero_service. " | ". $service->nom_service; ?>" <?= set_select('service_mobile', $service->numero_service." | ". $service->nom_service); ?> data-toggle="tooltip" data-placement="right" title="tooltip">
                                                <?= $service->numero_service." | ". $service->nom_service ;?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 offset-sm-4">
                                <div class="form-group">
                                    <input type="submit" value="Envoyer paiement" class="form-control-sm btn bleu text-white btn-sm btn-block">
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-sm-12">
            <br>
            <div class="card border-primary">

                <div class="card-header">
                    <h4 class="text-center">
                        Liste des paiements de l'élève <small class="text-bleu"><?= $data['el']->matricule_eleve. " <span class='font-weight-bold text-shadow-black text-capitalize'>".
                            $data['el']->nom_complet. " </span>". $data['el']->nom_classe. " ". $data['el']->nom_option; ?></small></small>
                    </h4>
                </div>

                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Code</th>
                                <th>Frais</th>
                                <th>Montant payé</th>
                                <th>Date paiement</th>
                                <th>Date validation</th>
                                <th>Statut</th>
                                <th class="text-center">Détails</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Code</th>
                                <th>Frais</th>
                                <th>Montant payé</th>
                                <th>Date paiement</th>
                                <th>Date validation</th>
                                <th>Statut</th>
                                <th class="text-center">Détails</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $count = 1; foreach ($data['paiements_el'] as $paiements_el): ?>
                                <tr class="">
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-uppercase"><?php echo ($paiements_el->date_validation == NULL) ? "Pas encore" : $paiements_el->code_validation; ?></td>
                                    <td class="text-lowercase"><?= $paiements_el->type_frais. " ". $paiements_el->mois;?></td>
                                    <td class="text-uppercase"><?php echo $paiements_el->montant_paye. " ". $paiements_el->devise; echo ($paiements_el->montant_complet) ? " + ". $paiements_el->montant_complet : "" ; ?></td>
                                    <td class="text-uppercase"><?= utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_paiement))); ?></td>
                                    <td class="text-uppercase"><?php echo ($paiements_el->date_validation == NULL) ? "pas encore" : (utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_validation)))); ?></td>
                                    <?php if ($paiements_el->statut_paiement == "paiement validé"): ?>
                                    <td class="text-capitalize text-success"><?= $paiements_el->statut_paiement ; ?></td>
                                    <?php elseif ($paiements_el->statut_paiement == "paiement amorcé"): ?>
                                    <td class="text-capitalize text-warning"><a data-toggle="modal" data-target="#completer_paiement<?= $paiements_el->id; ?>" class="text-orange-fonce font-weight-bold" href="#">
                                            <?= $paiements_el->statut_paiement ; ?></a></td>
                                    <?php elseif ($paiements_el->statut_paiement == "paiement demandé"): ?>
                                        <td class="text-capitalize text-info"><?= $paiements_el->statut_paiement ; ?></td>
                                    <?php endif; ?>
                                    <td class="text-center"><a class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#details_paiement<?= $paiements_el->id; ?>" href="#">Voir plus</a></td>
                                </tr>
                                <div class="modal fade" id="details_paiement<?= $paiements_el->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 class="text-shadow-black text-center">Détail sur le paiement : <small><?= $paiements_el->code_validation; ?></small></h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body font-weight-bold">

                                                <div class="row">
                                                    <div class="col-sm-6">

                                                        <div class="form-group">
                                                            <label for="matricule_eleve">Matricule élève</label>
                                                            <input type="text" name="matricule_eleve" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $data['el']->matricule_eleve ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nom_complet">Nom complet élève</label>
                                                            <input type="text" name="nom_complet" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                   value="<?= $data['el']->nom_complet ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="annee_scolaire">Année scolaire</label>
                                                            <input type="text" name="annee_scolaire" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $data['annee_scolaire']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type_frais">Type frais</label>
                                                            <input type="text" name="type_frais" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                   value="<?= $paiements_el->type_frais; ?>" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="date_paiement">Date paiement</label>
                                                        <div class="form-group">
                                                            <?php if ($paiements_el->date_validation != NULL): ?>
                                                            <input type="text" name="date_paiement" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="Payé le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_paiement))). " et enregistré le ". utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_validation))); ?>" readonly>
                                                            <?php else: ?>
                                                                <input type="text" name="date_paiement" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="Payé le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_paiement))); ?>" readonly>
                                                            <?php endif;?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="montant_paye">Montant payé</label>
                                                            <input type="text" name="montant_paye" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $paiements_el->montant_paye. " ". $paiements_el->devise; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="montant_complet">Montant complété</label>
                                                            <input type="text" name="montant_complet" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                   value="<?= $paiements_el->montant_complet; ?>" readonly>
                                                        </div>
                                                        <?php if ($paiements_el->type_frais == "minerval"):?>
                                                            <div id="div_minerval" class="form-group">
                                                                <label for="mois">Période d'étude</label>
                                                                <input type="text" name="mois" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                       value="<?= $paiements_el->mois; ?>" readonly>
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
                                                <?php if ($paiements_el->mode_paiement == "en ligne"): ?>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Numéro expéditeur</label>
                                                                <input class="form-control form-control-sm" type="text" value="<?= $paiements_el->numero_expediteur?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nom expéditeur</label>
                                                                <input class="form-control form-control-sm" type="text" value="<?= $paiements_el->nom_expediteur?>" readonly>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Date envoi</label>
                                                                <input class="form-control form-control-sm" type="text" value="<?= $paiements_el->date_envoi?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Service mobile</label>
                                                                <input class="form-control form-control-sm" type="text" value="<?= $paiements_el->service_mobile?>" readonly>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="completer_paiement<?= $paiements_el->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="<?=site_url('caissier/completer_paiement')?>" method="post">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <h3 class="text-shadow-black text-center">Compléter le paiement : <small><?= $paiements_el->code_validation; ?></small></h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body font-weight-bold">

                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label for="matricule_eleve">Matricule élève</label>
                                                                <input type="text" name="matricule_eleve" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                       value="<?= $data['el']->matricule_eleve ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nom_complet">Nom complet élève</label>
                                                                <input type="text" name="nom_complet" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                       value="<?= $data['el']->nom_complet ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="annee_scolaire">Année scolaire</label>
                                                                <input type="text" name="annee_scolaire" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                       value="<?= $data['annee_scolaire']; ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="type_frais">Type frais</label>
                                                                <input type="text" name="type_frais" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                       value="<?= $paiements_el->type_frais; ?>" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="date_paiement">Date paiement</label>
                                                            <div class="form-group">
                                                                <input type="date" name="date_paiement" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                       value="<?=date('Y-m-d')?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="montant_restant">Montant à compléter</label>
                                                                <?php $taux_change = $this->masomo_meneja_model->get_unique('frais', ['type_frais' => $paiements_el->type_frais])->taux_change ?>
                                                                <input data-toggle="tooltip" data-plcement="right" title="<?php echo ($paiements_el->devise == "USD") ? $paiements_el->montant_restant." USD | ".(round($paiements_el->montant_restant * $taux_change, -3)). " CDF"  : $paiements_el->montant_restant." CDF | ".(round($paiements_el->montant_restant / $taux_change, 1)). " USD" ?>"
                                                                       type="text" name="montant_restant" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                placeholder="En chiffre">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="devise">Devise</label>

                                                                <select class="form-control form-control-sm font-weight-bold <?= form_error('devise') ? 'is-invalid' : 'is-valid'; ?>" name="devise" required>
                                                                    <option disabled selected>Choisir devise</option>
                                                                    <option value="USD">USD</option>
                                                                    <option value="CDF">CDF</option>
                                                                </select>
                                                            </div>
                                                            <?php if ($paiements_el->type_frais == "minerval"):?>
                                                                <div id="div_minerval" class="form-group">
                                                                    <label for="mois">Période d'étude</label>
                                                                    <input type="text" name="mois" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                           value="<?= $paiements_el->mois; ?>" readonly>
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
                                                        <?= form_hidden('code_validation', $paiements_el->code_validation) ?>
                                                        <div class="col-sm-4 offset-sm-4">
                                                            <button type="submit" class="btn btn-sm bleu text-white btn-block">Compléter paiement <i class="fa fa-check-circle-o"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
