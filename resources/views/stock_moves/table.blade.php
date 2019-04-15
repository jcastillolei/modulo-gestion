<table class="table table-responsive" id="stockMoves-table">
    <thead>
        <tr>
            <th>Bodega</th>
            <th>Tipo Transaccion</th>
            <th>Item</th>
            <th>Cantidad</th>
            <th>Responsable</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($stockMoves as $stockMoves)
        <tr>
            <td>{!! $stockMoves->Bodega !!}</td>
            <td>{!! $stockMoves->tipoTransaccion !!}</td>
            <td>{!! $stockMoves->Item !!}</td>
            <td>{!! $stockMoves->cantidad !!}</td>
            <td>{!! $stockMoves->responsable !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>