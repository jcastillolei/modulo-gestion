<table class="table table-responsive" id="itemBodegas-table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Bodega</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @if (empty($itemsBodega))

        @else
            @foreach($itemsBodega as $itemBodega)
                <tr>
                    <td>{!! $itemBodega->stock_id !!}</td>
                    <td>{!! $itemBodega->loc_code !!}</td>
                    <td>
                        @php
                            $stock = DB::table('0_stock_moves as s')
                                ->leftJoin('0_voided as b', 's.type', '=', 'b.type')
                                ->leftJoin('0_voided as c', 's.trans_no', '=', 'c.id')
                                ->whereNull('c.id')
                                ->where('stock_id',$itemBodega->stock_id)
                                ->where('tran_date','<=',date('Y-m-d'))
                                ->where('loc_code',$itemBodega->loc_code)
                                ->sum('qty'); 
                        echo $stock;
                        @endphp
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>