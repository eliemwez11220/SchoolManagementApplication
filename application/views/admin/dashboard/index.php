
<!--Grid row

<div class="row" style="font-size: 20px;">

    <div class="col-md-4 mb-4">
       
        <div class="card mb-4">
            <div class="card-body">
               
                <div class="list-group list-group-flush">
                    <h4>Demandes d'inscriptions</h4>
                    <a href="<?= base_url() . 'agent/view_ratio?effectif=expatries'; ?>"
                       class="list-group-item list-group-item-action waves-effect text-capitalize">Encours
                        <span class="badge badge-danger badge-pill pull-right">
                               <?php
                              
                               $total_traitees = 0;
                               $count_traitees = 0;
                               foreach ($demandes as $visa_traitee) {

                                   if (($visa_traitee->date_envoi_visa == '' | $visa_traitee->date_envoi_visa == '0000-00-00') &&
                                       !empty($visa_traitee->date_retrait_visa)) {
                                       $count_traitees++;
                                       $total_traitees = $count_traitees;
                                   }
                               }
                               echo $total_traitees;
                               
                               ?>
                        </span>
                    </a><a href="<?= base_url() . 'agent/view_ratio?effectif=agents'; ?>"
                           class="list-group-item list-group-item-action waves-effect text-capitalize">Traitées
                        <span class="badge badge-danger badge-pill pull-right">
                               <?php
                               
                               $total_traitees = 0;
                               $count_traitees = 0;
                               foreach ($demandes as $visa_traitee) {

                                   if (($visa_traitee->date_envoi_visa == '' | $visa_traitee->date_envoi_visa == '0000-00-00') &&
                                       !empty($visa_traitee->date_retrait_visa)) {
                                       $count_traitees++;
                                       $total_traitees = $count_traitees;
                                   }
                               }
                               echo $total_traitees;
                               ?>
                        </span>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-md-4 mb-4">
       
        <div class="card mb-4">
            <div class="card-body">
                
                <div class="list-group list-group-flush">
                    <h4>Enseignement</h4>
                    <a href="<?= base_url() . 'agent/view_ratio?effectif=expatries'; ?>"
                       class="list-group-item list-group-item-action waves-effect text-capitalize">Elèves
                        <span class="badge badge-success badge-pill pull-right">
                            750
                        </span>
                    </a><a href="<?= base_url() . 'agent/view_ratio?effectif=agents'; ?>"
                           class="list-group-item list-group-item-action waves-effect text-capitalize">Enseignants
                        <span class="badge badge-success badge-pill pull-right">
                            250
                        </span>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-md-4 mb-4">
       
        <div class="card mb-4">
            <div class="card-body">
                
                <div class="list-group list-group-flush">
                    <h4>Paiements</h4>
                    <a href="<?= base_url() . 'agent/view_ratio?effectif=expatries'; ?>"
                       class="list-group-item list-group-item-action waves-effect text-capitalize">En ligne
                        <span class="badge badge-info badge-pill pull-right">
                            10
                        </span>
                    </a><a href="<?= base_url() . 'agent/view_ratio?effectif=agents'; ?>"
                           class="list-group-item list-group-item-action waves-effect text-capitalize">Local(offline)
                        <span class="badge badge-info badge-pill pull-right">
                            5
                        </span>
                    </a>
                </div>
            </div>
           
        </div>
    </div>
</div>


-->
<div class="row wow fadeIn">

    <!--Grid column-->
    <div class="col-md-12 mb-4">

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h5 class="mb-2 mb-sm-0 pt-1 text-center text-uppercase">
                    <a href="#">Rapport annuel de traitement de demandes des inscriptions</a>
                </h5>

            </div>

        </div>
        <!-- Heading -->

        <!--Card-->
        <div class="card">

            <!--Card content-->
            <div class="card-body">

                <canvas id="myChart"></canvas>

            </div>
        </div>
        <!--/.Card-->


        <!--Card-->
        <div class="card">
            <!-- Card header -->
            <div class="card-header">Traitement de demandes d'inscriptions</div>

            <!--Card content-->
            <div class="card-body">

                <canvas id="lineChart"></canvas>

            </div>

        </div>
        <!--/.Card-->

    </div>
    <!--Grid column-->
</div>
<!--Grid row-->
