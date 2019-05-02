<table class="table table-responsive" id="stockMoves-table">
    <thead>
        <tr>
            <th>Codigo bodega</th>
            <th>Nombre bodega</th>
            <th>Tipo Transaccion</th>
            <th>Item</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Responsable</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($stockMoves as $stockMoves)
        <tr>
            <td>{!! $stockMoves->Bodega !!}</td>
            <td class="desc">
                @php
                    $bod = DB::table('0_locations')
                    ->where('loc_code',$stockMoves->Bodega)
                    ->first();
                    echo $bod->location_name;
                @endphp
            </td>
            <td>{!! $stockMoves->tipoTransaccion !!}</td>
            <td>{!! $stockMoves->Item !!}</td>
            <td class="desc">
                @php
                    $bod = DB::table('0_stock_master')
                    ->where('stock_id',$stockMoves->Item)
                    ->first();
                    echo $bod->description;
                @endphp
            </td>
            <td>{!! $stockMoves->cantidad !!}</td>
            <td>{!! $stockMoves->responsable !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>