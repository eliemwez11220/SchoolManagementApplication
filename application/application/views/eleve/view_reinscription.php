

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-asterisk"></i> Page de réinscription</h1>
            <p>Application web de gestion centralisée des activités scolaires Masomo_meneja</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-asterisk fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Page de réinscription</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="container-fluid">
            <?php include_once ("application/views/auth/alert.php"); ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="tile card card-height-400 border-primary">
                <h3 class="tile-title">Matricule : <?= $data['ut']->matricule_eleve;?></h3>
                <div class="tile-body text-justify">
                    Des nos jours, les institutions scolaires sont considérées au même titre que les entreprises administratives
                    ordinaires, pour ce fait, elles doivent être dotées des outils nécéssaires pour assurer une bonne gestion des informations qu'elles regorgent en leur sein.
                    <br> Raison pour la quelle cette application a été mise en place afin d'informatiser la gestion des activités scolaires.
                </div>
                <div class="tile-body text-justify">
                    Soyez attentifs aux interactions y afferant, car toute manipulation  est prise en compte et affecte le système entier.
                </div>
                <div class="tile-footer text-center"><a class="btn btn-outline-danger" href="<?= base_url('auth/deconnexion');?>"> <span class="fa fa-sign-out"></span> Déconnexion</a></div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card card-height-400 border-primary">

                <div class="card-header text-xs-on-small-only">
                    <h3>Réinscription de l'élève <?=$data['ut']->matricule_eleve;?></h3>
                </div>
                <?php $hidden = array('matricule_eleve' => $data['el']->matricule_eleve);?>
                <?=form_open('eleve/dmd_reinscription', '', $hidden)?>
                <form action="<?= base_url(); ?>" method="post">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <input data-toggle="tooltip" data-placement="top" title="Nom complet de l'élève"
                                            type="text" name="nom_complet" class="form-control form-control-sm <?= form_error('nom_complet') ? 'is-invalid' : 'is-valid'; ?>"
                                           placeholder="Nom de l'élève" value="<?= $data['el']->nom_complet; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <input type="text" data-toggle="tooltip" data-placement="top" title="tuteur de l'élève"
                                           name="nom_tuteur" class="form-control form-control-sm <?= form_error('nom_tuteur') ? 'is-invalid' : 'is-valid'; ?>"
                                           placeholder="tuteur de l'élève" value="<?= $data['el']->nom_tuteur ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" data-toggle="tooltip" data-placement="top" title="Lieu où réside l'élève"
                                           name="adresse_eleve" class="form-control form-control-sm <?= form_error('adresse_eleve') ? 'is-invalid' : 'is-valid'; ?>"
                                           placeholder="Adresse domiciliaire de l'élève" value="<?= $data['el']->adresse_eleve ?>">
                                </div>
                                <div class="form-group">
                                    <input type="number" data-toggle="tooltip" data-placement="top" title="Numéro à contacter en cas de besoin"
                                           name="contact_eleve" class="form-control form-control-sm <?= form_error('contact_eleve') ? 'is-invalid' : 'is-valid'; ?>"
                                           placeholder="Téléphone à contacter en cas de besoin" value="<?= $data['el']->contact_eleve ?>" >
                                </div>
                                <div class="form-group">
                                    <input type="text" data-toggle="tooltip" data-placement="top" title="Cycle d'étude" name="cycle"
                                           class="form-control form-control-sm <?= form_error('cycle') ? 'is-invalid' : 'is-valid'; ?>"
                                           placeholder="Classe" value="<?= $data['cl']->cycle; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col xs-6">
                                <div class="form-group">
                                    <input type="text" data-toggle="tooltip" data-placement="top" title="Classe" name="nom_classe"
                                           class="form-control form-control-sm <?= form_error('nom_classe') ? 'is-invalid' : 'is-valid'; ?>"
                                           placeholder="Classe" value="<?= $data['cl']->nom_classe; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 col xs-6">
                                <div class="form-group">
                                    <?php if ($data['cl']->nom_classe == "3ème humanités"):?>
                                        <select data-toggle="tooltip" data-placement="top" title="Option" name="nom_option"
                                                class="form-control form-control-sm <?= form_error('nom_option') ? 'is-invalid' : 'is-valid'; ?>" name="nom_option" id="nom_option">
                                            <option value="<?= $data['el']->nom_option; ?>" selected><?= $data['el']->nom_option; ?></option>
                                            <?php foreach ($data['options'] as $option) : if ($option->nom_option != $data['el']->nom_option): ?>
                                                <option id="<?= $option->id; ?>" value="<?= $option->nom_option; ?>" <?= set_select('nom_option', $option->nom_option); ?>>
                                                    <?= $option->nom_option ; ?>
                                                </option>
                                            <?php endif; endforeach; ?>
                                        </select>
                                    <?php else: ?>
                                    <input type="text" data-toggle="tooltip" data-placement="top" title="Option" name="nom_option"
                                           class="form-control form-control-sm <?= form_error('nom_option') ? 'is-invalid' : 'is-valid'; ?>"
                                           placeholder="Option" value="<?= $data['el']->nom_option; ?>" readonly>
                                    <?php endif;?>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group" align="center">
                                    <input type="submit" value="Confirmer l'inscription" class="btn btn-sm btn-block text-white bleu">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>

</main>
