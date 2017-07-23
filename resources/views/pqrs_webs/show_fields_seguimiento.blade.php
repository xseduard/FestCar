@foreach($pqrsWeb->seguimiento as $value)
 <div class="box box-success">
    <div class="box-body">
        <div class="row" style="padding-left: 20px">
               <!-- Asunto Field -->
            <div class="form-group">
                {!! Form::label('asunto', 'Asunto:') !!}
                <p>{!! $value->asunto," (", $value->tipo,")" !!}</p>
            </div>

            <!-- Mensaje Field -->
            <div class="form-group">
                {!! Form::label('mensaje', 'Mensaje:') !!}
                <p>{!! $value->mensaje !!}</p>
            </div>


            <!-- User Id Field -->
            <div class="form-group">
                {!! Form::label('user_id', 'Att:') !!}
                <p>{!! $value->user->fullname !!}</p>
            </div>

            <!-- Created At Field -->
            <div class="form-group">
                {!! Form::label('created_at', 'Fecha') !!}
                <p>{!! $value->created_at->diffForHumans() !!}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
