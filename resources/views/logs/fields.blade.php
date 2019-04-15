<!-- Usuariolog Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuarioLog', 'Usuariolog:') !!}
    {!! Form::text('usuarioLog', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('logs.index') !!}" class="btn btn-default">Cancelar</a>
</div>
