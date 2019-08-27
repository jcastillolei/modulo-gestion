<table class="table table-responsive" id="transaccionesUsuariofinals-table">
    <thead>
        <tr>
            <th>Id Usuariofinal</th>
        <th>Codigo Bodega</th>
        <th>Codigo Item</th>
        <th>Descripcion Item</th>
        <th>Cantidad</th>
        <th>Tipo Transaccion</th>
        <th>Fecha</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transaccionesUsuariofinals as $transaccionesUsuariofinal)
        <tr>
            <td>{!! $transaccionesUsuariofinal->Id_UsuarioFinal !!}</td>
            <td>{!! $transaccionesUsuariofinal->Codigo_bodega !!}</td>
            <td>{!! $transaccionesUsuariofinal->Codigo_item !!}</td>
            <td>{!! $transaccionesUsuariofinal->Descripcion_item !!}</td>
            <td>{!! $transaccionesUsuariofinal->Cantidad !!}</td>
            <td>{!! $transaccionesUsuariofinal->tipo_transaccion !!}</td>
            <td>{!! $transaccionesUsuariofinal->Fecha !!}</td>
            <td>
                {!! Form::open(['route' => ['transaccionesUsuariofinals.destroy', $transaccionesUsuariofinal->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('transaccionesUsuariofinals.show', [$transaccionesUsuariofinal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('transaccionesUsuariofinals.edit', [$transaccionesUsuariofinal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>