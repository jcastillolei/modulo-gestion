<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Correo:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Rol Field -->
@if(Auth::user()->rol==2)
    <div class="form-group col-sm-6">
        {!! Form::label('role', 'Rol:') !!}
        {!! Form::select('roll', $roles, 3, ['class' => 'form-control','disabled']) !!}
        {!! Form::hidden('rol', 3) !!}
    </div>
@elseif(Auth::user()->rol==3)
    <div class="form-group col-sm-6">
        {!! Form::label('role', 'Rol:') !!}
        {!! Form::select('roll', $roles, 3, ['class' => 'form-control','disabled']) !!}
        {!! Form::hidden('rol', 3) !!}
    </div>
@else
    <div class="form-group col-sm-6">
        {!! Form::label('role', 'Rol:') !!}
        {!! Form::select('rol', $roles, null, ['class' => 'form-control']) !!}
    </div>
@endif


<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Contraseña:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
