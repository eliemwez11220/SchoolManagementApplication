

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> Page de fixation des frais</h1>
            <p>Gestion des opérations comptables et financières sur l'apurement de paiement des frais académiques ISS/Lubumbashi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-money fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Page de fixation des frais</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="container-fluid">
            <?php include_once ("application/views/auth/alert.php"); ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Nom d'utilisateur : <?= $data['ut']->nom_ut;?></h3>
                <div class="tile-body text-justify">
                    L'institut superieur de statistique étant une organisation ordonnée de grande renommée, mérite d'être doté des moyens et outils
                    modernes des nouvelles technologies de l'information et de la communication afin de garantir au mieux la gestion de ses divers
                    processus internes.
                </div>
                <div class="tile-body text-justify">
                    Soyez attentifs aux interactions y afferant, car toute manipulation prise en compte, impacte le système entier.
                </div>
                <div class="tile-footer"><a class="btn btn-outline-danger" href="<?= base_url('auth/deconnexion');?>"> <span class="fa fa-sign-out"></span> Déconnexion</a></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="tile" style="padding-bottom: unset!important;">
                <div class="tile-title-w-btn">
                    <h3 class="title">Fixations des frais à payer</h3>
                </div>
                <div class="tile-body text-justify">
                    <form action="<?= base_url('financier/fixer_frais'); ?>" method="post">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="type_frais" class="form-control form-control-sm font-weight-bold <?= form_error('type_frais') ? 'is-invalid' : 'is-valid'; ?>" required>

                                            <option disabled selected>Choisir frais</option>
                                            <option value="Attestation de fréquentation">Attestation de fréquentation</option>
                                            <option value="Entérinement diplôme">Entérinement diplôme</option>
                                            <option value="Fiche de recherche">Fiche de recherche</option>
                                            <option value="Inscription">Inscription|Réinscription</option>
                                            <option value="Minerval">Minerval</option>
                                            <option value="Rélévé de côtes">Rélévé de côtes</option>
                                            <option value="Session d'examen">session d'examen</option>
                                            <option value="Stage">Stage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm font-weight-bold <?= form_error('id_promotion') ? 'is-invalid' : 'is-valid'; ?>" name="id_promotion" id="id_promotion">
                                            <option disabled selected>Choisir la promotion</option>
                                            <?php foreach ($data['promotions'] as $promotion) : ?>
                                                <option id="<?= $promotion->id_promotion; ?>" value="<?= $promotion->id_promotion; ?>" <?= set_select('id_promotion', $promotion->id_promotion); ?>>
                                                    <?= $promotion->promotion . " | ".  $promotion->departement. " | " . $promotion->code_option ; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="montant_fixe" value="<?=set_value('montant_fixe')?>" placeholder="Montant fixé"
                                               class="form-control form-control-sm is-valid text-center font-weight-bold <?= form_error('montant_fixe') ? 'is-invalid' : 'is-valid'; ?>">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="devise" class="form-control form-control-sm font-weight-bold <?= form_error('devise') ? 'is-invalid' : 'is-valid'; ?>" required>

                                            <option disabled selected>Choisir devise</option>
                                            <option value="CDF">CDF</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="number" name="taux_change" value="<?=set_value('taux_change')?>" placeholder="Taux de change"
                                               class="form-control form-control-sm is-valid font-weight-bold <?= form_error('taux_change') ? 'is-invalid' : 'is-valid'; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="annee" value="<?=$data['annee_academ']?>"
                                               class="form-control form-control-sm is-valid text-center font-weight-bold" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="date" name="delai" value="<?=set_value('delai')?>" min="<?=date('Y-m-d')?>"
                                               class="form-control form-control-sm <?= form_error('delai') ? 'is-invalid' : 'is-valid'; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group container-fluid" align="center">
                                    <input type="submit" value="Fixer frais" class="form-control-sm btn btn-primary btn-sm btn-block">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-primary">

                <div class="card-header">
                    <h3 class="display-5 text-center">Tous les frais payables </h3>
                </div>

                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Frais</th>
                                <th>montant_fixe</th>
                                <th>Promotion</th>
                                <th>Délai</th>
                                <th>Année Academ</th>
                                <th width="5%">Suppresion</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Frais</th>
                                <th>montant fixé</th>
                                <th>Promotion</th>
                                <th>Délai</th>
                                <th>Année Academ</th>
                                <th width="5%">Suppresion</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $count = 1; foreach ($data['fix'] as $fix): ?>
                                <tr class="">
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-lowercase"><?= $fix->type_frais; ?></td>
                                    <td class="text-uppercase"><?= $fix->montant_fixe . " ". $fix->devise;; ?></td>
                                    <td class="text-lowercase"><?= $fix->promotion. " ".$fix->code_option ; ?></td>
                                    <td class="text-lowercase"><?= utf8_encode(strftime("%d-%m-%Y", strtotime($fix->delai))); ?></td>
                                    <td class="text-uppercase"><?= $fix->annee; ?></td>
                                    <td class="text-center">
                                        <a onclick="return confirm('Voulez-vous vraiment supprimer ce frais ?')" class="btn-rond-sm bg-danger"
                                           href="<?= base_url( 'financier/suppr_frais?id=' . $fix->id); ?>"><i class="fa fa-remove"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
</main>