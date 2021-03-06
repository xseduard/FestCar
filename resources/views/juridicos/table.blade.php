<table class="table table-responsive table-hover" id="juridicos-table">
    <thead>
        <th>Nit</th>
        <th>Nombre o Razón Social</th>
        <th>Representante Legal</th>
        <th></th>
        <th>Estado</th>        
        <th>Última modificación</th>
        <th colspan="3">Acciones</th>
    </thead>
    <tbody>
    @foreach($juridicos as $juridico)
        <tr 
            @if ($juridico->natural->nombres == 'No disponible')                    
                class="warning"
            @endif
        >
            <td>{!! $juridico->nit !!}</td>
            <td><a href="{!! route('juridicos.show', [$juridico->id]) !!}" class='' title="Ver">{!! $juridico->nombre !!}</a></td>
            <td>{!! $juridico->natural->nombres," ",$juridico->natural->apellidos !!}</td>
            <td>
                @if ($juridico->natural->nombres == 'No disponible')                   
                        <span class="badge badge-warning" title="Verfiqué los datos ingresados, {!! $juridico->user->fullname !!}"><i class='fa fa fa-exclamation fa-spin fa-fw'></i> Sin Representante Legal</span>
                @endif
            </td>
            <td>
                @if ($juridico->estado)
                    <span class="badge badge-success">Activo</span>
                @else
                    <span class="badge badge-default">Desactivado</span>
                @endif
            </td>
            <td>{!! $juridico->updated_at->diffForHumans() !!}</td>
            <td>
                {!! Form::open(['route' => ['juridicos.destroy', $juridico->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!--
                        <a href="{!! route('juridicos.show', [$juridico->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('juridicos.edit', [$juridico->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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