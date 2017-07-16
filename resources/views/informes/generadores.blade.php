<div class="row">
    <div class="col-xl-4 col-sm-6">
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Vehículos por Servicio</h4>
            </div>
            <div class="box-body">               
               <p>Este informe muestra los vehiculos y sus respectivos contadores de servicios (Empresarial, Escolar Salud...) segun la cantidad de viajes en base a las rutas pre-establecidas y/o eventuales.</p> 
               <div class="form-group">
                    {!! Form::label('fecha', 'Filtrar por Fecha') !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::text('fecha', null, ['class' => 'form-control daterange_picker', 'placeholder'=>'Click']) !!}
                    </div>
                </div>                   
            </div>
            <div class="box-footer">
               <a href="" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar</a>
               <a href="" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</a>
               <a href="" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</a>
               <a href="" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</a>
            </div>
        </div>
    </div>
</div>