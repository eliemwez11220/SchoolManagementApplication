

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-gears"></i> Page de gestion financière</h1>
            <p>Gestion des opérations comptables et financières sur l'apurement de paiement des frais académiques ISS/Lubumbashi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-gears fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Page de gestion financière</a></li>
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
                    <h3 class="display-5 text-center">Situation des comptes bancaires de l'Institut Supérieur de Statistique/Lubumbashi</h3>
                </div>

                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Numéro de compte</th>
                                <th>Solde courant</th>
                                <th>Total entrée</th>
                                <th>Total sortie</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Numéro de compte</th>
                                <th>Solde courant</th>
                                <th>Total entrée</th>
                                <th>Total sortie</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $count = 1; foreach ($data['c'] as $c): ?>
                                <tr class="">
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-uppercase"><?= $c->num_compte; ?></td>
                                    <td class="text-uppercase"><?= $c->solde_courant. " ". $c->devise; ?></td>
                                    <td class="text-uppercase"><?= $c->total_entree. " ". $c->devise ; ?></td>
                                    <td class="text-uppercase"><?= $c->total_sortie. " ". $c->devise; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-primary">

                <div class="card-header">
                    <h3 class="display-5 text-center">Situation des sous comptes de l'Institut Supérieur de Statistique/Lubumbashi</h3>
                </div>

                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Désignation</th>
                                <th>Solde courant</th>
                                <th>Total entrée</th>
                                <th>Total sortie</th>
                                <th class="text-center" width="5%">Option</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Désignation</th>
                                <th>Solde courant</th>
                                <th>Total entrée</th>
                                <th>Total sortie</th>
                                <th class="text-center" width="5%">Option</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $count = 1; foreach ($data['sc'] as $sc): ?>
                                <tr class="">
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-uppercase"><?= $sc->designation; ?></td>
                                    <td class="text-uppercase"><?= $sc->solde_courant; ?> CDF</td>
                                    <td class="text-uppercase"><?= $sc->total_entree ; ?> CDF</td>
                                    <td class="text-uppercase"><?= $sc->total_sortie; ?> CDF</td>
                                    <td class="text-center">
                                        <a class="modal btn-rond-sm bg-info" data-toggle="modal" data-target="#mouvement_<?= $sc->id ?>"
                                           href=""><i class="fa fa-ellipsis-v" data-toggle="tooltip" data-placement="left" title="Effectuer un mouvement"></i></a>
                                        <div id="mouvement_<?= $sc->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content md-text">
                                                    <div class="tile">
                                                        <div class="text-center font-weight-bold">
                                                            <h2>Mouvement du <?= date('d-m-Y', strtotime(date('Y-m-d')))?></h2>
                                                        </div>
                                                        <hr>

                                                        <div class="tile-body text-justify">
                                                            <form action="<?= base_url('financier/soutirer?id='.$sc->id); ?>" method="post">
                                                                <div class="card-body">

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="sous_compte">Sous compte</label>
                                                                                <input type="text" name="sous_compte" value="<?= $sc->designation; ?>"
                                                                                       class="form-control form-control-sm is-valid font-weight-bold is-valid" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="num_compte">Numéro de compte</label>
                                                                                <select class="form-control form-control-sm font-weight-bold <?= form_error('num_compte') ? 'is-invalid' : 'is-valid'; ?>" name="num_compte" id="num_compte">
                                                                                    <option disabled selected>Choisir le compte à soutirer</option>
                                                                                    <?php foreach ($data['c'] as $compte) : ?>
                                                                                        <option id="<?= $compte->num_compte; ?>" value="<?= $compte->num_compte; ?>" <?= set_select('num_compte', $compte->num_compte); ?>>
                                                                                            <?= $compte->num_compte . " | ".  $compte->devise ; ?>
                                                                                        </option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="montant_soutire">Montant à soutirer</label>
                                                                                <input type="number" name="montant_soutire" value="<?=set_value('montant_soutire')?>" placeholder="Montant à soutirer"
                                                                                       class="form-control form-control-sm is-valid text-center font-weight-bold <?= form_error('montant_soutire') ? 'is-invalid' : 'is-valid'; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="taux">Taux de change</label>
                                                                                <input type="number" name="taux" value="<?=set_value('taux')?>" placeholder="Taux de change"
                                                                                       class="form-control form-control-sm is-valid font-weight-bold <?= form_error('taux') ? 'is-invalid' : 'is-valid'; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="motif">Motif de soutirage</label>
                                                                                <input type="text" name="motif" value="<?=set_value('motif')?>" placeholder="Motif de soutirage"
                                                                                       class="form-control form-control-sm is-valid font-weight-bold <?= form_error('motif') ? 'is-invalid' : 'is-valid'; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="form-group container-fluid" align="center">
                                                                            <input type="submit" value="Soutirer" class="form-control-sm btn btn-primary btn-sm btn-block">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                   
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>