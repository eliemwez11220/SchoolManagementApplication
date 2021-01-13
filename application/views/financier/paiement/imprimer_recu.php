<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recu Paiement Document</title>
</head>
<body onload="print()">

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="text-shadow-black text-left font-weight-bold">Recu du paiement  numero 
                                <span class="text-uppercase"><?= date('Y').$paiement['id']; ?></small></h5>
                        </div>
                         <div class="col-sm-4">
                            <h5 class="text-shadow-black text-right font-weight-bold">Date
                                <span class="text-uppercase"><?= date('Y-m-d H:i:s'); ?></small></h5>
                        </div>
                    </div>
                </div>

                <div class="card-body font-weight-bold">

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
                                                                                       value="<?= $paiement['date_paiement']; ?>" readonly>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="montant_paye">Montant paye
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
                                                                                       placeholder="Montant payer a compléter"
                                                                                       value="<?php echo ($paiement['devise'] == "USD") ? $paiement['montant_restant'] . " USD | " . (round($paiement['montant_restant']  * $taux_change, -3)) . " CDF" : $paiement['montant_restant'] . " CDF | " . (round($paiement['montant_restant']  / $taux_change, 1)) . " USD" ?>" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="devise">Solde Paiement</label>

                                                                                <input type="text" name="mois"
                                                                                           class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                                                                           value="<?= $paiement['montant_complet']; ?>"
                                                                                           readonly>
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


                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 offset-sm-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/app.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/main.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/plugins/pace.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
</body>
</html>