<!-- Id Usuariofinal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Id_UsuarioFinal', 'Id Usuariofinal:') !!}
    {!! Form::text('Id_UsuarioFinal', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Bodega Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Codigo_bodega', 'Codigo Bodega:') !!}
    {!! Form::text('Codigo_bodega', null, ['class' => 'form-control']) !!}
</div>

<!-- Codigo Item Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Codigo_item', 'Codigo Item:') !!}
    {!! Form::text('Codigo_item', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Item Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Descripcion_item', 'Descripcion Item:') !!}
    {!! Form::text('Descripcion_item', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Cantidad', 'Cantidad:') !!}
    {!! Form::number('Cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Transaccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_transaccion', 'Tipo Transaccion:') !!}
    {!! Form::text('tipo_transaccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Fecha', 'Fecha:') !!}
    {!! Form::date('Fecha', null, ['class' => 'form-control','id'=>'Fecha']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#Fecha').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('transaccionesUsuariofinals.index') !!}" class="btn btn-default">Cancel</a>
</div>
