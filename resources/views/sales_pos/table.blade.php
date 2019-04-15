<table class="table table-responsive" id="salesPos-table">
    <thead>
        <tr>
            <th>Pos Name</th>
        <th>Cash Sale</th>
        <th>Credit Sale</th>
        <th>Pos Location</th>
        <th>Pos Account</th>
        <th>Inactive</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($salesPos as $salesPos)
        <tr>
            <td>{!! $salesPos->pos_name !!}</td>
            <td>{!! $salesPos->cash_sale !!}</td>
            <td>{!! $salesPos->credit_sale !!}</td>
            <td>{!! $salesPos->pos_location !!}</td>
            <td>{!! $salesPos->pos_account !!}</td>
            <td>{!! $salesPos->inactive !!}</td>
            <td>
                {!! Form::open(['route' => ['salesPos.destroy', $salesPos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('salesPos.show', [$salesPos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('salesPos.edit', [$salesPos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>