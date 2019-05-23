<!-- Codbodega Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codBodega', 'Codbodega:') !!}
    {!! Form::text('codBodega', null, ['class' => 'form-control']) !!}
</div>

<!-- Idusuarionormall Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idUsuarioNormall', 'Idusuarionormall:') !!}
    {!! Form::number('idUsuarioNormall', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bodegaUsuarionormals.index') !!}" class="btn btn-default">Cancel</a>
</div>
