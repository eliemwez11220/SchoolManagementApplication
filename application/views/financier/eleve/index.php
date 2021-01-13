<?php
if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) { ?>
    <div class="container" style="margin-top: 10px;margin-bottom: 10px;">
        <div class="row">
            <h6 class="text-dark">
                <?php include_once "application/views/alertes/alert-index.php"; ?>
            </h6>
        </div>
    </div>
<?php } ?>
<div class="row" style="font-size: 20px;">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header user-header alt danger-color-dark">
                <!--Card content-->


                <div class="row d-sm-flex justify-content-between">
                    <div class="col-md-4">
                        <!--Card content-->
                        <div class="card-body d-sm-flex justify-content-between">
                            <h5 class="mb-2 mb-sm-0 pt-1 text-center text-uppercase text-light font-weight-bold">
                                Liste des élèves inscrits
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-8 float-right">

                        <form class="form-inline" method="post" action="<?= base_url(). 'financier/eleve' ?>">

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
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Table  -->
                    <table id="dtMaterialDesignExample" class="table table-hover table-striped" width="100%">

                        <!-- Table head -->
                        <thead class="danger-color-dark text-light lighten-4">
                        <tr class="text-uppercase">
                            <th class="th-sm">#</th>
                            <th>Nom complet</th>
                            <th>Matricule</th>
                            <th>Classe / option</th>
                            <th>Cycle / section</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                        <?php $line = 1;
                        foreach ($eleves as $eleve): ?>
                            <tr>
                                <td><?= $line++ ?></td>
                                <td class="text-capitalize"><?= $eleve->nom_complet; ?></td>
                                <td class="text-capitalize"><?= $eleve->matricule_eleve; ?></td>
                                <td class="text-capitalize"><?= $eleve->nom_classe . " " .$eleve->nom_option. " " .$eleve->nom_section; ?></td>
                                <td class="text-capitalize"><?= $eleve->cycle; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-success btn-rounded btn-sm my-0"
                                       href="<?= site_url( 'financier/paiements_eleves?matricule=' . $eleve->matricule_eleve). '&annee='.$eleve->annee_scolaire; ?>">Paiement</a>

                                    <a class="btn btn-primary btn-rounded btn-sm my-0" data-toggle="modal" data-target="#details_el<?= $eleve->id_eleve; ?>"
                                       href="<?= site_url( 'administratif/paiements_el?mat_el=' . $eleve->matricule_eleve). '&ann_sco='.$eleve->annee_scolaire; ?>">
                                        <i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="details_el<?= $eleve->id_eleve; ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content danger-color-dark text-light">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="text-shadow-black text-center">Détail sur l'élève : <small><?= $eleve->matricule_eleve; ?></small></h3>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button> </div>
                                            </div>
                                        </div>

                                        <div class="card-body font-weight-bold">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="nom_complet">Nom complet élève</label>
                                                        <input type="text" name="nom_complet" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->nom_complet ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="annee_scolaire">Email</label>
                                                        <input type="text" name="annee_scolaire" class="form-control form-control-sm font-weight-bold"
                                                               value="<?= $eleve->email; ?>" readonly>
                                                    </div>
                                                    <div id="div_minerval" class="form-group">
                                                        <label for="mois">Genre</label>
                                                        <input type="text" name="mois" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->genre; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="type_frais">Classe</label>
                                                        <input type="text" name="type_frais" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->nom_classe . " ". $eleve->nom_option. " ". $eleve->nom_section. " ". $eleve->cycle; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="matricule_eleve">Nom tuteur</label>
                                                        <input type="text" name="nom_tuteur" class="form-control form-control-sm font-weight-bold"
                                                               value="<?= $eleve->nom_tuteur ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="date_paiement">Date Naissance</label>
                                                    <div class="form-group">
                                                        <input type="text" name="date_paiement" class="form-control form-control-sm font-weight-bold"
                                                               value="Le <?= utf8_encode(strftime("%d-%m-%Y", strtotime($eleve->date_naissance))); ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="montant_paye">Lieu Naissance</label>
                                                        <input type="text" name="montant_paye" class="form-control form-control-sm font-weight-bold"
                                                               value="Né à <?= $eleve->lieu_naissance; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="montant_complet">Père et mère</label>
                                                        <input type="text" name="montant_complet" class="form-control form-control-sm font-weight-bold"
                                                               value="Fils(lle) de <?= $eleve->nom_pere. " et de ". $eleve->nom_mere; ?>" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="mois">Contact</label>
                                                        <input type="text" name="mois" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->contact_eleve ?>" readonly>
                                                        </select>
                                                    </div>
                                                    <div id="div_minerval" class="form-group">
                                                        <label for="mois">Adresse du domicile</label>
                                                        <input type="text" name="mois" class="form-control form-control-sm text-capitalize font-weight-bold"
                                                               value="<?= $eleve->adresse_eleve; ?>" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        </tbody>
                        <!-- Table body -->
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
