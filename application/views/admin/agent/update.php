
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
                                    <a href="#">Modification compte utilisateur</a>
                                </h4>

                            </div>

                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>
                        <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                        <form class="" action="<?= base_url(). 'admin/update_agent/agent/'.$agents['id_asset']; ?>" method="post">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <label for="asset_name" class="control-label"><span class="text-danger">*</span>Nom complet</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control text-capitalize" name="asset_name" value="<?= $agents['asset_name'] ? $agents['asset_name'] : set_value('asset_name'); ?>"  />
                                        <span class="text-danger"><?php echo form_error('asset_name');?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="asset_username" class="control-label"><span class="text-danger">*</span>Nom utilisateur</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="asset_username" value="<?= $agents['asset_username'] ? $agents['asset_username'] : set_value('asset_username'); ?>"  />
                                        <span class="text-danger"><?php echo form_error('asset_username');?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="asset_email" class="control-label"><span class="text-danger">*</span>Adresse Email</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="asset_email" value="<?= $agents['asset_email'] ? $agents['asset_email'] : set_value('asset_email'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('asset_email');?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="asset_password" class="control-label"><span class="text-danger">*</span>Mot de passe</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="asset_password"
                                               disabled="disabled" contenteditable="false"
                                               value="<?= $agents['asset_password'] ? $agents['asset_password'] : set_value('asset_password'); ?>" />
                                        <span class="text-danger"><?php echo form_error('asset_password');?></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="groupe" class="control-label"><span class="text-danger">*</span>Groupe Utilisateur</label>
                                        <select class="browser-default custom-select" name="groupe" >
                                            <?php
                                            if ($agents['groupe'] == "utilisateur") { ?>
                                                <option value="enseignant">Enseignant</option>
                                                <option value="administratif">Administratif</option>
                                                <option value="financier">Financier</option>
                                                <option value="administrator">Administrateur système</option>
                                            <?php } elseif ($agents['groupe'] == "administrator") { ?>
                                                <option selected value="agent">Utilisateur</option>
                                                <option value="enseignant">Enseignant</option>
                                                <option value="administratif">Administratif</option>
                                                <option value="financier">Financier</option>
                                                <option selected value="administrator">Administrateur système</option>
                                            <?php } elseif ($agents['groupe'] == "administratif") { ?>
                                                <option value="agent">Utilisateur</option>
                                                <option value="enseignant">Enseignant</option>
                                                <option selected value="administratif">Administratif</option>
                                                <option value="financier">Financier</option>
                                                <option selected value="administrator">Administrateur système</option>
                                            <?php } elseif ($agents['groupe'] == "financier") { ?>
                                                <option value="agent">Utilisateur</option>
                                                <option value="enseignant">Enseignant</option>
                                                <option value="administratif">Administratif</option>
                                                <option selected value="financier">Financier</option>
                                                <option selected value="administrator">Administrateur système</option>
                                            <?php } elseif ($agents['groupe'] == "enseignant") { ?>
                                                <option value="agent">Utilisateur</option>
                                                <option selected value="enseignant">Enseignant</option>
                                                <option value="administratif">Administratif</option>
                                                <option value="financier">Financier</option>
                                                <option selected value="administrator">Administrateur système</option>
                                            <?php } else { ?>
                                                <option disabled>Choisissez un type utilisaeur</option>
                                                <option value="enseignant">Enseignant</option>
                                                <option value="administratif">Administratif</option>
                                                <option value="financier">Financier</option>
                                                <option value="administrator">Administrateur système</option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('groupe');?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="asset_departement" class="control-label"><span class="text-danger">*</span>Departement</label>

                                        <select class="form-control <?= form_error('asset_departement') ? 'is-invalid' : 'is-valid'; ?>"
                                                style="width: 100%;" name="asset_departement" id="asset_departement" required>
                                            <option disabled selected>Choisir un département</option>
                                            <?php
                                                if (($agents['asset_departement'] == "")) { ?>
                                                    <option>Enseignement</option>
                                                    <option>Finance</option>
                                                    <option>Administration</option>
                                                    <option>Safety & Security</option>
                                                <?php } else {?>
                                                <option selected><?= $agents['asset_departement']; ?></option>
                                                    <option>Enseignement</option>
                                                    <option>Finance</option>
                                                    <option>Administration</option>
                                                    <option>Safety & Security</option>
                                                <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('asset_departement');?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="asset_type" class="control-label"><span class="text-danger">*</span>Type compte
                                        </label>
                                        <select class="browser-default custom-select select2" name="asset_type" id="asset_type">
                                            <?php
                                            if ($agents['asset_type'] == "utilisateur") { ?>
                                                <option selected value="utilisateur">Utilisateur</option>
                                                <option value="administrator">Administrateur système</option>
                                            <?php } elseif ($agents['asset_type'] == "administrator") { ?>
                                                <option value="utilisateur">Utilisateur</option>
                                                <option selected value="administrator">Administrateur système</option>
                                            <?php } else { ?>
                                                <option selected disabled>Selectionnez un type compte</option>
                                                <option value="utilisateur">Utilisateur</option>
                                                <option value="administrator">Administrateur système</option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('asset_type'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-outline-danger" value="Modifier">
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
