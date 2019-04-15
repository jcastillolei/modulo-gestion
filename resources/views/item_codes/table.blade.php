<table class="table table-responsive" id="itemCodes-table">
    <thead>
        <tr>
            <th>Item Code</th>
        <th>Stock Id</th>
        <th>Description</th>
        <th>Category Id</th>
        <th>Quantity</th>
        <th>Is Foreign</th>
        <th>Inactive</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($itemCodes as $itemCodes)
        <tr>
            <td>{!! $itemCodes->item_code !!}</td>
            <td>{!! $itemCodes->stock_id !!}</td>
            <td>{!! $itemCodes->description !!}</td>
            <td>{!! $itemCodes->category_id !!}</td>
            <td>{!! $itemCodes->quantity !!}</td>
            <td>{!! $itemCodes->is_foreign !!}</td>
            <td>{!! $itemCodes->inactive !!}</td>
            <td>
                {!! Form::open(['route' => ['itemCodes.destroy', $itemCodes->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('itemCodes.show', [$itemCodes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('itemCodes.edit', [$itemCodes->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>