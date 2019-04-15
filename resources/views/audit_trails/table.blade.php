<table class="table table-responsive" id="auditTrails-table">
    <thead>
        <tr>
            <th>Type</th>
        <th>Trans No</th>
        <th>User</th>
        <th>Stamp</th>
        <th>Description</th>
        <th>Fiscal Year</th>
        <th>Gl Date</th>
        <th>Gl Seq</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($auditTrails as $auditTrail)
        <tr>
            <td>{!! $auditTrail->type !!}</td>
            <td>{!! $auditTrail->trans_no !!}</td>
            <td>{!! $auditTrail->user !!}</td>
            <td>{!! $auditTrail->stamp !!}</td>
            <td>{!! $auditTrail->description !!}</td>
            <td>{!! $auditTrail->fiscal_year !!}</td>
            <td>{!! $auditTrail->gl_date !!}</td>
            <td>{!! $auditTrail->gl_seq !!}</td>
            <td>
                {!! Form::open(['route' => ['auditTrails.destroy', $auditTrail->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('auditTrails.show', [$auditTrail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('auditTrails.edit', [$auditTrail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>