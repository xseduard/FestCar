<!-- Texto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::text('texto', null, ['class' => 'form-control']) !!}
</div>
<!-- Texto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero', 'Texto:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary btn-flat']) !!}
    <a href="{!! route('triangulos.index') !!}" class="btn btn-default">Cancel</a>
</div>
