<!-- Trans No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trans_no', 'Trans No:') !!}
    {!! Form::number('trans_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_id', 'Stock Id:') !!}
    {!! Form::text('stock_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Loc Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('loc_code', 'Loc Code:') !!}
    {!! Form::text('loc_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Tran Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tran_date', 'Tran Date:') !!}
    {!! Form::date('tran_date', null, ['class' => 'form-control','id'=>'tran_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#tran_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Reference Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reference', 'Reference:') !!}
    {!! Form::text('reference', null, ['class' => 'form-control']) !!}
</div>

<!-- Qty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qty', 'Qty:') !!}
    {!! Form::number('qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Standard Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('standard_cost', 'Standard Cost:') !!}
    {!! Form::number('standard_cost', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stockMoves.index') !!}" class="btn btn-default">Cancel</a>
</div>
