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
        <div class="card">
            <div class="card-header mb-4 wow fadeIn bg-light">

                <!--Card content-->
                <div class="row d-sm-flex justify-content-between">
                    <div class="col-md-6">
                        <h4 class="mb-2 mb-sm-0 pt-1" style="margin-top: 20px;">
                            <span>Details des utilisateurs</span>
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <span class="table-add float-right mb-3 mr-2">
                            <a data-toggle="tooltip" data-placement="bottom"
                               title="Cliquer pour ajouter un compte agent d'utilisation"
                               href="<?php echo base_url() . 'admin/add_form/agent/add'; ?>" class="text-danger">
                                <i class="fa fa-plus fa-2x" aria-hidden="true"></i>Creer nouveau compte</a></span>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Table  -->
                    <table id="dtMaterialDesignExample" class="table table-hover table-striped" width="100%">

                        <!-- Table head -->
                        <thead class="danger-color-dark text-light ">
                        <tr class="text-uppercase">
                            <th>#</th>
                            <th class="font-weight-bold">Nom complet</th>
                            <th class="font-weight-bold">Nom Utilisateur</th>
                            <th class="font-weight-bold">Type compte</th>
                          
                            <th class="font-weight-bold">Departement</th>
                            <th class="font-weight-bold">Date création</th>
                            <th class="font-weight-bold">Opérations</th>
                        </tr>
                        </thead>
                        <!-- Table head -->

                        <!-- Table body -->
                        <tbody>
                        <?php $line = 1;
                        foreach ($managers as $value) { ?>
                            <tr>
                                <td><?= $line; ?></td>
                                <td class="text-uppercase"><?= $value->asset_name; ?></td>
                                <td class="text-uppercase"><?= $value->asset_username; ?></td>
                                <td class="text-uppercase"><?= $value->asset_type; ?></td>
                                
                                <td class="text-uppercase"><?= $value->asset_departement; ?></td>
                                <td><?= $value->date_connected; ?></td>
                                <td>
                                    <a href="<?= base_url() . "admin/reset_agent_password?id_asset=" . $value->id_asset ?>"
                                       onclick="return confirm('Voulez-vous vraiment réinitialiser le mot de passe de <?= $value->asset_username ?>?') ">
                                        <span class="table-edit" data-toggle="tooltip" data-placement="bottom"
                                              title="Cliquer pour reinitialiser le mot de passe">
                                            <button type="button" class="btn-danger btn-rounded btn-sm my-0">
                                               réinitialiser</button></span>
                                    </a>
                                    <?php
                                    if ($value->status == 1) { ?>
                                        <a href="<?= base_url() . "admin/bloquer_agent?id_asset=" . $value->id_asset ?>"
                                           onclick="return confirm('Voulez-vous vraiment bloquer le compte utilisateur de <?= $value->asset_username ?>?')">
                                        <span class="table-edit" data-toggle="tooltip" data-placement="bottom"
                                              title="Cliquer pour désactiver ce compte utilisateur">
                                            <button type="button" class="btn-warning btn-rounded btn-sm my-0"><i
                                                        class="fa fa-lock"></i></button></span>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url() . "admin/debloquer_agent?id_asset=" . $value->id_asset ?>"
                                           onclick="return confirm('Voulez-vous vraiment debloquer le compte utilisateur de <?= $value->asset_username ?> ?') ">
                                        <span class="table-edit" data-toggle="tooltip" data-placement="bottom"
                                              title="Cliquer pour activer ce compte utilisateur">
                                            <button type="button" class="btn-primary btn-rounded btn-sm my-0"><i
                                                        class="fa fa-unlock"></i></button></span>
                                        </a>
                                    <?php } ?>
                                    <a href="<?= base_url() . "admin/update_form/agent/" . $value->id_asset ?>">
                                        <span class="table-edit" data-toggle="tooltip" data-placement="bottom"
                                              title="Cliquer pour modifier ce compte utilisateur">
                                            <button type="button" class="btn-success btn-rounded btn-sm my-0"><i
                                                        class="fa fa-edit"></i></button></span>
                                    </a>
                                </td>
                            </tr>
                            <?php $line++;
                        } ?>

                        </tbody>
                        <!-- Table body -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
