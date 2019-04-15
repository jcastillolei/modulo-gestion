<!-- Loc Code Field -->
<div class="form-group">
    {!! Form::label('loc_code', 'Codigo:') !!}
    <p>{!! $locations->loc_code !!}</p>
</div>

<!-- Location Name Field -->
<div class="form-group">
    {!! Form::label('location_name', 'Nombre:') !!}
    <p>{!! $locations->location_name !!}</p>
</div>

<!-- Delivery Address Field -->
<div class="form-group">
    {!! Form::label('delivery_address', 'Direccion:') !!}
    <p>{!! $locations->delivery_address !!}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', 'Telefono:') !!}
    <p>{!! $locations->phone !!}</p>
</div>


<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Correo:') !!}
    <p>{!! $locations->email !!}</p>
</div>

<!-- Contact Field -->
<div class="form-group">
    {!! Form::label('contact', 'Contacto:') !!}
    <p>{!! $locations->contact !!}</p>
</div>


