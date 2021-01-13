<?php if ((isset($_SESSION['success'])) OR (isset($_SESSION['error']))) {

    if (!empty($_SESSION['success']) OR !empty($_SESSION['error'])) {

        $msg = (isset($_SESSION['success'])) ? $_SESSION['success'] : $_SESSION['error'];

        $cls = (isset($_SESSION['success'])) ? 'alert-success' : 'alert-danger';

        ?>

        <div class="row" id="alt" style="display: none;z-index: 9999;">

            <div class="col-md-12">
                <div class="alert alert-dismissible <?= $cls; ?>" style="box-shadow: -3px 3px #747474; color: #010602">
                    <button id="jlk" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <?= $msg; ?>
                </div>
            </div>
        </div>

        <?php
    }
}
unset($_SESSION['success']);
unset($_SESSION['error']);
?>