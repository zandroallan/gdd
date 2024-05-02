    <h3>Resultados de la busqueda</h3>
<div class="input-group">
                {!! Form::text('search', null, ['id'=>'search', 'placeholder'=>'Buscar documento...',  'class'=>'form-control']) !!}               
                <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <br>            
            <table class="dt_default table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th width="120px">Núm. docto</th>
                        <th>Dependencia/Organismo</th>
                        <th width="50px">Tipo de documento</th>
                        <th>Destinatario</th>
                        <th width="80px" align="center">Fecha del documento</th>
                        <th width="100px" align="center">Fecha de envío</th>
                        <th width="50px" align="center">Capturista</th>
                        <th width="50px" align="center">Acuse</th>
                        <th width="30px" align="center"><i class="fa fa-paperclip"></i></th>                        
                        <th width="30px" align="center"></th>
                    </tr>
                </thead>
                <tbody id='dt_default'>
                </tbody>
            </table>