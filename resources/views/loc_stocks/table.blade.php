<table class="table table-responsive" id="locStocks-table">
    <thead>
        <tr>
            <th>Stock Id</th>
        <th>Reorder Level</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($locStocks as $locStock)
        <tr>
            <td>{!! $locStock->stock_id !!}</td>
            <td>{!! $locStock->reorder_level !!}</td>
            <td>
                {!! Form::open(['route' => ['locStocks.destroy', $locStock->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('locStocks.show', [$locStock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('locStocks.edit', [$locStock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>