<table class="table table-responsive" id="transaccionesUsuariofinals-table">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Bodega</th>
            <th>Codigo Item</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Tipo Transacción</th>
            <th>Fecha</th>
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
        </tr>
    @endforeach
    </tbody>
</table>