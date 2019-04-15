<!-- Pos Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pos_name', 'Pos Name:') !!}
    {!! Form::text('pos_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Cash Sale Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cash_sale', 'Cash Sale:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('cash_sale', 0) !!}
        {!! Form::checkbox('cash_sale', '1', null) !!} 1
    </label>
</div>

<!-- Credit Sale Field -->
<div class="form-group col-sm-6">
    {!! Form::label('credit_sale', 'Credit Sale:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('credit_sale', 0) !!}
        {!! Form::checkbox('credit_sale', '1', null) !!} 1
    </label>
</div>

<!-- Pos Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pos_location', 'Pos Location:') !!}
    {!! Form::text('pos_location', null, ['class' => 'form-control']) !!}
</div>

<!-- Pos Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pos_account', 'Pos Account:') !!}
    {!! Form::number('pos_account', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('salesPos.index') !!}" class="btn btn-default">Cancel</a>
</div>
