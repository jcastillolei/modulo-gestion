<!-- Stock Id Field -->
<div class="form-group">
    {!! Form::label('stock_id', 'Stock Codigo:') !!}
    <p>{!! $stockMaster->stock_id !!}</p>
</div>


<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descripcion:') !!}
    <p>{!! $stockMaster->description !!}</p>
</div>

<!-- Inventory Account Field -->
<div class="form-group">
    {!! Form::label('inventory_account', 'Cuenta de Inventario:') !!}
    <p>{!! $stockMaster->inventory_account !!}</p>
</div>

<!-- Adjustment Account Field -->
<div class="form-group">
    {!! Form::label('adjustment_account', 'Cuenta de ajuste:') !!}
    <p>{!! $stockMaster->adjustment_account !!}</p>
</div>



<!-- Material Cost Field -->
<div class="form-group">
    {!! Form::label('material_cost', 'Precio:') !!}
    <p>{!! $stockMaster->material_cost !!}</p>
</div>

