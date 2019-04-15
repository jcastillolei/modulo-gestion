<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $itemBodega->id !!}</p>
</div>

<!-- Iditem Field -->
<div class="form-group">
    {!! Form::label('idItem', 'Item:') !!}
    <p>{!! $itemBodega->idItem !!}</p>
</div>

<!-- Idbodega Field -->
<div class="form-group">
    {!! Form::label('idBodega', 'Bodega:') !!}
    <p>{!! $itemBodega->idBodega !!}</p>
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{!! $itemBodega->stock !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Fecha Creacion:') !!}
    <p>{!! $itemBodega->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Fecha Actualizacion:') !!}
    <p>{!! $itemBodega->updated_at !!}</p>
</div>

