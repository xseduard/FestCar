<div class="row">
    @foreach($pqrsWebs as $pqrsWeb)
        <div class="col-sm-12 col-lg-6 col-xxl-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">No. Radicado <a href="" custom-title="Ver seguimiento"><b class="text-aqua">{!! $pqrsWeb->easy_token !!}</b></a></h3>
                    <span class="pull-right" custom-title="{!! $pqrsWeb->created_at !!}">{!! $pqrsWeb->created_at->diffForHumans() !!}</span>
                </div>                
                <div class="box-body">
                    <div class="col-sm-6">
                        <b>Motivo</b>
                        <p>{!! $pqrsWeb->type_motivo !!}</p>
                        <b>Documento</b>
                        <p>{!! $pqrsWeb->tipo_documento," ",$pqrsWeb->cedula !!}</p>
                        <b>Ciudad</b>
                        <p>{!! $pqrsWeb->ciudad !!}</p>
                        <b>Celular</b>
                        <p>{!! $pqrsWeb->celular !!}</p>
                    </div>   
                    <div class="col-sm-6">
                        <b>Servicio</b>
                        <p>{!! $pqrsWeb->type_servicio !!}</p>
                        <b>Nombres y Apellidos</b>
                        <p>{!! $pqrsWeb->fullname !!}</p>
                        <b>Correo</b>
                        <p>{!! $pqrsWeb->correo !!}</p>
                        <b>Estado</b>
                        @if($pqrsWeb->motivo != 'F')
                            @if($pqrsWeb->seguimiento->isEmpty())
                                <p class="text-warning"><i class="fa fa-bell-o"></i> {!! $pqrsWeb->estado !!}</p>
                            @else
                                <p class="text-green"><i class="fa fa-check"></i> Revisada</p>
                            @endif
                        @else
                            <p class="text-green"><i class="fa fa-check"></i> No requiere respuesta</p>
                        @endif
                        
                    </div>
                    <div class="col-sm-12">
                        <p>{!! $pqrsWeb->observacion !!}</p>
                    </div>

                </div>
                <div class="box-footer">                           
                    {!! Form::open(['route' => ['pqrsWebs.destroy', $pqrsWeb->id], 'method' => 'delete']) !!}
                        <a href="{!! route('pqrsSeguimientos.create_with', [$pqrsWeb->id]) !!}" class='btn btn-default btn-flat' title="Ver"><i class="fa  fa-share" aria-hidden="true"></i> Responder</a>

                        {{-- <a href="{!! route('pqrsWebs.show', [$pqrsWeb->id]) !!}" class='btn btn-default btn-flat' title="Ver"><i class="fa fa-map-signs" aria-hidden="true"></i> Seguimiento</a> --}}

                        <a href="#" class='btn btn-default btn-flat' disabled title="Ver"><i class="fa fa-map-signs" aria-hidden="true"></i> Seguimiento</a>

                        <a href="{!! route('pqrsWebs.edit', [$pqrsWeb->id]) !!}" class='btn btn-default btn-flat' title="Editar"><i class="glyphicon glyphicon-edit"></i> Editar</a>

                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Eliminar', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-flat',
                            'onclick' => "return confirm('¿Confirma que desea eliminar?')",
                            'title' => 'Eliminar'
                            ]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach
</div>