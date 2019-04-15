<table class="table table-responsive" id="usuarioNormals-table">
    <thead>
        <tr>
            <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Cargo</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($usuarioNormals as $usuarioNormal)
        <tr>
            <td>{!! $usuarioNormal->id !!}</td>
            <td>{!! $usuarioNormal->nombre !!}</td>
            <td>{!! $usuarioNormal->apellido !!}</td>
            <td>{!! $usuarioNormal->cargo !!}</td>
            <td>{!! $usuarioNormal->correo !!}</td>
            <td>{!! $usuarioNormal->telefono !!}</td>
            <td>{!! $usuarioNormal->estado !!}</td>
            <td>
                {!! Form::open(['route' => ['usuarioNormals.destroy', $usuarioNormal->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('usuarioNormals.show', [$usuarioNormal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('usuarioNormals.edit', [$usuarioNormal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>