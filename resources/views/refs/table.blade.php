<table class="table table-responsive" id="refs-table">
    <thead>
        <tr>
            <th>Type</th>
        <th>Reference</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($refs as $refs)
        <tr>
            <td>{!! $refs->type !!}</td>
            <td>{!! $refs->reference !!}</td>
            <td>
                {!! Form::open(['route' => ['refs.destroy', $refs->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('refs.show', [$refs->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('refs.edit', [$refs->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>