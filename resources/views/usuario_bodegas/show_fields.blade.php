
<!-- Idusuario Field -->
<div class="form-group">
    {!! Form::label('idUsuario', 'Usuario:') !!}
    <p>{!! $usuarioBodega->idUsuario !!}</p>
</div>

<!-- Idbodega Field -->
<div class="form-group">
    {!! Form::label('idBodega', 'Bodega:') !!}
    <p>{!! $usuarioBodega->idBodega !!}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Fecha Creacion:') !!}
    <p>{!! $usuarioBodega->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Ultima Modificacion:') !!}
    <p>{!! $usuarioBodega->updated_at !!}</p>
</div>

