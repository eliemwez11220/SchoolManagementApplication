<?php if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) {

    if (!empty($_SESSION['success']) OR !empty($_SESSION['error'])) {

        $msg = (isset($_SESSION['success'])) ? $_SESSION['success'] : $_SESSION['error'];

        $cls = (isset($_SESSION['success'])) ? 'alert-success' : 'alert-danger';

        ?>

        <div class="row" id="alt" style="display: none">

            <div class="col-sm-12">
                <div class="alert alert-dismissible <?= $cls; ?>">
                    <button id="bld" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <strong><?= $msg; ?></strong>
                </div>
            </div>
        </div>

        <?php
    }
}
unset($_SESSION['success']);
unset($_SESSION['error']);

?>