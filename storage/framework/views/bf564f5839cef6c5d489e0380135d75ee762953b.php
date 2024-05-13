
    <?php $__env->startSection('scripts'); ?>

        $(".select2-single").select2();       
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

    <?php $__env->stopSection(); ?>



    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 row gy-2">

            <div class="col-md-12" id="vfecha_documento">
                <label class="form-label" for="fecha_documento">Fecha Documento *</label>
                <?php echo Form::text('fecha_documento', null, ['id' => 'fecha_documento', 'placeholder'=>'dd/mm/yyyy', 'class' =>  'form-control datepicker']); ?>

            </div>

            <div class="col-md-12" id="vid_tipo_documento">
                <label class="form-label" for="id_tipo_documento">Tipo de documento *</label>
                <?php echo Form::select('id_tipo_documento', $id_tipos_documentos, null, ['id' => 'id_tipo_documento', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']); ?>

            </div>

            <div class="col-md-12" id="vid_dependencia">
                <label class="form-label" for="id_dependencia">Organismo/Dependencia *</label>
                <?php echo Form::select('id_dependencia', $id_dependencia, null, ['id' => 'id_dependencia', 'style'=>'width: 100%;', 'class' =>  'form-control select2-single']); ?>

            </div>

            <div class="col-md-12" id="vfolio">
                <label class="form-label" for="folio">Número de folio *</label>
                <?php echo Form::text('folio', null, ['id' => 'folio', 'placeholder'=>'Numero de folio del documento', 'class' =>  'form-control']); ?>

            </div>

            <div class="col-md-12" id="vdestinatario">
                <label class="form-label" for="destinatario">Destinatario *</label>
                <?php echo Form::text('destinatario', null, ['id' => 'destinatario', 'placeholder'=>'Destinatario documento', 'class' =>  'form-control']); ?>

            </div>

            <div class="col-md-12" id="vcargo_destinatario">
                <label class="form-label" for="cargo_destinatario">Cargo Destinatario *</label>
                <?php echo Form::text('cargo_destinatario', null, ['id' => 'cargo_destinatario', 'placeholder'=>'Cargo del destinatario', 'class' =>  'form-control']); ?>

            </div>

            <div class="col-md-12" id="vasunto">
                <label class="form-label" for="asunto">Asunto *</label>
                <?php echo Form::text('asunto', null, ['id' => 'asunto', 'placeholder'=>'Asunto del documento', 'class' =>  'form-control']); ?>

            </div>

        </div>
        <div class="col-lg-1"></div>
    </div>