<table class="table table-responsive" id="locations-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Contacto</th>
            <th colspan="3">Accion</th>
        </tr>
    </thead>
    <tbody>
    @foreach($locations as $locations)
        <tr>
            <td>{!! $locations->location_name !!}</td>
            <td>{!! $locations->delivery_address !!}</td>
            <td>{!! $locations->phone !!}</td>
            <td>{!! $locations->email !!}</td>
            <td>{!! $locations->contact !!}</td>
            <td>
                {!! Form::open(['route' => ['locations.destroy', $locations->loc_code], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('locations.show', [$locations->loc_code]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('locations.edit', [$locations->loc_code]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>