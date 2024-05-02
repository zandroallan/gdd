<?php $__env->startSection('content'); ?>
<?php  //echo Hash::make('gespinosa'); ?>
    <div class="text-center m-b-md">
        <?php echo e(Html::image('img/logo.png', 'Logo',['height' => 100])); ?>


        <!-- i class="pe-7s-user fa-5x text-muted"></i -->
        <h4>INGRESE SUS DATOS PARA ACCESAR</h4>
        <!-- small>Sistema de Gesti&oacute;n Doumental</small -->                    
    </div>
    <div class="hpanel">
        <div class="panel-body">
                <?php echo Form::open(['url' => 'login', 'method' => 'POST', 'id' => 'contact']); ?>

                    <div class="form-group">
                        <label class="control-label" for="username">Usuario:</label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">
                                <i class="pe-7s-user"></i>
                            </span>
                            <?php echo Form::text('nickname', old('nickname'),['id'=>'nickname', 'placeholder'=>'Nombre de Usuario', 'required'=>'true', 'class'=>'form-control']); ?>

                        </div>                       
                        <span class="help-block small">Nombre de usuario unico del sistema</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Contraseña:</label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">
                                <i class="pe-7s-lock"></i>
                            </span>
                            <?php echo Form::password('password', ['id'=>'password', 'placeholder'=>'*******', 'required'=>'true', 'class'=>'form-control']); ?>

                        </div>
                        <span class="help-block small">Contraseña unica del sistema</span>
                    </div>
                    <?php echo Form::button('Iniciar Sesión', ['id'=>'','class' => 'btn btn-primary btn-block', 'type' => 'submit', 'data-uk-tooltip'=>'{pos:bottom}', 'title'=>'Iniciar Sesión']); ?>

                <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>