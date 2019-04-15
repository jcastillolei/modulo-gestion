<table class="table table-responsive" id="locations-table">
    <thead>
        <tr>
            <th>Item</th>
        <th>Cantidad</th>
    </thead>
    <tbody>
    @foreach($itemsLista as $item)
        <tr>
            <td>{!! $item['stock_id'] !!}</td>
            <td>{!! $item['cantidad'] !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>