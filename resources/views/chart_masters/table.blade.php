<table class="table table-responsive" id="chartMasters-table">
    <thead>
        <tr>
            <th>Account Code2</th>
        <th>Account Name</th>
        <th>Account Type</th>
        <th>Inactive</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($chartMasters as $chartMaster)
        <tr>
            <td>{!! $chartMaster->account_code2 !!}</td>
            <td>{!! $chartMaster->account_name !!}</td>
            <td>{!! $chartMaster->account_type !!}</td>
            <td>{!! $chartMaster->inactive !!}</td>
            <td>
                {!! Form::open(['route' => ['chartMasters.destroy', $chartMaster->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('chartMasters.show', [$chartMaster->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('chartMasters.edit', [$chartMaster->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>