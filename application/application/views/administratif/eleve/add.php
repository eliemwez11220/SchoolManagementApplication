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
                                    <a href="#">Inscription d'un élève</a>
                                </h4>

                            </div>

                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>

                        <form class="" action="<?= base_url() . 'administratif/add_eleve' ?>" method="post">
                            <div class="row clearfix">

                                <div class="col-sm-6 col xs-6">

                                    <div class="form-group">
                                        <input data-toggle="tooltip" data-placement="top" title="Nom, Post-nom et Prénom de l'élève"
                                               type="text" name="nom_complet"
                                               class="form-control text-capitalize <?= form_error('nom_complet') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Nom complet de l'élève" value="<?= set_value('nom_complet'); ?>"
                                               minlength="3" maxlength="75">
                                        <span class="text-danger"><?php echo form_error('nom_complet');?></span>
                                    </div>
                                    <div class="form-group">
                                        <input data-toggle="tooltip" data-placement="top" title="Adresse mail"
                                               type="email" name="email"
                                               class="form-control text-lowercase <?= form_error('email') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Adresse mail" value="<?= set_value('email'); ?>">
                                        <span class="text-danger"><?php echo form_error('email');?></span>
                                    </div>
                                    <div class="form-group">

                                        <input data-toggle="tooltip" data-placement="top" title="Nom du père de l'élève"
                                               type="text" name="nom_pere"
                                               class="form-control text-capitalize <?= form_error('nom_pere') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Nom père" value="<?= set_value('nom_pere'); ?>"
                                               minlength="3" maxlength="45">
                                        <span class="text-danger"><?php echo form_error('nom_pere');?></span>
                                    </div>
                                    <div class="form-group">

                                        <input data-toggle="tooltip" data-placement="top"
                                               title="Nom de la mère de l'élève"
                                               type="text" name="nom_mere"
                                               class="form-control text-capitalize <?= form_error('nom_mere') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Nom mère" value="<?= set_value('nom_mere'); ?>"
                                               minlength="3" maxlength="45">
                                        <span class="text-danger"><?php echo form_error('nom_mere');?></span>
                                    </div>
                                    <div class="form-group">
                                        <select data-toggle="tooltip" data-placement="top" title="Genre de l'élève"
                                                name="genre"
                                                class="form-control text-capitalize <?= form_error('genre') ? 'is-invalid' : 'is-valid'; ?>">

                                            <option disabled selected>Choisir le sexe</option>
                                            <option value="feminin">Feminin</option>
                                            <option value="masculin">Masculin</option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('genre');?></span>
                                    </div>

                                </div>

                                <div class="col-sm-6 col xs-6">

                                    <div class="form-group">
                                        <input data-toggle="tooltip" data-placement="top"
                                               title="Date de naissance de l'élève"
                                               type="date" name="date_naissance"
                                               class="form-control text-capitalize <?= form_error('date_naissance') ? 'is-invalid' : 'is-valid'; ?> "
                                               value="<?= set_value('date_naissance'); ?>" min="<?= $date_naiss_min; ?>"
                                               max="<?= $date_naiss_max; ?>">
                                        <span class="text-danger"><?php echo form_error('date_naissance');?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                               title="Lieu de naissance"
                                               name="lieu_naissance"
                                               class="form-control text-capitalize <?= form_error('lieu_naissance') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Lieu de naissance de l'élève">
                                        <span class="text-danger"><?php echo form_error('lieu_naissance');?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="contact_eleve" data-toggle="tooltip"
                                               data-placement="top" title="Numéro à contacter en cas de besoin"
                                               class="form-control text-capitalize <?= form_error('contact_eleve') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Numéro téléphone de l'élève" minlength="10" maxlength="20">
                                        <span class="text-danger"><?php echo form_error('contact_eleve');?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                               title="Tuteur de l'élève"
                                               name="nom_tuteur"
                                               class="form-control text-capitalize <?= form_error('nom_tuteur') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Tuteur de l'élève">
                                        <span class="text-danger"><?php echo form_error('nom_tuteur');?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" data-toggle="tooltip" data-placement="top"
                                               title="Lieu où réside l'élève"
                                               name="adresse_eleve"
                                               class="form-control text-capitalize <?= form_error('adresse_eleve') ? 'is-invalid' : 'is-valid'; ?>"
                                               placeholder="Adresse domiciliaire de l'élève">
                                        <span class="text-danger"><?php echo form_error('adresse_eleve');?></span>
                                    </div>

                                </div>
                            </div>
                            <div id="row_maternel" class="row" style="display: none!important;">
                                <div class="col-sm-12 col xs-12">
                                    <div class="form-group">
                                        <select data-toggle="tooltip" data-placement="top" title="Nom de la classe"
                                                class="form-control text-capitalize <?= form_error('nom_classe') ? 'is-invalid' : 'is-valid'; ?>"
                                                name="nom_classe" id="nom_classe">
                                            <option disabled selected>Choisir la classe</option>
                                            <?php foreach ($classes_mat as $classe_mat) : ?>
                                                <option id="<?= $classe_mat->id_classe; ?>"
                                                        value="<?= $classe_mat->nom_classe; ?>" <?= set_select('nom_classe', $classe_mat->nom_classe); ?>>
                                                    <?= $classe_mat->nom_classe; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="row_primaire" class="row" style="display: none!important;">
                                <div class="col-sm-12 col xs-12">
                                    <div class="form-group">
                                        <select data-toggle="tooltip" data-placement="top" title="Nom de la classe"
                                                class="form-control text-capitalize <?= form_error('nom_classe') ? 'is-invalid' : 'is-valid'; ?>"
                                                name="nom_classe" id="nom_classe">
                                            <option disabled selected>Choisir la classe</option>
                                            <?php foreach ($classes_pri as $classe_pri) : ?>
                                                <option id="<?= $classe_mat->id_classe; ?>"
                                                        value="<?= $classe_pri->nom_classe; ?>" <?= set_select('nom_classe', $classe_pri->nom_classe); ?>>
                                                    <?= $classe_pri->nom_classe; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="row_eb" class="row" style="display: none!important;">
                                <div class="col-sm-12 col xs-12">
                                    <div class="form-group">
                                        <select data-toggle="tooltip" data-placement="top" title="Nom de la classe"
                                                class="form-control text-capitalize <?= form_error('nom_classe') ? 'is-invalid' : 'is-valid'; ?>"
                                                name="nom_classe" id="nom_classe">
                                            <option disabled selected>Choisir la classe</option>
                                            <option value="7ème EB">7ème EB</option>
                                            <option value="8ème EB">8ème EB</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="row_secondaire" class="row" style="display: none!important;">
                                <div class="col-sm-6 col xs-6">
                                    <div class="form-group">
                                        <select data-toggle="tooltip" data-placement="top" title="Nom de la classe"
                                                class="form-control text-capitalize <?= form_error('nom_classe') ? 'is-invalid' : 'is-valid'; ?>"
                                                name="nom_classe" id="nom_classe">
                                            <option disabled selected>Choisir la classe</option>
                                            <option value="3ème humanités">3ème humanités</option>
                                            <option value="4ème humanités">4ème humanités</option>
                                            <option value="5ème humanités">5ème humanités</option>
                                            <option value="6ème humanités">6ème humanités</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col xs-6">
                                    <div class="form-group">
                                        <select class="form-control text-capitalize <?= form_error('nom_option') ? 'is-invalid' : 'is-valid'; ?>"
                                                name="nom_option" id="nom_option">
                                            <option disabled selected>Choisir l'option</option>
                                            <?php foreach ($options as $option) : ?>
                                                <option id="<?= $option->id_option; ?>"
                                                        value="<?= $option->nom_option; ?>" <?= set_select('nom_option', $option->nom_option); ?>>
                                                    <?= $option->nom_option; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col xs-6">
                                    <div class="form-group">
                                        <select class="form-control <?= form_error('cycle') ? 'is-invalid' : 'is-valid'; ?>"
                                                name="cycle" id="select_cycle">
                                            <option disabled selected>Choisir le cycle</option>
                                            <option value="maternel">Maternel</option>
                                            <option value="primaire">Primaire</option>
                                            <option value="EB">Education de base</option>
                                            <option value="secondaire">Secondaire</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <input type="submit" class="btn btn-outline-danger" value="Confirmer l'inscription">
                            <a href="<?= base_url() . "administratif/eleve"; ?>" class="btn btn-danger">
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
