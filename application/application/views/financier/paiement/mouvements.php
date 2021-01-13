

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-exchange"></i> Page de gestion des mouvements de caisse</h1>
            <p>Gestion des opérations comptables et financières sur l'apurement de paiement des frais académiques ISS/Lubumbashi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-exchange fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Page de gestion des mouvements de caisse</a></li>
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
                    <h3 class="display-5 text-center">Rapport des mouvements de caisse <span class="text-info">année académique <?= $data['annee_academ'] ?></span></h3>
                </div>

                <div class="card-body">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Date mouvement</th>
                                <th>Motif du mouvement</th>
                                <th>Montant soutiré</th>
                                <th>Taux de change</th>
                                <th>N° compte</th>
                                <th>Sous compte</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="bg-secondary">
                                <th class="text-center">#</th>
                                <th>Date mouvement</th>
                                <th>Motif du mouvement</th>
                                <th>Montant soutiré</th>
                                <th>Taux de change</th>
                                <th>N° compte</th>
                                <th>Sous compte</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $count = 1; foreach ($data['mouv'] as $mouv): ?>
                                <tr class="">
                                    <td class="text-center"><?= $count++; ?></td>
                                    <td class="text-capitalize">Le <?= date('d-m-Y', strtotime($mouv->date_mouv))?></td>
                                    <td class="text-lowercase"><?= $mouv->motif ; ?></td>
                                    <td class="text-uppercase"><?= $mouv->montant_soutire. " CDF"; ?></td>
                                    <td class="text-lowercase"><?= $mouv->taux ; ?></td>
                                    <td class="text-lowercase"><?= $mouv->num_compte; ?></td>
                                    <td class="text-lowercase"><?= $mouv->sous_compte; ?></td>
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