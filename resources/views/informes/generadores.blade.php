<div class="row">
    <div class="col-xl-4 col-sm-6">

        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Vehiculos por Servicio</h4>
            </div>
            <div class="box-body">
                   <p>Muestra los vehículos y sus respectivos contadores de servicios (Empresarial, Escolar Salud...) segun la cantidad de viajes, basado a las rutas pre-establecidas y/o eventuales.</p> 
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
               {{-- <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button> --}}
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 


        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Recibos caja menor</h4>
            </div>
            <div class="box-body">
                   <p>Muestra los recibos generados entre las fechas designadas.</p> 
                    {!! Form::hidden('type', 'recibos_caja') !!}
                   <div class="form-group">
                        {!! Form::label('fecha', 'Filtrar por Fecha') !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::text('fecha', null, ['class' => 'form-control daterange_picker', 'placeholder'=>'Click']) !!}
                        </div>
                    </div>                                  
            </div>
            <div class="box-footer">
               {{-- <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button> --}}
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 


        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-warning">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Conductor por Servicio</h4>
            </div>
            <div class="box-body">
                   <p>Muestra la cantidad de servicios relizados por vehículo y conductor asignado</p> 
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
               {{-- <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button> --}}
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 


    </div> {{-- final firts colum --}}



    {{-- SECOND COLUM --}}
    <div class="col-xl-4 col-sm-6">

        {!! Form::open(['route' => 'informes.generate']) !!}                 
        <div class="box box-primary">
            <div class="box-header">
              <h4 class="xs-custom-box-title">Tiempos de recorrido y kilometros</h4>
            </div>
            <div class="box-body">
                   <p>Muestra la duración y algunos datos relevantes del recorrido y/o trayecto.</p> 
                    {!! Form::hidden('type', 'contador_recorrido') !!}
                   <div class="form-group">
                        {!! Form::label('fecha', 'Filtrar por Fecha') !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::text('fecha', null, ['class' => 'form-control daterange_picker', 'placeholder'=>'Click']) !!}
                        </div>
                    </div>                                  
            </div>
            <div class="box-footer">
               {{-- <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button> --}}
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 


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
               {{-- <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-plus-circle"></i> Generar </button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Imprimir</button>
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-download"></i> Descargar</button> --}}
               <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-file-excel-o"></i> Exportar</button>
            </div>
        </div>
        {!! Form::close() !!} 
    </div>
</div>



{{-- 
posible solucion 

<input type="submit" name="grabar" value ="Grabar">

<input type="submit" name="borrar" value ="Borrar">

<input type="submit" name="editar" value ="Editar">

<input type="submit" name="salir" value ="Salir"> --}}