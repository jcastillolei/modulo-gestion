<table class="table table-responsive" id="userRols-table">
    <thead>
        <tr>
            <th>Iduser</th>
        <th>Idrol</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userRols as $userRol)
        <tr>
            <td>{!! $userRol->idUser !!}</td>
            <td>{!! $userRol->idRol !!}</td>
            <td>
                {!! Form::open(['route' => ['userRols.destroy', $userRol->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userRols.show', [$userRol->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userRols.edit', [$userRol->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>