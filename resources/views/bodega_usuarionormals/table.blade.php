<table class="table table-responsive" id="bodegaUsuarionormals-table">
    <thead>
        <tr>
            <th>Codbodega</th>
        <th>Idusuarionormall</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bodegaUsuarionormals as $bodegaUsuarionormal)
        <tr>
            <td>{!! $bodegaUsuarionormal->codBodega !!}</td>
            <td>{!! $bodegaUsuarionormal->idUsuarioNormall !!}</td>
            <td>
                {!! Form::open(['route' => ['bodegaUsuarionormals.destroy', $bodegaUsuarionormal->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bodegaUsuarionormals.show', [$bodegaUsuarionormal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bodegaUsuarionormals.edit', [$bodegaUsuarionormal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>