<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body onload="print()">

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="text-shadow-black text-center">Détail sur le paiement : <small><?= $data['paiements_el']->code_validation; ?></small></h3>
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
                                       value="<?= $data['paiements_el']->annee_scolaire; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="type_frais">Type frais</label>
                                <input type="text" name="type_frais" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                       value="<?= $data['paiements_el']->type_frais; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="date_paiement">Date paiement</label>
                            <div class="form-group">
                                <input type="text" name="date_paiement" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                       value="Payé le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($data['paiements_el']->date_paiement))). " et enregistré le ". utf8_encode(strftime("%d-%m-%Y", strtotime($data['paiements_el']->date_validation))); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="montant_paye">Montant payé</label>
                                <input type="text" name="montant_paye" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                       value="<?= $data['paiements_el']->montant_paye; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="devise">Devise</label>
                                <input type="text" name="devise" class="border-bottom-dotted form-control form-control-sm font-weight-bold"
                                       value="<?= $data['paiements_el']->devise; ?>" readonly>
                            </div>
                            <?php if ($data['paiements_el']->type_frais == "minerval"):?>
                                <div id="div_minerval" class="form-group">
                                    <label for="mois">Période d'étude</label>
                                    <input type="text" name="mois" class="border-bottom-dotted form-control form-control-sm text-capitalize font-weight-bold"
                                           value="<?= $data['paiements_el']->mois; ?>" readonly>
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