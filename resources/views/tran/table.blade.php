<table class="table table-responsive" id="locations-table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Nombre</th>
        <th>Cantidad</th>
    </thead>
    <tbody>
    @foreach($itemsLista as $item)
        <tr>
            <td>{!! $item['stock_id'] !!}</td>
            <td>
                @php
                  $nombre = DB::table('0_stock_master')
                  ->where('stock_id', '=', $item['stock_id'])
                  ->first();

                  echo $nombre->description;
                @endphp
            </td>
            <td>{!! $item['cantidad'] !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>