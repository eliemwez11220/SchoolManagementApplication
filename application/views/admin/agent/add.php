
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
                                    <a href="#">Ajouter un utilisateur</a>
                                </h4>

                            </div>

                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>
                        <form class="" action="<?= base_url() . 'admin/add_agent' ?>" method="post">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <label for="asset_name" class="control-label"><span class="text-danger">*</span>Nom
                                        complet
                                        <span data-toggle="tooltip" data-placement="top"
                                              title="Nom, Post-nom et Prénom">
                                          <i class="fa fa-info-circle fa-2x" aria-hidden="true">info</i>
                                    </span>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="asset_name"
                                               value="<?= set_value('asset_name') ?>"/>
                                        <span class="text-danger"><?php echo form_error('asset_name'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="asset_username" class="control-label"><span class="text-danger">*</span>Nom
                                        utilisateur
                                        <span data-toggle="tooltip" data-placement="top"
                                              title="Nom de connexion (login)">
                                          <i class="fa fa-info-circle fa-2x" aria-hidden="true">info</i>
                                    </span>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="asset_username"
                                               value="<?= set_value('asset_username') ?>"/>
                                        <span class="text-danger"><?php echo form_error('asset_username'); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="asset_email" class="control-label"><span class="text-danger">*</span>Adresse
                                        Email</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="asset_email"
                                               value="<?= set_value('asset_email') ?>"/>
                                        <span class="text-danger"><?php echo form_error('asset_email'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="groupe" class="control-label"><span class="text-danger">*</span>Groupe utilisateur
                                        </label>
                                        <select class="browser-default custom-select select2" name="groupe">
                                            <option disabled selected>Choisir un groupe utilisateur</option>
                                            <option value="enseignant">Enseignant</option>
                                            <option value="administratif">Administratif (Prefet ou Secretaire)</option>
                                            <option value="financier">Financier (Comptable ou Percepteur)</option>
                                            <option value="administrator">Administrateur système</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('groupe'); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="asset_type" class="control-label"><span class="text-danger">*</span>Type compte
                                        </label>
                                        <select class="browser-default custom-select select2" name="asset_type">
                                            <option disabled>Choisir un type</option>
                                            <option value="utilisateur">Utilisateur</option>
                                            <option value="administrator">Administrateur système</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('asset_type'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="asset_departement" class="control-label"><span
                                                    class="text-danger">*</span>Departement</label>

                                        <select class="select2 form-control form-control-sm <?= form_error('asset_departement') ? 'is-invalid' : 'is-valid'; ?> select2"
                                                style="width: 100%;" name="asset_departement" id="asset_departement"
                                                required>
                                            <option disabled selected>Choisir un département</option>
                                            <option>Enseignement</option>
                                            <option>Finance et comptabilité</option>
                                            <option>Administration</option>
                                            <option>Safety & Security</option>

                                        </select>
                                        <span class="text-danger"><?php echo form_error('asset_departement'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="asset_password" class="control-label"><span class="text-danger">*</span>Mot
                                        de passe (default)</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="asset_password" value="123456"
                                               readonly/>
                                        <span class="text-danger"><?php echo form_error('asset_password'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-outline-danger" value="Enregistrer">
                            <a href="<?= base_url() . "admin/agent/"; ?>" class="btn btn-danger pull-right">
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
