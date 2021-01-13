<!--Grid row-->
<div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-sm-12 mb-4">
        <!--Card-->
        <div class="card border-dark">
            <!--Card content-->
            <div class="card-header font-weight-bold">
                <h5 class="text-center">
                    <i class="fa fa-lock"></i> Veuillez changer le mot de passe actuel.
                    Vous ne pouvez pas conserver le mot de passe par defaut.
                </h5>
                <?php if(isset($error_update)){?>
                    <div class="alert alert-danger text-center">
                        <h6 class="s-text">
                            <?= $error_update; ?>
                        </h6>
                    </div>
                <?php }?>
            </div>
            <div class="card-body">
                <?php echo form_open(base_url('main/changer_password_default')); ?>
                <div class="col-sm-6 offset-sm-3">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                        </div>
                        <input type="text" name="nvo_mot_pass" data-toggle="tooltip"
                               data-placement="top" title="Nouveau mot de passe"
                               class="form-control <?= form_error('nvo_mot_pass') ? 'is-invalid' : 'is-valid'; ?>"
                               placeholder="Nouveau Mot de passe" minlength="6" maxlength="50"
                               value="<?= set_value('nvo_mot_pass'); ?>" autofocus>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                        </div>
                        <input type="text" name="conf_mot_pass" data-toggle="tooltip"
                               data-placement="top" title="Confirmer le nouveau mot de passe"
                               class="form-control <?= form_error('conf_mot_pass') ? 'is-invalid' : 'is-valid'; ?>"
                               placeholder="Confirmation nouveau mot de passe" minlength="6" maxlength="50"  value="<?= set_value('conf_mot_pass'); ?>">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                        </div>
                        <input type="text" name="username" data-toggle="tooltip"
                               data-placement="top" title="Nom utilisateur connecté"
                               class="form-control <?= form_error('anc_mot_pass') ? 'is-invalid' : 'is-valid'; ?>"
                               placeholder="Username" value=" <?= $_SESSION['users']; ?>"
                               minlength="3" maxlength="75" required readonly>
                    </div>
                    <input type="submit" value="Changer le mot de passe"
                           class="btn btn-primary">
                </div>

            </div>
            <?= form_close(); ?>
        </div>

    </div>
    <!--/.Card-->
</div>
<!--Grid column-->
