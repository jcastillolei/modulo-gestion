<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $user->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Correo:') !!}
    <p>{!! $user->email !!}</p>
</div>


<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Contraseña:') !!}
    <p>{!! $user->password !!}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Fecha Creacion:') !!}
    <p>{!! $user->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Ultima Modificacion:') !!}
    <p>{!! $user->updated_at !!}</p>
</div>

