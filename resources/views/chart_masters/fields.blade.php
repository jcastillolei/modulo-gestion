<!-- Account Code2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account_code2', 'Account Code2:') !!}
    {!! Form::text('account_code2', null, ['class' => 'form-control']) !!}
</div>

<!-- Account Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account_name', 'Account Name:') !!}
    {!! Form::text('account_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Account Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('account_type', 'Account Type:') !!}
    {!! Form::text('account_type', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('chartMasters.index') !!}" class="btn btn-default">Cancel</a>
</div>
