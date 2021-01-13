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
                    <?php if (isset($inscriptions)) { ?>

                        <!--Card-->
                        <div class="card">
                            <div class="card-header user-header alt danger-color-dark">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4 class="text-light text-uppercase font-weight-bold">
                                                    inscription/réinscription
                                                </h4>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="float-right">
                                                    <form method="post"
                                                          action="<?= base_url() . 'administratif/inscription' ?>">
                                                        <div class="form-group">

                                                            <?php $array_periodes = array();
                                                            foreach ($periodes as $periode) :

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

                                                            <input type="submit" class="btn btn-primary btn-sm"
                                                                   name="submit" value="Voir">
                                                        </div>
                                                    </form>
                                                </div>
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
                                            <th>Nom élève</th>
                                            <th>Matricule élève</th>
                                            <th>Année scolaire</th>
                                            <th>Classe / option</th>
                                            <th>Section / Cycle</th>
                                            <th>Date d'incription</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($inscriptions != "") {
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($inscriptions as $carte) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $count++; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nom_complet; ?></td>
                                                    <td class="text-capitalize"><?= $carte->matricule_eleve; ?></td>
                                                    <td class="text-capitalize"><?= $carte->annee_scolaire; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nom_classe . " " . $carte->nom_option; ?></td>
                                                    <td class="text-capitalize"><?= $carte->cycle . " " . $carte->nom_section; ?></td>
                                                    <td class="text-capitalize"><?= $carte->date_inscription; ?></td>
                                                    <td class="text-capitalize"><?= $carte->etat_inscription; ?></td>
                                                    <td>
                                                        <?php if ($carte->etat_inscription != "validé") { ?>
                                                            <a class="btn btn-warning btn-sm"
                                                               data-toggle="modal"
                                                               data-target="#details_el<?= $carte->id_inscription; ?>"
                                                               href="/"></a>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url() . "administratif/update_form/inscription/" . $carte->id_inscription; ?>"
                                                               class="btn btn-primary btn-rounded btn-sm my-0">
                                                            <span class="table-edit" data-toggle="tooltip"
                                                                  data-placement="bottom"
                                                                  title="Réinscrire un élève"> Réincrire</span>
                                                            </a>
                                                        <?php } ?>
                                                        <a href="<?= base_url() . "administratif/update_form/inscription/" . $carte->id_inscription; ?>"
                                                           class="btn btn-success btn-rounded btn-sm my-0">
                                                            <span class="table-edit" data-toggle="tooltip"
                                                                  data-placement="bottom"
                                                                  title="Actualier infos incriptions">
                                                                Editer</span>
                                                        </a>

                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="details_el<?= $carte->id_inscription; ?>"
                                                     tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="card-header danger-color-dark text-light">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h3 class="text-shadow-black text-center">
                                                                            Validation de l'inscription
                                                                        </h3>

                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body font-weight-bold">
                                                                <form action="<?= base_url() . 'administratif/valider_inscription/' . $carte->id_inscription; ?>"
                                                                      method="post">
                                                                    <div class="row clearfix">
                                                                        <div class="col-md-6">
                                                                            <label for="nom_complet"
                                                                                   class="control-label"><span
                                                                                        class="text-danger">*</span>Nom
                                                                                complet élève</label>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       class="form-control text-capitalize"
                                                                                       name="nom_complet" readonly
                                                                                       value="<?= $carte->nom_complet ? $carte->nom_complet : set_value('nom_complet'); ?>"/>
                                                                                <span class="text-danger"><?php echo form_error('nom_complet'); ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="matricule_eleve"
                                                                                   class="control-label"><span
                                                                                        class="text-danger">*</span>Numéro
                                                                                matricule
                                                                                de l'élève</label>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       class="form-control text-capitalize"
                                                                                       name="matricule_eleve" readonly
                                                                                       value="<?= $carte->matricule_eleve ? $carte->matricule_eleve : set_value('matricule_eleve'); ?>"/>
                                                                                <span class="text-danger"><?php echo form_error('matricule_eleve'); ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="id_inscription"
                                                                                   class="control-label"><span
                                                                                        class="text-danger">*</span>Identifiant
                                                                                inscription</label>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       class="form-control text-capitalize"
                                                                                       name="id_inscription"
                                                                                       value="<?= $carte->id_inscription ? $carte->id_inscription : set_value('id_inscription'); ?>"/>
                                                                                <span class="text-danger"><?php echo form_error('id_inscription'); ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="date_demande"
                                                                                   class="control-label"><span
                                                                                        class="text-danger">*</span>Etat
                                                                                demande d'inscription
                                                                            </label>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control"
                                                                                       name="etat_inscription"
                                                                                       value="<?= 'validé' ? 'validé' : set_value('etat_inscription'); ?>"/>
                                                                                <span class="text-danger"><?php echo form_error('etat_inscription'); ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-center offset-4 col-md-4">
                                                                            <input type="submit" class="btn btn-danger"
                                                                                   value="Valider l'inscription">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
