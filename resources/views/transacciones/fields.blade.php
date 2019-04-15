<!-- Tipotransaccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipoTransaccion', 'Tipotransaccion:') !!}
    {!! Form::text('tipoTransaccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Bodega Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Bodega', 'Bodega:') !!}
    {!! Form::text('Bodega', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Item', 'Item:') !!}
    {!! Form::text('Item', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuariosolicitud Field -->
<div class="form-group col-sm-6">
    {!! Form::label('UsuarioSolicitud', 'Usuariosolicitud:') !!}
    {!! Form::text('UsuarioSolicitud', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Responsable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsable', 'Responsable:') !!}
    {!! Form::text('responsable', null, ['class' => 'form-control']) !!}
</div>

<!-- Autorizadopor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('autorizadoPor', 'Autorizadopor:') !!}
    {!! Form::text('autorizadoPor', null, ['class' => 'form-control']) !!}
</div>

<!-- Cargo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cargo', 'Cargo:') !!}
    {!! Form::text('cargo', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::number('estado', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('transacciones.index') !!}" class="btn btn-default">Cancel</a>
</div>
