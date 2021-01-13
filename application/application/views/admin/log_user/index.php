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
                            <span>Journal des activités des utilisateurs</span>
                        </h4>
                    </div>
                    <a href="<?= base_url() . "admin/log_archiver"; ?>" class="btn btn-danger btn-sm pull-right">
                        <i class="fa fa-archive"></i> Consulter archives
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Table  -->
                    <table id="dtMaterialDesignExample" class="table table-hover table-striped" width="100%">

                        <!-- Table head -->
                        <thead class="danger-color-dark text-light lighten-4">
                        <tr class="text-uppercase">
                            <th>#</th>
                            <th>Nom Utilisateur</th>
                            <th>Description des actions effectuées - Contenu du journal</th>
                            <th>Date & heure</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <!-- Table head -->

                        <!-- Table body -->
                        <tbody>
                        <?php $line = 1;
                        foreach ($logs as $value):
                        if($value->log_statut=='online'){
                            ?>
                            <tr>
                                <td><?= $line; ?></td>
                                <td class="text-uppercase"><?= $value->log_username; ?></td>
                                <td><?= $value->log_contenu; ?></td>
                                <td><?= $value->log_datetime; ?></td>
                                <td>
                                    <a href="<?= base_url() . "admin/archiver_log?log_id=" . $value->log_id ?>"
                                       onclick="return confirm('Voulez-vous vraiment archiver le journal de <?= $value->log_username ?>?') ">
                                        <span class="table-edit" data-toggle="tooltip" data-placement="bottom"
                                              title="Cliquer pour archiver ce journal">
                                            <button type="button" class="btn-success btn-rounded btn-sm my-0">
                                               Archiver</button></span>
                                    </a>
                                </td>
                            </tr>
                            <?php $line++;
                        }
                            endforeach; ?>

                        </tbody>
                        <!-- Table body -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
