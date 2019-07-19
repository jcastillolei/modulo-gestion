<table class="table table-responsive" id="itemBodegas-table">
    <thead>
        <tr>
            <th>Codigo Bodega</th>
            <th>Bodega</th>
            <th>Item</th>
            <th>Descripcion</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @if (empty($itemsBodega))

        @else
            @foreach($itemsBodega as $itemBodega)

                @php
                    $stock = DB::table('0_stock_moves as s')
                        ->leftJoin('0_voided as b', 's.type', '=', 'b.type')
                        ->leftJoin('0_voided as c', 's.trans_no', '=', 'c.id')
                        ->whereNull('c.id')
                        ->where('stock_id',$itemBodega->stock_id)
                        ->where('tran_date','<=',date('Y-m-d'))
                        ->where('loc_code',$itemBodega->loc_code)
                        ->sum('qty'); 
                @endphp

                @if ($stock>0)
                    <tr>
                        <td>{!! $itemBodega->loc_code !!}</td>

                        <td class="desc">
                          @php
                            $bod = DB::table('0_locations')
                                ->where('loc_code',$itemBodega->loc_code)
                                ->first();
                            echo $bod->location_name;
                          @endphp
                        </td>

                        <td>{!! $itemBodega->stock_id !!}</td>

                        <td class="desc">
                          @php
                            $itm = DB::table('0_stock_master')
                                ->where('stock_id',$itemBodega->stock_id)
                                ->first();
                            echo $itm->description;
                          @endphp
                        </td>
                        
                        <td>
                            @php
                                echo $stock;
                            @endphp
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
    </tbody>
</table>
