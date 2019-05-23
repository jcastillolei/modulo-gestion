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
            <td class="desc">
                @php
                    $bod = DB::table('0_chart_master')
                    ->where('account_code',$stockMaster->inventory_account)
                    ->first();
                    echo $bod->account_name;
                @endphp
            </td>

            <td class="desc">
                @php
                    $bod = DB::table('0_chart_master')
                    ->where('account_code',$stockMaster->adjustment_account)
                    ->first();
                    echo $bod->account_name;
                @endphp
            </td>

            <td>${!! number_format($stockMaster->material_cost, 0) !!}</td>
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
<div align="center">{{ $stockMasters->links() }}</div>