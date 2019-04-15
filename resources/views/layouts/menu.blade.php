@if(!empty(Session::get('rol')) && Session::get('rol') == 1)
    
    <li class="{{ Request::is('locations*') ? 'active' : '' }}">
        <a href="{!! route('locations.index') !!}"><i class="fa fa-edit"></i><span>Bodegas</span></a>
    </li>

    <li class="{{ Request::is('stockMasters*') ? 'active' : '' }}">
        <a href="{!! route('stockMasters.index') !!}"><i class="fa fa-edit"></i><span>Items</span></a>
    </li>

    <li class="{{ Request::is('reports*') ? 'active' : '' }}">
        <a href="{!! route('reports.index') !!}"><i class="fa fa-edit"></i><span>Transacciones</span></a>
    </li>

    <li class="{{ Request::is('reportss*') ? 'active' : '' }}">
        <a href="{!! route('reportss.index') !!}"><i class="fa fa-edit"></i><span>Item Bodegas</span></a>
    </li>

    <li class="{{ Request::is('logs*') ? 'active' : '' }}">
        <a href="{!! route('RepLog.index') !!}"><i class="fa fa-edit"></i><span>Logs</span></a>
    </li>

    <li class="{{ Request::is('usuarioBodegas*') ? 'active' : '' }}">
        <a href="{!! route('usuarioBodegas.index') !!}"><i class="fa fa-edit"></i><span>Usuario Bodega</span></a>
    </li>

    <li class="{{ Request::is('usuarioNormals*') ? 'active' : '' }}">
        <a href="{!! route('usuarioNormals.index') !!}"><i class="fa fa-edit"></i><span>Usuario Normal</span></a>
    </li>

    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Usuarios</span></a>
    </li>

    <li class="{{ Request::is('tran*') ? 'active' : '' }}">
        <a href="{!! route('tran.index') !!}"><i class="fa fa-edit"></i><span>Transferir Item</span></a>
    </li>

    <li class="{{ Request::is('movimientos*') ? 'active' : '' }}">
        <a href="{!! route('movimientos.index') !!}"><i class="fa fa-edit"></i><span>Despacho/Devolucion</span></a>
    </li>


@elseif(!empty(Session::get('rol')) && Session::get('rol') == 2)
    

    <li class="{{ Request::is('reports*') ? 'active' : '' }}">
        <a href="{!! route('reports.index') !!}"><i class="fa fa-edit"></i><span>Transacciones</span></a>
    </li>

    <li class="{{ Request::is('reportss*') ? 'active' : '' }}">
        <a href="{!! route('reportss.index') !!}"><i class="fa fa-edit"></i><span>Item Bodegas</span></a>
    </li>

    <li class="{{ Request::is('usuarioBodegas*') ? 'active' : '' }}">
        <a href="{!! route('usuarioBodegas.index') !!}"><i class="fa fa-edit"></i><span>Usuario Bodega</span></a>
    </li>

    <li class="{{ Request::is('usuarioNormals*') ? 'active' : '' }}">
        <a href="{!! route('usuarioNormals.index') !!}"><i class="fa fa-edit"></i><span>Usuario Normal</span></a>
    </li>

    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Usuarios</span></a>
    </li>

    <li class="{{ Request::is('tran*') ? 'active' : '' }}">
        <a href="{!! route('tran.index') !!}"><i class="fa fa-edit"></i><span>Transferir Item</span></a>
    </li>

    <li class="{{ Request::is('movimientos*') ? 'active' : '' }}">
        <a href="{!! route('movimientos.index') !!}"><i class="fa fa-edit"></i><span>Despacho/Devolucion</span></a>
    </li>

@elseif(!empty(Session::get('rol')) && Session::get('rol') == 3)

    <li class="{{ Request::is('reports*') ? 'active' : '' }}">
        <a href="{!! route('reports.index') !!}"><i class="fa fa-edit"></i><span>Transacciones</span></a>
    </li>

    <li class="{{ Request::is('reportss*') ? 'active' : '' }}">
        <a href="{!! route('reportss.index') !!}"><i class="fa fa-edit"></i><span>Item Bodegas</span></a>
    </li>

    <li class="{{ Request::is('usuarioBodegas*') ? 'active' : '' }}">
        <a href="{!! route('usuarioBodegas.index') !!}"><i class="fa fa-edit"></i><span>Usuario Bodega</span></a>
    </li>

    <li class="{{ Request::is('usuarioNormals*') ? 'active' : '' }}">
        <a href="{!! route('usuarioNormals.index') !!}"><i class="fa fa-edit"></i><span>Usuario Normal</span></a>
    </li>

    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Usuarios</span></a>
    </li>

    <li class="{{ Request::is('tran*') ? 'active' : '' }}">
        <a href="{!! route('tran.index') !!}"><i class="fa fa-edit"></i><span>Transferir Item</span></a>
    </li>

    <li class="{{ Request::is('movimientos*') ? 'active' : '' }}">
        <a href="{!! route('movimientos.index') !!}"><i class="fa fa-edit"></i><span>Despacho/Devolucion</span></a>
    </li>

@endif