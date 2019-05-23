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
    @foreach($locations as $location)
        <tr>
            <td>{!! $location->location_name !!}</td>
            <td>{!! $location->delivery_address !!}</td>
            <td>{!! $location->phone !!}</td>
            <td>{!! $location->email !!}</td>
            <td>{!! $location->contact !!}</td>
            <td>
                {!! Form::open(['route' => ['locations.destroy', $location->loc_code], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('locations.show', [$location->loc_code]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('locations.edit', [$location->loc_code]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div align="center">{{ $locations->links() }}</div>
