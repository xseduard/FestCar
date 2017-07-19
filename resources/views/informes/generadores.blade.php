<div class="row">
    <div class="col-xl-4 col-sm-6">
        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Vehículos por Servicio</h4>
            </div>
            <div class="box-body">
                   <p>Este informe muestra los vehiculos y sus respectivos contadores de servicios (Empresarial, Escolar Salud...) segun la cantidad de viajes en base a las rutas pre-establecidas y/o eventuales.</p> 
                    {!! Form::hidden('type', 'vehiculos_servicios') !!}
                   <div class="form-group">
                        {!! Form::label('fecha', 'Filtrar por Fecha') !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::text('fecha', null, ['class' => 'form-control daterange_picker', 'placeholder'=>'Click']) !!}
                        </div>
                    </div>                                  
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 
    </div>
    <div class="col-xl-4 col-sm-6">
        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Conductor por Servicio</h4>
            </div>
            <div class="box-body">
                   <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor  desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.</p> 
                    {!! Form::hidden('type', 'vehiculos_servicios') !!}
                   <div class="form-group">
                        {!! Form::label('fecha', 'Filtrar por Fecha') !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::text('fecha', null, ['class' => 'form-control daterange_picker', 'placeholder'=>'Click']) !!}
                        </div>
                    </div>                                  
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 
    </div>
    <div class="col-xl-4 col-sm-6">
        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Tiempos de recorrido y kilometros</h4>
            </div>
            <div class="box-body">
                   <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor  desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.</p> 
                    {!! Form::hidden('type', 'vehiculos_servicios') !!}
                   <div class="form-group">
                        {!! Form::label('fecha', 'Filtrar por Fecha') !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::text('fecha', null, ['class' => 'form-control daterange_picker', 'placeholder'=>'Click']) !!}
                        </div>
                    </div>                                  
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 
    </div>
    <div class="col-xl-4 col-sm-6">
        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Rutas y Vehículos</h4>
            </div>
            <div class="box-body">
            <p>
              Contenido
            </p>
                   <p>
                     <ol>
                       <li>Rutas predefinidas y/o eventuales</li>
                       <li>Todos los vehiculos y sus contratos de vinculación</li>
                       <li>Relación de Rutas y vehículos en base a las planillas de pago existentes</li>
                     </ol>  
                   </p> 
                    {!! Form::hidden('type', 'rutas') !!}                   
                    {!! Form::label('tipo_ruta', 'Tipo de ruta') !!}
                    {!! Form::select('tipo_ruta', ['Todas', 'Principales', 'Eventuales'], 1, ['class' => 'form-control select2_without_search', 'style' => 'width: 100%', 'placeholder'=>'Seleccione...*']) !!}
                    
                                                   
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 
    </div>
</div>