<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Type No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_no', 'Type No:') !!}
    {!! Form::number('type_no', null, ['class' => 'form-control']) !!}
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

<!-- Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account', 'Account:') !!}
    {!! Form::text('account', null, ['class' => 'form-control']) !!}
</div>

<!-- Memo  Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('memo_', 'Memo :') !!}
    {!! Form::textarea('memo_', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Dimension Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dimension_id', 'Dimension Id:') !!}
    {!! Form::number('dimension_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Dimension2 Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dimension2_id', 'Dimension2 Id:') !!}
    {!! Form::number('dimension2_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Person Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('person_type_id', 'Person Type Id:') !!}
    {!! Form::number('person_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Person Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('person_id', 'Person Id:') !!}
    {!! Form::text('person_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('glTrans.index') !!}" class="btn btn-default">Cancel</a>
</div>
