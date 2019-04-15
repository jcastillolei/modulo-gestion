<!-- Location Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_name', 'Nombre:') !!}
    {!! Form::text('location_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('loc_code', 'Codigo:') !!}
    {!! Form::text('loc_code', null, ['class' => 'form-control']) !!}
</div>


<!-- Delivery Address Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('delivery_address', 'Direccion:') !!}
    {!! Form::text('delivery_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Telefono:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>


<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Correo:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact', 'Contacto:') !!}
    {!! Form::text('contact', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('locations.index') !!}" class="btn btn-default">Cancelar</a>
</div>
