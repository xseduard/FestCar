<table class="table table-responsive" id="pagos-table">
    <thead>
        <th class="">Pago No.</th>
        <th class="">Cps</th>
        <th class="">Vehículo</th>
        <th class="">Responsable</th>
        <th class="">Fecha Planilla</th>
        <th class="text-center">Semana(s)</th>  
        <!--      
        <th class="text-center">Desc. Finca</th>
        <th class="text-center">Desc. Admin</th>
        <th class="text-center">Desc. Transacción</th>
        -->
        <th class="text-right">SubTotal</th>
        <th class="text-right">Total</th>
        <th class="text-center">Fecha Registro</th>
        <th colspan="3" class="text-right">Acciones</th>
    </thead>
    <tbody>
    @foreach($pagos as $pago)
        <tr>
            <td>{!! str_pad($pago->id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td>{!! "CPS",str_pad($pago->cps_id, 4, "0", STR_PAD_LEFT) !!}</td>
            <td title="{!! $pago->contratovinculacion->tipo_contrato,str_pad($pago->contrato_vinculacion_id, 4, "0", STR_PAD_LEFT) !!}">
                <span class="label label-default">{!! $pago->contratovinculacion->vehiculo->placa !!}</span>
            </td>
            <td>
                @if($pago->contratovinculacion->ExistResponsable)
                    {!! $pago->contratovinculacion->responsable->fullname !!}
                @else
                    @if($pago->contratovinculacion->tipo_proveedor=='Natural')
                        {!! $pago->contratovinculacion->natural->fullname !!}
                    @else
                        @if($pago->contratovinculacion->tipo_proveedor=='Juridico')
                        {!! $pago->contratovinculacion->juridico->nombre !!}
                        @endif
                    @endif
                @endif
            </td>
            <td>{!! $pago->fecha_planilla->format('d-m-Y') !!}</td>
            <td class="text-center" title="{!! $pago->fecha_inicio->format('d-m-Y'),"-",$pago->fecha_final->format('d-m-Y') !!}">
                @if($pago->fecha_inicio->weekOfYear == $pago->fecha_final->weekOfYear)
                    {!! $pago->fecha_inicio->weekOfYear !!}
                @else
                    {!! $pago->fecha_inicio->weekOfYear,"-",$pago->fecha_final->weekOfYear !!}
                @endif
                
            </td>       
            <!--     
            <td class="text-right">{!! $pago->desc_finca !!}%</td>
            <td class="text-right">{!! $pago->desc_admin !!}%</td>
            <td class="text-right">$ {!! $pago->desc_transaccion !!}</td>
            -->
            <td class="text-right">$ {!! number_format($pago->subtotal, 2, '.', ',' ) !!}</td>
            <td class="text-right">$ {!! number_format($pago->total, 2, '.', ',' ) !!}</td>
            <td class="text-center">{!! $pago->created_at->format('d-m-Y') !!}</td>
            <td>
                {!! Form::open(['route' => ['pagos.destroy', $pago->id], 'method' => 'delete']) !!}
                <div class='btn-group pull-right'>
                    <!-- 
                        <a href="{!! route('pagos.show', [$pago->id]) !!}" class='btn btn-default btn-xs' title="Ver"><i class="glyphicon glyphicon-eye-open"></i></a>
                    -->
                    <a href="{!! route('pagos.print', [$pago->id]) !!}" class='btn btn-default btn-xs' title="Imprimir" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                    <a href="{!! route('pagos.edit', [$pago->id]) !!}" class='btn btn-default btn-xs' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
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