<table class="table table-responsive" id="sadminBodegueros-table">
    <thead>
        <tr>
            <th>Idsadmin</th>
        <th>Idbodeguero</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sadminBodegueros as $sadminBodeguero)
        <tr>
            <td>{!! $sadminBodeguero->idSadmin !!}</td>
            <td>{!! $sadminBodeguero->idBodeguero !!}</td>
            <td>
                {!! Form::open(['route' => ['sadminBodegueros.destroy', $sadminBodeguero->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sadminBodegueros.show', [$sadminBodeguero->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sadminBodegueros.edit', [$sadminBodeguero->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>