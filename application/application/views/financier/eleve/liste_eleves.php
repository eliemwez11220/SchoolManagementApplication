

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-graduation-cap"></i> Page de liste des élèves inscrits</h1>
            <p>Application web de gestion centralisée des activités scolaires Masomo_meneja</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-graduation-cap fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Page de liste des élèves inscrits</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="container-fluid">
            <?php include_once ("application/views/auth/alert.php"); ?>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <div class="card border-primary">

                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="display-5">Liste des élèves inscrits</h3>
                        </div>
                        <div class="col-sm-4">
                            <form class="form-inline pull-right" method="post" action="<?= site_url($role_utilisateur.'/list_el'); ?>">

                                <div class="form-horizontal form-group-sm">

                                    <?php $array_periodes  = []; foreach ($data['periodes'] as $periode) :

                                        $array_periodes[$periode->annee_scolaire] = $periode->annee_scolaire;

                                    endforeach; ?>
                                    Année scolaire :
                                    <?=
                                    form_dropdown('annee_scolaire', $array_periodes, $data['select'],
                                        [
                                            'class' => 'form-control',
                                            'id' => 'annee_scolaire',
                                            'required'
                                        ]
                                    );
                                    ?>
                                </div>

                                <div class="form-horizontal">
                                    <div class="form-group-sm">
                                        <input type="submit" class="btn bleu text-white" name="submit" value="Afficher">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Matricule</th>
                                <th>Noms</th>
                                <th>Classe</th>
                                <th width="5%">Paiements</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Matricule</th>
                                <th>Noms</th>
                                <th>Classe</th>
                                <th width="5%">Paiements</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $count = 1; foreach ($data['eleves'] as $eleve): ?>
                                <tr class="">
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-uppercase"><?= $eleve->matricule_eleve; ?></td>
                                    <td class="text-uppercase"><?= $eleve->nom_complet; ?></td>
                                    <td class="text-uppercase"><?= $eleve->nom_classe . " " .$eleve->nom_option; ?></td>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-block btn-outline-primary"
                                           href="<?= site_url( 'caissier/paiements_el?mat_el=' . $eleve->matricule_eleve). '&ann_sco='.$eleve->annee_scolaire; ?>">Paiements</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>

</main>
