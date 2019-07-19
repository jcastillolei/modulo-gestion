<table class="table table-responsive" id="usuarioBodegas-table">
    <thead>
        <tr>
            <th>Codigo Bodega</th>
            <th>Nombre Bodega</th>
            <th>Id Usuario</th>
            <th>Nombre Usuario</th>     
        </tr>
    </thead>
    <tbody>
    @foreach($usuarioBodegas as $usuarioBodega)
        <tr>
            <td>{!! $usuarioBodega->idBodega !!}</td>
            <td>
                @php
                    $nombreLocacion = DB::table('0_locations')->where('loc_code', $usuarioBodega->idBodega)->value('location_name');
                    echo $nombreLocacion;
                @endphp
            </td>

            <td>{!! $usuarioBodega->idUsuario !!}</td>

            <td>
                @php
                    $nombreItem = DB::table('users')->where('id', $usuarioBodega->idUsuario)->value('name');
                    echo $nombreItem;
                @endphp
            </td>

            <td>
                {!! Form::open(['route' => ['usuarioBodegas.destroy', $usuarioBodega->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('usuarioBodegas.show', [$usuarioBodega->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('usuarioBodegas.edit', [$usuarioBodega->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>