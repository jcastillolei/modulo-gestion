<table class="table table-responsive" id="glTrans-table">
    <thead>
        <tr>
            <th>Type</th>
        <th>Type No</th>
        <th>Tran Date</th>
        <th>Account</th>
        <th>Memo </th>
        <th>Amount</th>
        <th>Dimension Id</th>
        <th>Dimension2 Id</th>
        <th>Person Type Id</th>
        <th>Person Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($glTrans as $glTrans)
        <tr>
            <td>{!! $glTrans->type !!}</td>
            <td>{!! $glTrans->type_no !!}</td>
            <td>{!! $glTrans->tran_date !!}</td>
            <td>{!! $glTrans->account !!}</td>
            <td>{!! $glTrans->memo_ !!}</td>
            <td>{!! $glTrans->amount !!}</td>
            <td>{!! $glTrans->dimension_id !!}</td>
            <td>{!! $glTrans->dimension2_id !!}</td>
            <td>{!! $glTrans->person_type_id !!}</td>
            <td>{!! $glTrans->person_id !!}</td>
            <td>
                {!! Form::open(['route' => ['glTrans.destroy', $glTrans->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('glTrans.show', [$glTrans->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('glTrans.edit', [$glTrans->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>