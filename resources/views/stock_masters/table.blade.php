<table class="table table-responsive" id="stockMasters-table">
    <thead>
        <tr>
        <th>Descripcion</th>
        <th>Cuenta Inventario</th>
        <th>Cuenta Ajuste</th>
        <th>Precio</th>
            <th colspan="3">Accion</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stockMasters as $stockMaster)
        <tr>
            <td>{!! $stockMaster->description !!}</td>
            <td>{!! $stockMaster->inventory_account !!}</td>
            <td>{!! $stockMaster->adjustment_account !!}</td>
            <td>{!! $stockMaster->material_cost !!}</td>
            <td>
                {!! Form::open(['route' => ['stockMasters.destroy', $stockMaster->stock_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('stockMasters.show', [$stockMaster->stock_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('stockMasters.edit', [$stockMaster->stock_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>