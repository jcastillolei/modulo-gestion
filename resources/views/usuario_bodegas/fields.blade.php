
<!-- Idusuario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idUsuario', 'Usuario:') !!}
    {!! Form::select('idUsuario', $usuarios, null, ['class' => 'form-control']) !!}
</div>

<!-- Idbodega Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idBodega', 'Bodega:') !!}
    {!! Form::select('idBodega', $bodegas, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('usuarioBodegas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
