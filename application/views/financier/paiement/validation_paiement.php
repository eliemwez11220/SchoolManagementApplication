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
<div class="row">
    <div class="col-md-12">
               
        <div class="card border-primary">

            <div class="card-header user-header alt danger-color-dark text-light font-weight-bold">
                <h3 class="text-center">
 Compléter le
                                                                                paiement numero 
                                                                                <span class="text-shadow-black"><?= $paiement['code_validation']; ?></small>
                </h3>
            </div>
            <div class="card-body font-weight-bold">
                 <form action="<?= site_url('financier/completer_paiement') ?>"
                                                                  method="post">
                                                                

                                                               

                                                                    <div class="row">
                                                                        <div class="col-sm-6">

                                                                            <div class="form-group">
                                                                                <label for="code_paiement">Code Paiement
                                                                                    </label>
                                                                                <input type="text"
                                                                                       name="code_paiement"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       value="<?= $paiement['code_validation']; ?>"
                                                                                       readonly>
                                                                            </div><div class="form-group">
                                                                                <label for="matricule_eleve">Matricule
                                                                                    élève</label>
                                                                                <input type="text"
                                                                                       name="matricule_eleve"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       value="<?= $paiement['matricule_eleve']; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="nom_complet">Nom complet
                                                                                    élève</label>
                                                                                <input type="text" name="nom_complet"
                                                                                       class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                       value="<?= $paiement['nom_complet']; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="annee_scolaire">Année
                                                                                    scolaire</label>
                                                                                <input type="text" name="annee_scolaire"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       value="<?= $paiement['annee_scolaire']; ?>"
                                                                                       readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="type_frais">Type
                                                                                    frais</label>
                                                                                <input type="text" name="type_frais"
                                                                                       class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                       value="<?= $paiement['type_frais']; ?>"
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
                                                                                <label for="montant_paye">Montant deja paye
                                                                            </label>
                                                                                <?php $taux_change = $this->School_management->get_unique('tb_school_frais', 
                                                                           array('type_frais' => $paiement['type_frais']))->taux_change ?>
                                                                                <input data-toggle="tooltip"
                                                                                       data-plcement="right"
                                                                                       title="<?php echo ($paiement['devise'] == "USD") ? $paiement['montant_paye'] . " USD | " . (round($paiement['montant_paye']  * $taux_change, -3)) . " CDF" : $paiement['montant_paye'] . " CDF | " . (round($paiement['montant_paye']  / $taux_change, 1)) . " USD" ?>"
                                                                                       type="text" name="montant_paye"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       placeholder="En chiffre"
                                                                                        value="<?php echo ($paiement['devise'] == "USD") ? $paiement['montant_paye'] . " USD | " . (round($paiement['montant_paye']  * $taux_change, -3)) . " CDF" : $paiement['montant_paye'] . " CDF | " . (round($paiement['montant_paye']  / $taux_change, 1)) . " USD" ?>"
                                                                                       readonly>
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label for="montant_restant">Montant à
                                                                                    compléter</label>
                                                                                <?php $taux_change = $this->School_management->get_unique('tb_school_frais', 
                                                                           array('type_frais' => $paiement['type_frais']))->taux_change ?>
                                                                                <input data-toggle="tooltip"
                                                                                       data-plcement="right"
                                                                                       title="<?php echo ($paiement['devise'] == "USD") ? $paiement['montant_restant'] . " USD | " . (round($paiement['montant_restant']  * $taux_change, -3)) . " CDF" : $paiement['montant_restant'] . " CDF | " . (round($paiement['montant_restant']  / $taux_change, 1)) . " USD" ?>"
                                                                                       type="text"
                                                                                       name="montant_restant"
                                                                                       class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                                                                       placeholder="Montant payer a compléter">
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
                                                                            <?php if ($paiement['type_frais'] == "minerval"): ?>
                                                                                <div id="div_minerval"
                                                                                     class="form-group">
                                                                                    <label for="mois">Période
                                                                                        d'étude</label>
                                                                                    <input type="text" name="mois"
                                                                                           class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                           value="<?= $paiement['mois']; ?>"
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

                                                                    <div class="text-center">
                                                                        <?= form_hidden('code_validation', $paiement['code_validation']) ?>
                                                                    
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                 <i class="fa fa-check-circle-o"></i>Enregistrer paiement
                                                                            </button>
                                                                        
                                                                    </div>
                                                                
                                                            </form>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
</div><!-- /#right-panel -->
   