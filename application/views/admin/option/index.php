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
                            <span>Details des options organisées</span>
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <span class="table-add float-right mb-3 mr-2">
                            <a data-toggle="tooltip" data-placement="bottom"
                               title="Cliquer pour ajouter une agence d'octroi de visa"
                               href="<?php echo base_url() . 'admin/add_form/option/add'; ?>" class="text-danger">
                                <i class="fa fa-plus fa-2x" aria-hidden="true"></i>add</a></span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Table  -->
                    <table id="dtMaterialDesignExample" class="table table-hover table-striped" width="100%">
                        <!-- Table head -->
                        <thead class="danger-color-dark text-light lighten-4">
                        <tr class="text-uppercase">
                            <th class="th-sm">ID</th>
                            <th>Nom de l'option</th>
                            <th>Date création</th>
                            <th>EDITION</th>
                        </tr>
                        </thead>
                        <!-- Table head -->

                        <!-- Table body -->
                        <tbody>
                        <?php $line = 1;
                        foreach ($options as $value): ?>
                            <tr>
                                <td><?= $line ?></td>
                                <td class="text-uppercase"><?= $value->nom_option ?></td>
                                <td><?= $value->date_created ?></td>
                                <td>
                                    <a href="<?= base_url() . "admin/update_form/option/" . $value->id_option ?>">
                                        <span class="table-edit" data-toggle="tooltip" data-placement="bottom"
                                              title="Cliquer pour modifier cette option">
                                            <button type="button" class="btn-success btn-rounded btn-sm my-0"><i
                                                        class="fa fa-edit"></i></button></span>
                                    </a>
                                </td>
                            </tr>
                            <?php $line++; endforeach; ?>
                        </tbody>
                        <!-- Table body -->

                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
