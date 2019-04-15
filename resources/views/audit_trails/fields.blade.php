<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Trans No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trans_no', 'Trans No:') !!}
    {!! Form::number('trans_no', null, ['class' => 'form-control']) !!}
</div>

<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', 'User:') !!}
    {!! Form::number('user', null, ['class' => 'form-control']) !!}
</div>

<!-- Stamp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stamp', 'Stamp:') !!}
    {!! Form::date('stamp', null, ['class' => 'form-control','id'=>'stamp']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#stamp').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Fiscal Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiscal_year', 'Fiscal Year:') !!}
    {!! Form::number('fiscal_year', null, ['class' => 'form-control']) !!}
</div>

<!-- Gl Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gl_date', 'Gl Date:') !!}
    {!! Form::date('gl_date', null, ['class' => 'form-control','id'=>'gl_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#gl_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Gl Seq Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gl_seq', 'Gl Seq:') !!}
    {!! Form::number('gl_seq', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('auditTrails.index') !!}" class="btn btn-default">Cancel</a>
</div>
