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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <!-- Heading -->
                        <div class="card mb-4 wow fadeIn">
                            <!--Card content-->
                            <div class="card-body d-sm-flex justify-content-between">

                                <h4 class="mb-2 mb-sm-0 pt-1">
                                    <a href="#" target="_blank">Rénitialiser</a>
                                    <span>/</span>
                                    <span>le mot de passe</span>
                                </h4>

                            </div>

                        </div>
                        <!-- Heading -->
                    </div>
                    <div class="box-body">
                        <span style="color:red;"><b><?= $this->session->Admin; ?></b></span>
                        <?php //echo form_open_multipart(base_url(). 'Admin/Add_agent');?>

                        <span style="color:red;"><b><?= $this->session->Agent; ?></b></span>
                        <form class="" action="<?= base_url(). 'admin/reset_agent_password/'.$id_asset; ?>" method="post">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="name" class="control-label"><span class="text-danger">*</span>Nouveau mot de passe</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password"  />
                                        <span class="text-danger"><?php echo form_error('password');?></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="" class="control-label"><span class="text-danger">*</span>Confirmer le mot de passe</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confirm_password" value=""/>
                                        <span class="text-danger"><?php echo form_error('confirm_password');?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="checkbox" class="form-control" name="checkbox" value="" checked="checked"/>
                                    <span class="text-danger"><?php echo form_error('checkbox');?></span>

                                </div>
                                <label for="checkbox" class="control-label"><span class="text-danger"></span>L'utilisateur doit changer son mot de passe</label>

                            </div>
                            <input type="submit" class="btn btn-primary btn-rounded btn-sm my-0" value="Réinitialiser">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<!---->
<!---->
<!--<!-- Content Wrapper. Contains page content -->
<!--    <div class="">-->
<!--        <!-- Main content -->
<!--        <section class="content">-->
<!--          <div class="row">-->
<!--              <div class="col-md-12">-->
<!--                	<div class="box box-info">-->
<!--                    <div class="box-header with-border">-->
<!--                      	<h3 class="box-title">Add admin</h3>-->
<!--                    </div>-->
<!--
<!--                    	<div class="box-body">-->
<!--
<!--                        --><?php //echo form_open_multipart(base_url(). 'Admin/Add_agent');?>
<!--                      		<div class="row clearfix">-->
<!--                  					<div class="col-md-6">-->
<!--                  						<label for="province" class="control-label"><span class="text-danger">*</span>Username</label>-->
<!--                  						<div class="form-group">-->
<!--                  							<input type="text" class="form-control" name="username" value="--><?//= set_value('username'); ?><!--" placeholder="Username" />-->
<!--                  							<span class="text-danger">--><?php //echo form_error('username');?><!--</span>-->
<!--                  						</div>-->
<!--                  					</div>-->
<!--                  					<div class="col-md-6">-->
<!--                  						<label for="ville" class="control-label"><span class="text-danger">*</span>Password</label>-->
<!--                  						<div class="form-group">-->
<!--                  							<input type="text" class="form-control" name="password" value="--><?//= set_value('password'); ?><!--" placeholder="Password" />-->
<!--                  							<span class="text-danger">--><?php //echo form_error('password');?><!--</span>-->
<!--                  						</div>-->
<!--                  					</div>-->
<!--                            <div class="col-md-6">-->
<!--                  						<label for="ville" class="control-label"><span class="text-danger">*</span>Type admin</label>-->
<!--                  						<div class="form-group">-->
<!--                                <select class="form-control" name="type">-->
<!--                                  <option value="agent">Agent</option>-->
<!--                                  <option value="administrator">Administrator</option>-->
<!--                                </select>-->
<!--                  						</div>-->
<!--                  					</div>-->
<!--                  				  </div>-->
<!--                            <input type="submit" class="btn btn-success" value="Save">-->
<!--                        </form>-->
<!--                			</div>-->
<!--                	</div>-->
<!--              </div>-->
<!--          </div>-->
<!--        </section>-->
<!--        <!-- /.content -->
<!--    </div>-->
