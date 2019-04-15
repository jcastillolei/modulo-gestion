<!-- Iditem Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idItem', 'Item:') !!}
    {!! Form::select('idItem', $items, null, ['class' => 'form-control']) !!}
</div>

<!-- Idbodega Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idBodega', 'Bodega:') !!}
    {!! Form::select('idBodega', $bodegas, null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('itemBodegas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
