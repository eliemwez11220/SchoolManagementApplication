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
                                                    Dernières actualités - communiqué</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if($infos !=""){
                                    foreach ($infos as $info) {} ?>
                                    <div class="vue-lists">
                                        <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-check-o"></i> Titre communqué :
                                                        <span><b><?= $info->title_actualite; ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <ul class="list-group list-group-flush">

                                                    <li class="list-group-item">
                                                        <i class="fa fa-calendar-minus-o"></i> Date publication :
                                                        <span><b><?= $info->date_created; ?></b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-10 offset-1">
                                                <h1 class="text-center">
                                                    <b style="color: red;" >Observation</b>
                                                </h1>
                                                <hr>
                                                <div class="mt-2">
                                                    <h2><b><?= $info->contenu; ?></b></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </section>
                            </aside>
                        </div>

                    </div><!-- .row -->
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </section><!-- /#right-panel -->
</div><!-- /#right-panel -->
