<table class="table table-responsive" id="emdiAutorizacions-table">
    <thead>
        <th>Codigo</th>
        <th>Afiliado/Paciente</th>
        <th>Ruta</th>
        <th>Fecha cita</th>
        <th>Lugar</th>
        <th>Conductor</th>
        <th>Registro</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($emdiAutorizacions as $emdiAutorizacion)
        <tr>
            <td title="Registrado por: {!! $emdiAutorizacion->user->fullname !!}"><span class="badge badge-success">37630-{!! str_pad($emdiAutorizacion->id, 4, "0", STR_PAD_LEFT); !!}</span></td>
            <td>{!! $emdiAutorizacion->paciente->fullname !!}</td>
            <td>{!! $emdiAutorizacion->ruta !!}</td>
            <td>{!! $emdiAutorizacion->cita_fecha->format('d-m-Y') !!}</td>
            <td>{!! $emdiAutorizacion->lugar->nombre !!}</td>
            <td>{!! $emdiAutorizacion->conductor->fullname !!}</td>

            <td>{!! $emdiAutorizacion->created_at->format('d-m-Y') !!}</td>
            <td>
                {!! Form::open(['route' => ['emdiAutorizacions.destroy', $emdiAutorizacion->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('emdiAutorizacions.show', [$emdiAutorizacion->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <!--
                    <a href="{!! route('emdiAutorizacions.edit', [$emdiAutorizacion->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    -->
                    
                    <a href="{!! route('emdiAutorizacions.print', [$emdiAutorizacion->id]) !!}" class='btn btn-success-inverted btn-sm btn-flat' title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                    {!! Form::button('Anular <i class="glyphicon glyphicon-trash"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm btn-flat',
                        'onclick' => "return confirm('¿Confirma que desea ANULAR esta autorización?')",
                        'title' => 'Anular'
                        ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>