<table class="table table-responsive table-hover" id="recibos-table">
    <thead>
        <th>No.</th>
        <th>Cliente</th>
        <th>Metodo de Pago</th>
        <th>Descuento</th>
        <th>Incremento</th>
        <th>Total</th>
        <th>Observaciones</th>
        <th width="110px">Fecha</th>
        <th></th>
        <th width="70px">Acciones</th>
    </thead>
    <tbody>
    @foreach($recibos as $recibo)
        <tr>
            <td>{!! 'RC'.str_pad($recibo->id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td>{!! $recibo->natural->fullname !!}</td>
            <td>{!! $recibo->modo_pago !!}</td>
            <td>$ {!! $recibo->descuento !!}</td>
            <td>$ {!! $recibo->incremento !!}</td>
            <td>
                @php ($total_view = 0) 
                 @foreach($recibo->articulos as $articulo)
                        @php ($total_view = $total_view+$articulo->precio_final)                         
                 @endforeach
                 $ {!! $total_view !!}
             </td>
            <td>{!! $recibo->observaciones !!}</td>
            <td>{!! $recibo->created_at->format('d-m-Y') !!}</td>
            <td>{!! $recibo->created_at->diffForHumans() !!}</td>
            <td>
                {!! Form::open(['route' => ['recibos.destroy', $recibo->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('recibos.show', [$recibo->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                  
                    <a href="{!! route('recibos.edit', [$recibo->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                    -->
                    <a href="{!! route('recibos.print', [$recibo->id]) !!}" class='btn btn-default btn-xs' title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

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