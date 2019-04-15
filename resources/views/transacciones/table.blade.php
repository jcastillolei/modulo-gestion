<table class="table table-responsive" id="transacciones-table">
    <thead>
        <tr>
            <th>Tipotransaccion</th>
        <th>Bodega</th>
        <th>Item</th>
        <th>Usuariosolicitud</th>
        <th>Cantidad</th>
        <th>Descripcion</th>
        <th>Responsable</th>
        <th>Autorizadopor</th>
        <th>Cargo</th>
        <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transacciones as $transacciones)
        <tr>
            <td>{!! $transacciones->tipoTransaccion !!}</td>
            <td>{!! $transacciones->Bodega !!}</td>
            <td>{!! $transacciones->Item !!}</td>
            <td>{!! $transacciones->UsuarioSolicitud !!}</td>
            <td>{!! $transacciones->cantidad !!}</td>
            <td>{!! $transacciones->descripcion !!}</td>
            <td>{!! $transacciones->responsable !!}</td>
            <td>{!! $transacciones->autorizadoPor !!}</td>
            <td>{!! $transacciones->cargo !!}</td>
            <td>{!! $transacciones->estado !!}</td>
            <td>
                {!! Form::open(['route' => ['transacciones.destroy', $transacciones->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('transacciones.show', [$transacciones->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('transacciones.edit', [$transacciones->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>