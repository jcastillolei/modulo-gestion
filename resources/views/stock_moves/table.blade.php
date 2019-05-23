<table class="table table-responsive" id="stockMoves-table">
    <thead>
        <tr>
            <th>Codigo bodega</th>
            <th>Tipo Transaccion</th>
            <th>Item</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Responsable</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($stockMoves as $stockMove)
        <tr>
            <td>{!! $stockMove->Bodega !!}</td>
            <td>{!! $stockMove->tipoTransaccion !!}</td>
            <td>{!! $stockMove->Item !!}</td>
            <td class="desc">
                @php
                    $bod = DB::table('0_stock_master')
                    ->where('stock_id',$stockMove->Item)
                    ->first();
                    echo $bod->description;
                @endphp
            </td>
            <td>{!! $stockMove->cantidad !!}</td>
            <td>{!! $stockMove->responsable !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
