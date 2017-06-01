<table class="table table-responsive" id="licenciaConduccions-table">
    <thead>
        <th>Cédula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha Expedicion</th>
        
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($licenciaConduccions as $licenciaConduccion)
        <tr>
            <td>{!! $licenciaConduccion->natural->cedula !!}</td>
            <td>{!! $licenciaConduccion->natural->nombres !!}</td>
            <td>{!! $licenciaConduccion->natural->apellidos !!}</td>
            <td>{!! $licenciaConduccion->fecha_expedicion !!}</td>
           
            <td>
                {!! Form::open(['route' => ['licenciaConduccions.destroy', $licenciaConduccion->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('licenciaConduccions.show', [$licenciaConduccion->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('licenciaConduccions.edit', [$licenciaConduccion->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                        'title' => 'Eliminar'
                        ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>