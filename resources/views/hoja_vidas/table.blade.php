<table class="table table-responsive table-hover" id="hojaVidas-table">
    <thead>
        <th>Natural</th>
        <th>Fecha</th>
        <th>Codigo Cargo</th>
        <th>Profesion</th>
        <th>Anos Exp Laboral</th>
        <th>Lugar Nacimiento</th>
        <th>Fecha Nacimiento</th>
        <th>Estado Civil</th>       
        <th>Grupo Sanguineo</th>
        <th>Ultima modificación</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($hojaVidas as $hojaVida)
        <tr>
            <td>{!! $hojaVida->natural->fullname !!}</td>
            <td>{!! $hojaVida->fecha !!}</td>
            <td>{!! $hojaVida->codigo_cargo !!}</td>
            <td>{!! $hojaVida->i_profesion !!}</td>
            <td>{!! $hojaVida->i_anos_exp_laboral !!}</td>
            <td>{!! $hojaVida->i_lugar_nacimiento !!}</td>
            <td>{!! $hojaVida->i_fecha_nacimiento !!}</td>
            <td>{!! $hojaVida->i_estado_civil !!}</td>            
            <td>{!! $hojaVida->grupo_sanguineo !!}</td>
            <td>{!! $hojaVida->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['hojaVidas.destroy', $hojaVida->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                   
                        <a href="{!! route('hojaVidas.show', [$hojaVida->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    
                    <a href="{!! route('hojaVidas.edit', [$hojaVida->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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