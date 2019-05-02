<table class="table table-responsive" id="logs-table">
    <thead>
        <tr>
        <th>Descripcion</th>
        <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
    @foreach($logs as $log)
        <tr>
            <td>{!! $log->descripcion !!}</td>
            <td>{!! $log->fecha !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>