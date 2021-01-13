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
                        <span style="color:red;"><b><?= $this->session->agent; ?></b></span>

                        <div class="col-md-12">
                            <div class="card border-primary">

                                <div class="card-header user-header alt danger-color-dark text-light font-weight-bold">
                                    <h4 class="text-center">
                                        Infos des paiements de l'élève
                                        <small class="text-bleu"><?= $eleve['matricule_eleve'] . " <span class='font-weight-bold text-shadow-black text-capitalize'>" .
                                            $eleve['nom_complet'] . " </span>" . $eleve['nom_classe'] . " " . $eleve['nom_option']; ?></small>
                                        </small>
                                    </h4>
                                </div>

                                <form action="<?= base_url('financier/valider_paiement'); ?>" method="post">
                                    <div class="card-body font-weight-bold">

                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label for="matricule_eleve">Matricule élève</label>
                                                    <input type="text" name="matricule_eleve"
                                                           class="form-control font-weight-bold is-valid"
                                                           value="<?= $eleve['matricule_eleve']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nom_complet">Nom complet élève</label>
                                                    <input type="text" name="nom_complet"
                                                           class="form-control font-weight-bold is-valid"
                                                           value="<?= $eleve['nom_complet']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="annee_scolaire">Année scolaire</label>
                                                    <input type="text" name="annee_scolaire"
                                                           class="form-control font-weight-bold is-valid"
                                                           value="<?= $eleve['annee_scolaire']; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="type_frais">Type frais</label>
                                                    <select name="type_frais" id="select_frais"
                                                            class="form-control font-weight-bold text-capitalize <?= form_error('type_frais') ? 'is-invalid' : 'is-valid'; ?>"
                                                            required>
                                                        <option disabled selected>Choisir le type de frais</option>
                                                        <?php foreach ($paie as $frais) : ?>
                                                            <option value="<?= $frais->type_frais; ?>" <?= set_select('type_frais', $frais->type_frais); ?>
                                                                    data-toggle="tooltip" data-placement="right"
                                                                    title="tooltip">
                                                                <?= $frais->cycle . "-" . $frais->type_frais . " | " . $frais->montant_fixe . " " . $frais->devise . " | Taux : " . $frais->taux_change .
                                                                " | Soit : "; ?><?php echo ($frais->devise == "USD") ? ($frais->montant_fixe * $frais->taux_change) . " CDF" : (round($frais->montant_fixe / $frais->taux_change, 1)) . " USD" ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="date_paiement">Date paiement</label>
                                                <div class="form-group">
                                                    <input type="date" name="date_paiement"
                                                           class="form-control font-weight-bold <?= form_error('date_paiement') ? 'is-invalid' : 'is-valid'; ?> "
                                                           value="<?= date('Y-m-d') ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="montant_paye">Montant payé</label>
                                                    <input data-toggle="tooltip" data-placement="top"
                                                           title="En chiffre SVP!"
                                                           type="text" name="montant_paye"
                                                           class="form-control font-weight-bold <?= form_error('montant_paye') ? 'is-invalid' : 'is-valid'; ?> "
                                                           value="<?= set_value('montant_paye'); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="devise">Devise</label>
                                                    <select class="form-control font-weight-bold <?= form_error('devise') ? 'is-invalid' : 'is-valid'; ?>"
                                                            name="devise" required>
                                                        <option disabled selected>Choisir devise</option>
                                                        <option value="USD">USD</option>
                                                        <option value="CDF">CDF</option>
                                                    </select>
                                                </div>
                                                <div id="div_minerval" class="form-group" >
                                                    <label for="mois">Mois paiement</label>
                                                    <select class="form-control font-weight-bold <?= form_error('mois') ? 'is-invalid' : 'is-valid'; ?>"
                                                            name="mois" required>
                                                        <option disabled selected>Choisir le mois</option>
                                                        <?php foreach ($mois as $mois) : ?>
                                                            <option value="<?= $mois->mois; ?>" <?= set_select('mois', $mois->mois); ?>>
                                                                <?= $mois->mois; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 offset-3">
                                                <div class="form-group">
                                                    <input type="submit" value="Appliquer paiement"
                                                           class="btn btn-primary text-white btn-block">
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <br>
                            <div class="card border-primary">

                                <div class="card-header user-header alt danger-color-dark text-light font-weight-bold">
                                    <h4 class="text-center">
                                        Paiements effectués par l'élève
                                        <small class="text-bleu"><?= $eleve['matricule_eleve'] . " <span class='font-weight-bold text-shadow-black text-capitalize'>" .
                                            $eleve['nom_complet'] . " </span>" . $eleve['nom_classe'] . " " . $eleve['nom_option']; ?></small>
                                    </h4>
                                </div>

                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-hover"
                                               id="dtMaterialDesignExample">
                                            <thead class="danger-color-dark text-light">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Code</th>
                                                <th>Frais</th>
                                                <th>Montant payé</th>
                                                <th>Date paiement</th>
                                                <th>Date validation</th>
                                                <th>Statut</th>
                                                <th>Validation</th>
                                                <th class="text-center">Détails</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1;
                                            foreach ($paiements_eleves as $paiements_el): ?>
                                                <tr class="">
                                                    <td class="text-center"><?= $count++; ?></td>
                                                    <td class="text-uppercase"><?= $paiements_el->code_validation; ?></td>
                                                    <td class="text-lowercase"><?= $paiements_el->type_frais . " " . $paiements_el->mois; ?></td>
                                                    <td class="text-uppercase"><?php echo $paiements_el->montant_paye . " " . $paiements_el->devise;
                                                        echo ($paiements_el->montant_complet) ? " + " . $paiements_el->montant_complet : ""; ?></td>
                                                    <td class="text-uppercase"><?= utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_paiement))); ?></td>
                                                    <td class="text-uppercase"><?= utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_validation))); ?></td>
                                                    <td class="text-uppercase"><?= $paiements_el->statut_paiement; ?></td>
                                                    <td class="text-capitalize text-warning">
                                                        <?php if ($paiements_el->statut_paiement == "amorcé"): ?>
                                                            <a data-toggle="modal" data-target="#completer_paiement<?= $paiements_el->id; ?>"
                                                               class="btn btn-success btn-sm font-weight-bold" href="#">
                                                                <?= $paiements_el->statut_paiement; ?></a>
                                                        <?php elseif ($paiements_el->statut_paiement == "en attente"): ?>
                                                            <a data-toggle="modal" data-target="#completer_paiement<?= $paiements_el->id; ?>"
                                                               class="btn btn-success btn-sm font-weight-bold" href="#">
                                                                valider</a></td>
                                                    <?php endif; ?>
                                                    <td class="text-center">
                                                        <a class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                                           data-target="#details_paiement<?= $paiements_el->id; ?>" href="#">Voir plus</a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="details_paiement<?= $paiements_el->code_validation; ?>"
                                                     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h3 class="text-shadow-black text-center">Détail
                                                                            sur le paiement
                                                                            :
                                                                            <small><?= $paiements_el->code_validation; ?></small>
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-body font-weight-bold">

                                                                <div class="row">
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group">
                                                                            <label for="matricule_eleve">Matricule
                                                                                élève</label>
                                                                            <input type="text" name="matricule_eleve"
                                                                                   class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                   value="<?= $eleve['matricule_eleve']; ?>"
                                                                                   readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nom_complet">Nom complet
                                                                                élève</label>
                                                                            <input type="text" name="nom_complet"
                                                                                   class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                   value="<?= $eleve['nom_complet']; ?>"
                                                                                   readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="annee_scolaire">Année
                                                                                scolaire</label>
                                                                            <input type="text" name="annee_scolaire"
                                                                                   class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                   value="<?= $annee_scolaire; ?>"
                                                                                   readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="type_frais">Type frais</label>
                                                                            <input type="text" name="type_frais"
                                                                                   class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                   value="<?= $paiements_el->type_frais; ?>"
                                                                                   readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <label for="date_paiement">Date paiement</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="date_paiement"
                                                                                   class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                   value="Payé le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_paiement))) . " et enregistré le " . utf8_encode(strftime("%d-%m-%Y", strtotime($paiements_el->date_validation))); ?>"
                                                                                   readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="montant_paye">Montant
                                                                                payé</label>
                                                                            <input type="text" name="montant_paye"
                                                                                   class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                   value="<?= $paiements_el->montant_paye . " " . $paiements_el->devise; ?>"
                                                                                   readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="montant_complet">Montant
                                                                                complété</label>
                                                                            <input type="text" name="montant_complet"
                                                                                   class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                   value="<?= $paiements_el->montant_complet; ?>"
                                                                                   readonly>
                                                                        </div>
                                                                        <?php if ($paiements_el->type_frais == "minerval"): ?>
                                                                            <div id="div_minerval" class="form-group">
                                                                                <label for="mois">Période
                                                                                    d'étude</label>
                                                                                <input type="text" name="mois"
                                                                                       class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                       value="<?= $paiements_el->mois; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="form-group">
                                                                                <label for="mois">Période
                                                                                    d'étude</label>
                                                                                <input type="text" name="mois"
                                                                                       class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                       value="annuel" readonly>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="card-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-4 offset-sm-4">
                                                                        <a class="btn btn-sm bleu text-white btn-block"
                                                                           href="<?= site_url('financier/imprimer_recu?id=' . $paiements_el->id . '&mat_el=' . $data['el']->matricule_eleve . '&ann_sco=' . $data['annee_scolaire']) ?>">Imprimer
                                                                            reçu <i class="fa fa-print"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="completer_paiement<?= $paiements_el->code_validation; ?>"
                                                     tabindex="-1"
                                                     role="dialog" aria-labelledby="myLargeModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form action="<?= site_url('financier/completer_paiement') ?>"
                                                                  method="post">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <h3 class="text-shadow-black text-center">
                                                                                Compléter le
                                                                                paiement :
                                                                                <small><?= $paiements_el->code_validation; ?></small>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body font-weight-bold">

                                                                    <div class="row">
                                                                        <div class="col-sm-6">

                                                                            <div class="form-group">
                                                                                <label for="matricule_eleve">Matricule
                                                                                    élève</label>
                                                                                <input type="text"
                                                                                       name="matricule_eleve"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       value="<?= $eleve['matricule_eleve']; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="nom_complet">Nom complet
                                                                                    élève</label>
                                                                                <input type="text" name="nom_complet"
                                                                                       class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                       value="<?= $eleve['nom_complet']; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="annee_scolaire">Année
                                                                                    scolaire</label>
                                                                                <input type="text" name="annee_scolaire"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       value="<?= $data['annee_scolaire']; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="type_frais">Type
                                                                                    frais</label>
                                                                                <input type="text" name="type_frais"
                                                                                       class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                       value="<?= $paiements_el->type_frais; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <label for="date_paiement">Date
                                                                                paiement</label>
                                                                            <div class="form-group">
                                                                                <input type="date" name="date_paiement"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       value="<?= date('Y-m-d') ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="montant_restant">Montant à
                                                                                    compléter</label>
                                                                                <?php $taux_change = $this->masomo_meneja_model->get_unique('frais', ['type_frais' => $paiements_el->type_frais])->taux_change ?>
                                                                                <input data-toggle="tooltip"
                                                                                       data-plcement="right"
                                                                                       title="<?php echo ($paiements_el->devise == "USD") ? $paiements_el->montant_restant . " USD | " . (round($paiements_el->montant_restant * $taux_change, -3)) . " CDF" : $paiements_el->montant_restant . " CDF | " . (round($paiements_el->montant_restant / $taux_change, 1)) . " USD" ?>"
                                                                                       type="text"
                                                                                       name="montant_restant"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       placeholder="En chiffre">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="devise">Devise</label>

                                                                                <select class="form-control form-control-sm font-weight-bold <?= form_error('devise') ? 'is-invalid' : 'is-valid'; ?>"
                                                                                        name="devise" required>
                                                                                    <option disabled selected>Choisir
                                                                                        devise
                                                                                    </option>
                                                                                    <option value="USD">USD</option>
                                                                                    <option value="CDF">CDF</option>
                                                                                </select>
                                                                            </div>
                                                                            <?php if ($paiements_el->type_frais == "minerval"): ?>
                                                                                <div id="div_minerval"
                                                                                     class="form-group">
                                                                                    <label for="mois">Période
                                                                                        d'étude</label>
                                                                                    <input type="text" name="mois"
                                                                                           class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                           value="<?= $paiements_el->mois; ?>"
                                                                                           readonly>
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="form-group">
                                                                                    <label for="mois">Période
                                                                                        d'étude</label>
                                                                                    <input type="text" name="mois"
                                                                                           class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                           value="annuel" readonly>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="card-footer">
                                                                    <div class="row">
                                                                        <?= form_hidden('code_validation', $paiements_el->code_validation) ?>
                                                                        <div class="col-sm-4 offset-sm-4">
                                                                            <button type="submit"
                                                                                    class="btn btn-sm bleu text-white btn-block">
                                                                                Compléter paiement <i
                                                                                        class="fa fa-check-circle-o"></i>
                                                                            </button>
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
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </section><!-- /#right-panel -->
</div><!-- /#right-panel -->
