<!-- Item Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_code', 'Item Code:') !!}
    {!! Form::text('item_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_id', 'Stock Id:') !!}
    {!! Form::text('stock_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::number('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Foreign Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_foreign', 'Is Foreign:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_foreign', 0) !!}
        {!! Form::checkbox('is_foreign', '1', null) !!} 1
    </label>
</div>

<!-- Inactive Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inactive', 'Inactive:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('inactive', 0) !!}
        {!! Form::checkbox('inactive', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('itemCodes.index') !!}" class="btn btn-default">Cancel</a>
</div>
