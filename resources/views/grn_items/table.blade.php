<table class="table table-responsive" id="grnItems-table">
    <thead>
        <tr>
            <th>Grn Batch Id</th>
        <th>Po Detail Item</th>
        <th>Item Code</th>
        <th>Description</th>
        <th>Qty Recd</th>
        <th>Quantity Inv</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($grnItems as $grnItems)
        <tr>
            <td>{!! $grnItems->grn_batch_id !!}</td>
            <td>{!! $grnItems->po_detail_item !!}</td>
            <td>{!! $grnItems->item_code !!}</td>
            <td>{!! $grnItems->description !!}</td>
            <td>{!! $grnItems->qty_recd !!}</td>
            <td>{!! $grnItems->quantity_inv !!}</td>
            <td>
                {!! Form::open(['route' => ['grnItems.destroy', $grnItems->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('grnItems.show', [$grnItems->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('grnItems.edit', [$grnItems->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>