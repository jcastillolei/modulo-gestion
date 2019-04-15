<!-- Iduser Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idUser', 'Iduser:') !!}
    {!! Form::number('idUser', null, ['class' => 'form-control']) !!}
</div>

<!-- Idrol Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idRol', 'Idrol:') !!}
    {!! Form::number('idRol', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userRols.index') !!}" class="btn btn-default">Cancel</a>
</div>
