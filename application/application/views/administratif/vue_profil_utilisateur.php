

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                                    <span>Modifier votre mot de passe</span>
                                </h4>

                            </div>

                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <!-- stockage de l'ID -->
                        <?php $id = $this->uri->segment(5); ?>
                        <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                        <?php echo form_open(base_url('admin/profil')); ?>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <label for="" class="control-label"><span class="text-danger">*</span>Mot de passe actuel</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="anc_mot_pass" <?= form_error('anc_mot_pass') ? 'is-invalid' : 'is-valid'; ?>"/>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="control-label"><span class="text-danger">*</span>Nouveau Mot de passe</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nvo_mot_pass" <?= form_error('nvo_mot_pass') ? 'is-invalid' : 'is-valid'; ?>  minlength="6" maxlength="50"
                                           value="<?= set_value('nvo_mot_pass'); ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="control-label"><span class="text-danger">*</span>Confirmer le mot de passe</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="conf_mot_pass" <?= form_error('conf_mot_pass') ? 'is-invalid' : 'is-valid'; ?> minlength="6" maxlength="50"  value="<?= set_value('conf_mot_pass'); ?>"/>
                                </div>
                            </div>

                        </div>
                        <input type="submit" class="btn btn-outline-danger" value="Modifier">
                        <a href="<?= base_url() . "admin/dashboard"; ?>" class="btn btn-danger">
                            <i class="fa fa-close"></i> Annuler & afficher la liste
                        </a>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<br><br><br><br><br><br><br><br><br>
