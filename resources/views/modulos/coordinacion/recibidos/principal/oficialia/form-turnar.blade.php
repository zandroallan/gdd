

<div class="col-lg-8">
 
    <div class="m-b-md"></div>  

    <div class="form-group">
        <label class="col-sm-3 control-label">Área que atenderá*</label>
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-building"></span></span>                        
                {!! Form::select('id_area_responde', [0=>"Seleccionar destinatario..."]+$areas, null, ['id' => 'id_area_responde', 'style'=>'width: 100%;', 'class' => 'form-control select2-single ']) !!} 
            </div>
            <label id="el-id_area_responde" class="error hidden" for="id_area_responde"></label>
        </div>        
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Fecha de vencimiento*</label>
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>                        
                {!! Form::text('fecha_vencimiento', null, ['id'=>'fecha_vencimiento', 'placeholder'=>'',  'class'=>'form-control datepicker']) !!}                           
            </div>
            <label id="el-fecha_vencimiento" class="error hidden" for="fecha_vencimiento"></label>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Indicaciones</label>
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-align-justify"></span></span>
                {!! Form::textarea('indicaciones', null, ['id'=>'indicaciones', 'placeholder'=>'',  'class'=>'form-control','rows' => 4, 'cols' => 54,]) !!}                           
            </div>
            <label id="el-indicaciones" class="error hidden" for="indicaciones"></label>
        </div>
    </div> 
    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Tip ode atención</label>
        <div class="col-sm-9">
            <div>
                <label> 
                    <input type="checkbox" class="i-checks" value="1" id="es_urgente" name="es_urgente"> Urgente
                </label>
            </div>                   
        </div>
    </div> 
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Enviar copia</label>
        <div class="col-sm-9">
            <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-copy"></span></span>                        
                {!! Form::select('copias[]', $areas, null, ['id' => 'copias', 'style'=>'width: 100%;', 'class' => 'form-control select2-single', 'multiple'=>'multiple']) !!} 
            </div>
            <label id="el-id_area_responde" class="error hidden" for="id_area_responde"></label>
        </div>        
    </div>        
    
</div>