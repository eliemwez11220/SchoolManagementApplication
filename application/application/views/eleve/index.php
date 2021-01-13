<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="col-md-12">
                            <aside class="profile-nav alt">
                                <section class="card">
                                    <div class="card-header user-header alt danger-color-dark">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="text-light text-uppercase font-weight-bold">
                                                Informations sur l'inscription encours</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($d->matricule_eleve == $this->session->matricule){ ?>
                                    <div class="vue-lists">
                                        <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <ul class="list-group list-group-flush">

                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-check-o"></i> Date d'inscription :
                                                        <span><b><?= $d->date_inscription; ?></b></span>
                                                    </li>

                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Classe demandée :
                                                        <span><b><?= $d->nom_classe; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-building"></i> Section/cycle :
                                                        <span><b><?= $d->cycle; ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <h3>
                                                    <b style="color: red;" class="text-center">Observation</b>
                                                </h3>
                                                <ul class="" style="padding: 10px">

                                                    <div class="mt-2">
                                                      <?php if ($d->etat_inscription =="en attente"){ ?>
                                                        <span><b>Votre demande d'incription effectuée depuis
                                                             <?= $d->date_demande; ?> est encore encours de traitement.
                                                            Si vous avez une préoccupation quelconque, veuillez l'adresser
                                                            à l'administration via l'adresse e-mail suivante :
                                                            info@congoagile.net</b></span>
                                                      <?php } else{?>
                                                          <span><b>Votre demande d'incription effectuée depuis
                                                                  <?= $d->date_demande; ?> est déjà validée. Merci !</b></span>
                                                      <?php }?>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else{?>
                                        <h3 class="text-center">Aucune information en rapport avec une inscription encours.
                                            Merci !</h3>
                                    <?php }?>
                                </section>
                            </aside>
                        </div>
                        <br>
                        <br>

                        <!-- infos sur le paiement non effectué -->
                        <div class="col-md-12">
                            <aside class="profile-nav alt">
                                <section class="card">
                                    <div class="card-header user-header alt danger-color-dark">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="text-light text-uppercase font-weight-bold">
                                                    Informations sur le paiement encours</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($paiements->matricule_eleve == $this->session->matricule){ ?>
                                    <div class="vue-lists">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <ul class="list-group list-group-flush text-capitalize">

                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Mois payé :
                                                        <span><b><?= $paiements->mois; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-building"></i> Date paiement :
                                                        <span><b><?= $paiements->date_paiement; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-building"></i> Montant payé:
                                                        <span><b><?= $paiements->montant_paye.' '.$paiements->devise; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Type frais payé :
                                                        <span><b><?= $paiements->type_frais; ?></b></span>
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="col-sm-4">
                                                <ul class="list-group list-group-flush text-capitalize">
                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Nom expéditeur :
                                                        <span><b><?= $paiements->nom_expediteur; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Numéro expéditeur :
                                                        <span><b><?= $paiements->numero_expediteur; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Numéro expéditeur :
                                                        <span><b><?= $paiements->service_mobile; ?></b></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-check-o"></i> Code réference paiement :
                                                        <span><b><?= $paiements->code_validation; ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4 mb-4">
                                                <h3>
                                                    <b style="color: red;" class="text-center">Observation</b>
                                                </h3>
                                                <ul class="" style="padding: 10px">

                                                    <div class="mt-2">
                                                        <?php if ($paiements->statut_paiement !="validé"){ ?>
                                                            <span><b>Votre paiement effectué depuis
                                                                    <?= $paiements->date_envoi; ?> est encore encours de validation.
                                                            Si vous avez une préoccupation quelconque, veuillez l'adresser
                                                            à l'administration via l'adresse e-mail suivante :
                                                            info@congoagile.net</b></span>
                                                        <?php } else{?>
                                                        <h3 class="text-center">Votre paiement effectué depuis
                                                                <?= $d->date_validation; ?> est déjà validée. Merci !</h3>
                                                        <?php }?>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else{?>
                                    <h3 class="text-center">Aucune information en rapport avec un paiement encours.
                                        Merci !</h3>
                                    <?php }?>
                                </section>
                            </aside>
                        </div>
                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </section><!-- /#right-panel -->
</div><!-- /#right-panel -->
