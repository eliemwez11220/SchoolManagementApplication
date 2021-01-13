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
                                    <a href="#">Modification des infos d'un élève</a>
                                </h4>
                            </div>
                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>
                        <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                        <form class=""
                              action="<?= base_url() . 'administratif/update_eleve/eleve/' . $eleve['id_eleve']; ?>"
                              method="post">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <label for="nom_complet" class="control-label"><span class="text-danger">*</span>Nom
                                        complet élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="nom_complet"
                                               value="<?= $eleve['nom_complet'] ? $eleve['nom_complet'] : set_value('nom_complet'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_complet'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="control-label"><span class="text-danger">*</span>Adresse e-mail
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-lowercase" name="email"
                                               value="<?= $eleve['email'] ? $eleve['email'] : set_value('email'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="genre" class="control-label"><span class="text-danger">*</span>Sexe
                                        de l'élève</label>
                                    <div class="form-group">
                                        <select class="browser-default custom-select text-capitalize" name="genre" id="genre">
                                            <?php
                                            if ($eleve['genre'] == "masculin") { ?>
                                                <option selected value="masculin">Masculin</option>
                                                <option value="feminin">Féminin</option>
                                            <?php } elseif ($eleve['genre'] == "feminin") { ?>
                                                <option  value="masculin">Masculin</option>
                                                <option selected value="feminin">Féminin</option>
                                            <?php } else { ?>
                                                <option selected disabled>Selectionnez le sexe de l'élève</option>
                                                <option value="masculin">Masculin</option>
                                                <option value="feminin">Féminin</option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('genre'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="nom_tuteur" class="control-label"><span class="text-danger">*</span>Nom du tuteur
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="nom_tuteur"
                                               value="<?= $eleve['nom_tuteur'] ? $eleve['nom_tuteur'] : set_value('nom_tuteur'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_tuteur'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="date_naissance" class="control-label"><span class="text-danger">*</span>Date de naissance
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control text-capitalize" name="date_naissance"
                                               value="<?= $eleve['date_naissance'] ? $eleve['date_naissance'] : set_value('date_naissance'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('date_naissance'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="lieu_naissance" class="control-label"><span class="text-danger">*</span>Lieu de naissance
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="lieu_naissance"
                                               value="<?= $eleve['lieu_naissance'] ? $eleve['lieu_naissance'] : set_value('lieu_naissance'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('lieu_naissance'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="nom_pere" class="control-label"><span class="text-danger">*</span>Nom du père
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="nom_pere"
                                               value="<?= $eleve['nom_pere'] ? $eleve['nom_pere'] : set_value('nom_pere'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_pere'); ?></span>
                                    </div>
                                </div>
                                   <div class="col-md-4">
                                    <label for="nom_mere" class="control-label"><span class="text-danger">*</span>Nom de la mère
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom_mere"
                                               value="<?= $eleve['nom_mere'] ? $eleve['nom_mere'] : set_value('nom_mere'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('nom_mere'); ?></span>
                                    </div>
                                </div><div class="col-md-4">
                                    <label for="contact_eleve" class="control-label"><span class="text-danger">*</span>Numéro téléphone
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="contact_eleve"
                                               value="<?= $eleve['contact_eleve'] ? $eleve['contact_eleve'] : set_value('contact_eleve'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('contact_eleve'); ?></span>
                                    </div>
                                </div>
                                   <div class="col-md-4">
                                    <label for="adresse_eleve" class="control-label"><span class="text-danger">*</span>Adresse domicilaire
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="adresse_eleve"
                                               value="<?= $eleve['adresse_eleve'] ? $eleve['adresse_eleve'] : set_value('adresse_eleve'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('adresse_eleve'); ?></span>
                                    </div>
                                </div><div class="col-md-4">
                                    <label for="statut_eleve" class="control-label"><span class="text-danger">*</span>Statut d'accès
                                        de l'élève</label>
                                    <div class="form-group">
                                        <select class="browser-default custom-select text-capitalize" name="statut_eleve" id="statut_eleve">
                                            <?php
                                            if ($eleve['statut_eleve'] == "online") { ?>
                                                <option selected value="online">En ligne</option>
                                                <option value="offline">Non en ligne</option>
                                            <?php } elseif ($eleve['statut_eleve'] == "offline") { ?>
                                                <option  value="online">En ligne</option>
                                                <option selected value="offline">Non en ligne</option>
                                            <?php } else { ?>
                                                <option selected disabled>Selectionnez un statut élève</option>
                                                <option  value="online">En ligne</option>
                                                <option value="offline">Non en ligne</option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('statut_eleve'); ?></span>
                                    </div>
                                </div><div class="col-md-4">
                                    <label for="matricule_eleve" class="control-label"><span class="text-danger">*</span>Numéro matricule
                                        de l'élève</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="matricule_eleve" readonly
                                               value="<?= $eleve['matricule_eleve'] ? $eleve['matricule_eleve'] : set_value('matricule_eleve'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('matricule_eleve'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-danger" value="Appliquer les modifications">
                            <a href="<?= base_url() . "administratif/eleve/"; ?>" class="btn btn-outline-danger">
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
