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
                            <span>Listing des sections</span>
                        </h4>
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
                            <th>Nom section</th>
                            <th>Date creation</th>
                        </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                        <?php $line = 1;
                        foreach ($sections as $v): ?>
                            <tr class="text-uppercase">
                                <td><?= $line ?></td>
                                <td><?= $v->nom_section ?></td>
                                <td><?= $v->date_created ?></td>
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
