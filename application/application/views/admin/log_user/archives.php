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
                            <span>Archives des activités des utilisateurs</span>
                        </h4>
                    </div>

                    <span class="table-add float-right mb-3 mr-2">
                            <a data-toggle="tooltip" data-placement="bottom"
                               title="Cliquer pour ajouter un ratio des expatriés et effectif agents"
                               href="<?php echo base_url() . 'admin/log'; ?>" class="text-danger">
                                <i class="fas fa-arrow-left fa-2x" aria-hidden="true"></i></a></span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Table  -->
                    <table id="dtMaterialDesignExample" class="table table-hover table-striped" width="100%">

                        <!-- Table head -->
                        <thead class="blue-grey lighten-4">
                        <tr class="text-uppercase">
                            <th>#</th>
                            <th>Nom Utilisateur</th>
                            <th>Description des actions effectuées - Contenu du journal</th>
                            <th>Date & heure</th>
                        </tr>
                        </thead>
                        <!-- Table head -->

                        <!-- Table body -->
                        <tbody>
                        <?php $line = 1;
                        foreach ($logs as $value):
                        if($value->log_statut=='offline'){
                            ?>
                            <tr>
                                <td><?= $line; ?></td>
                                <td class="text-uppercase"><?= $value->log_username; ?></td>
                                <td><?= $value->log_contenu; ?></td>
                                <td><?= $value->log_datetime; ?></td>
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
