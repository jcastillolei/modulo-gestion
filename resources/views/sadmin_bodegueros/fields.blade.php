<!-- Idsadmin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idSadmin', 'Idsadmin:') !!}
    {!! Form::number('idSadmin', null, ['class' => 'form-control']) !!}
</div>

<!-- Idbodeguero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idBodeguero', 'Idbodeguero:') !!}
    {!! Form::number('idBodeguero', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sadminBodegueros.index') !!}" class="btn btn-default">Cancel</a>
</div>
