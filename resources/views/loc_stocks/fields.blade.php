<!-- Stock Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_id', 'Stock Id:') !!}
    {!! Form::text('stock_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Reorder Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reorder_level', 'Reorder Level:') !!}
    {!! Form::number('reorder_level', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('locStocks.index') !!}" class="btn btn-default">Cancel</a>
</div>
