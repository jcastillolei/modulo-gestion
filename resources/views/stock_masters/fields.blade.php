

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripcion:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Stock id -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_id', 'Stock ID:') !!}
    {!! Form::text('stock_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Inventory Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inventory_account', 'Cuenta de Inventario:') !!}
    {!! Form::select('inventory_account', $chartMaster, null, ['class' => 'form-control']) !!}
    
</div>

<!-- Adjustment Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adjustment_account', 'Cuenta de Ajuste:') !!}
    {!! Form::select('adjustment_account', $chartMaster, null, ['class' => 'form-control']) !!}
</div>


<!-- Material Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('material_cost', 'Precio:') !!}
    {!! Form::number('material_cost', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stockMasters.index') !!}" class="btn btn-default">Cancelar</a>
</div>
