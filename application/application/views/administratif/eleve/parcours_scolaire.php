<?php
if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) { ?>
<div class="container" style="margin-top: 10px;margin-bottom: 10px;">
    <div class="row">
        <h6 class="text-dark">
            <?php include_once "application/views/alertes/alert-index.php"; ?>
        </h6>
    </div>
</div>
<?php } ?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->eleve; ?></b></span>
                        <div class="col-md-14">
                            <aside class="profile-nav alt">
                                <section class="card">
                                    <div class="card-header user-header alt danger-color-dark">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="text-light text-uppercase font-weight-bold">
                                                   Vos coordonnées d'identification
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="vue-lists text-uppercase">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <i class="fa fa-user"></i> Nom complet :
                                                        <span><b><?= $eleve['nom_complet'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-tasks"></i> Numéro matricule :
                                                        <span><b><?= $eleve['matricule_eleve'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-venus-double"></i> Genre :
                                                        <span><b><?= $eleve['genre'] ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-envelope-square"></i> Email Address:
                                                        <span><b class="text-lowercase"><?= $eleve['email'] ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </aside>
                        </div>

                        <br><br>

                    </div><!-- .row -->
                    <!-- tables -->
                    <?php if (isset($inscriptions)) { ?>

                        <!--Card-->
                        <div class="card">
                            <div class="card-header user-header alt danger-color-dark">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="text-light text-uppercase font-weight-bold">
                                            Mon parcours scolaire
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!--Card content-->
                            <div class="card-body">
                                <!-- tableau des echeances de passports -->
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-hover"
                                           id="dtMaterialDesignExample">
                                        <thead class="danger-color-dark text-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Année scolaire</th>
                                            <th>Classe</th>
                                            <th>Option suivie</th>
                                            <th>Section</th>
                                            <th>Cycle d'étude</th>
                                            <th>Pourcentage</th>
                                            <th>Place occupée</th>
                                            <th>Nombre echecs</th>
                                            <th>Mention</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($inscriptions != "") {
                                            $count = 1;
                                            //boucle de donnees
                                            foreach ($inscriptions as $carte) { ?>
                                                <tr>
                                                    <td class="text-center"><?= $count++; ?></td>
                                                    <td class="text-capitalize"><?= $carte->annee_scolaire; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nom_classe; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nom_option; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nom_section; ?></td>
                                                    <td class="text-capitalize"><?= $carte->cycle; ?></td>
                                                    <td class="text-capitalize"><?= $carte->pourcentage; ?></td>
                                                    <td class="text-capitalize"><?= $carte->place; ?></td>
                                                    <td class="text-capitalize"><?= $carte->nombre_echec; ?></td>
                                                    <td class="text-capitalize"><?= $carte->mention; ?></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.Card-->
                    <?php } ?>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </section><!-- /#right-panel -->
</div><!-- /#right-panel -->
