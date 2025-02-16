<table class="table table-responsive" id="tipoTransaccions-table">
    <thead>
        <tr>
            <th>Id</th>
        <th>Nombre</th>
        <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tipoTransaccions as $tipoTransaccion)
        <tr>
            <td>{!! $tipoTransaccion->id !!}</td>
            <td>{!! $tipoTransaccion->nombre !!}</td>
            <td>{!! $tipoTransaccion->estado !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoTransaccions.destroy', $tipoTransaccion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoTransaccions.show', [$tipoTransaccion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tipoTransaccions.edit', [$tipoTransaccion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>