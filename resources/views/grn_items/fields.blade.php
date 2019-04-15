<!-- Grn Batch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grn_batch_id', 'Grn Batch Id:') !!}
    {!! Form::number('grn_batch_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Po Detail Item Field -->
<div class="form-group col-sm-6">
    {!! Form::label('po_detail_item', 'Po Detail Item:') !!}
    {!! Form::number('po_detail_item', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_code', 'Item Code:') !!}
    {!! Form::text('item_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Qty Recd Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qty_recd', 'Qty Recd:') !!}
    {!! Form::number('qty_recd', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Inv Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity_inv', 'Quantity Inv:') !!}
    {!! Form::number('quantity_inv', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('grnItems.index') !!}" class="btn btn-default">Cancel</a>
</div>
