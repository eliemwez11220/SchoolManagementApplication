<?php
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <!-- Heading -->
                        <div class="card mb-4 wow fadeIn">
                            <!--Card content-->
                            <div class="card-body d-sm-flex justify-content-between">
                                <h4 class="mb-2 mb-sm-0 pt-1">
                                    <a href="#">Modification d'une classe scolaire</a>
                                </h4>
                            </div>
                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>

                        <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                        <form class="" action="<?= base_url() . 'admin/update_incription/inscription/' . $inscription['id_inscription']; ?>"
                              method="post">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <label for="nom_complet" class="control-label"><span class="text-danger">*</span>Nom
                                        complet élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="nom_complet" readonly
                                               value="<?= $inscription['nom_complet'] ? $inscription['nom_complet'] : set_value('nom_complet'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_complet'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="matricule_eleve" class="control-label"><span class="text-danger">*</span>Numéro matricule
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="matricule_eleve" readonly
                                               value="<?= $inscription['matricule_eleve'] ? $inscription['matricule_eleve'] : set_value('matricule_eleve'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('matricule_eleve'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="date_inscription" class="control-label"><span class="text-danger">*</span>Date d'inscripion
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control text-capitalize" name="date_naissance"
                                               value="<?= $inscription['date_inscription'] ? $inscription['date_inscription'] : set_value('date_inscription'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('date_inscription'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="annee_scolaire" class="control-label"><span class="text-danger">*</span> Année scolaire</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="annee_scolaire"
                                               value="<?= $inscription['annee_scolaire'] ? $inscription['annee_scolaire'] : set_value('annee_scolaire'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('annee_scolaire'); ?></span>
                                    </div>
                                </div><div class="col-md-4">
                                    <label for="nom_classe" class="control-label"><span class="text-danger">*</span>Nom
                                        de la classe</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom_classe"
                                               value="<?= $inscription['nom_classe'] ? $inscription['nom_classe'] : set_value('nom_classe'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_classe'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="nom_option" class="control-label"><span class="text-danger">*</span>Nom
                                        de l'option</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom_option"
                                               value="<?= $inscription['nom_option'] ? $inscription['nom_option'] : set_value('nom_option'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_option'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="nom_section" class="control-label"><span class="text-danger">*</span>Nom
                                        de la section</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom_section"
                                               value="<?= $inscription['nom_section'] ? $inscription['nom_section'] : set_value('nom_section'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_section'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="classe_cycle" class="control-label"><span
                                                class="text-danger">*</span>Cycle d'étude</label>
                                    <div class="form-group">
                                        <select class="browser-default custom-select select2" name="classe_cycle" >
                                            <?php
                                            if ($inscription['cycle'] == "primaire") { ?>
                                                <option selected value="primaire">Primaire</option>
                                                <option value="secondaire">Secondaire</option>
                                                <option value="maternel">Maternelle</option>
                                                <option value="creche">Créche</option>
                                                <option value="EB">Education de base</option>
                                            <?php } elseif ($inscription['cycle'] == "secondaire") { ?>
                                                <option value="primaire">Primaire</option>
                                                <option selected value="secondaire">Secondaire</option>
                                                <option value="maternel">Maternelle</option>
                                                <option value="creche">Créche</option>
                                                <option value="EB">Education de base</option>
                                            <?php } elseif ($inscription['cycle'] == "maternelle") { ?>
                                                <option value="primaire">Primaire</option>
                                                <option value="secondaire">Secondaire</option>
                                                <option selected value="maternel">Maternelle</option>
                                                <option value="creche">Créche</option>
                                                <option value="EB">Education de base</option>
                                            <?php } elseif ($inscription['cycle'] == "creche") { ?>
                                                <option value="primaire">Primaire</option>
                                                <option value="secondaire">Secondaire</option>
                                                <option value="maternel">Maternelle</option>
                                                <option selected value="creche">Créche</option>
                                                <option value="EB">Education de base</option>
                                            <?php } else { ?>
                                                <option disabled>Choisissez un cycle d'étude</option>
                                                <option value="primaire">Primaire</option>
                                                <option value="secondaire">Secondaire</option>
                                                <option value="maternel">Maternelle</option>
                                                <option value="creche">Créche</option>
                                                <option value="EB">Education de base</option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('classe_cycle'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="etat_inscription" class="control-label"><span class="text-danger">*</span>Demande d'inscription effectuée
                                        le</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="etat_inscription" readonly
                                               value="<?= 'validé' ? 'validé' : set_value('etat_inscription'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('etat_inscription'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="date_demande" class="control-label"><span class="text-danger">*</span>Etat demande d'inscription
                                        </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control text-capitalize" name="date_demande"
                                               value="<?= $inscription['date_demande'] ? $inscription['date_demande'] : set_value('date_demande'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('date_demande'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-outline-danger" value="Modifier">
                            <a href="<?= base_url() . "administratif/inscription"; ?>" class="btn btn-danger">
                                <i class="fa fa-close"></i> Annuler & afficher la liste
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
