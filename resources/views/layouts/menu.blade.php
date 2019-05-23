@if(!empty(Session::get('rol')) && Session::get('rol') == 1)
    
    <li class="{{ Request::is('locations*') ? 'active' : '' }}">
        <a href="{!! route('locations.index') !!}"><i class="fa fa-briefcase"></i><span>Bodegas</span></a>
    </li>

    <li class="{{ Request::is('stockMasters*') ? 'active' : '' }}">
        <a href="{!! route('stockMasters.index') !!}"><i class="fa fa-cubes"></i><span>Items</span></a>
    </li>

    <li class="{{ Request::is('reports*') ? 'active' : '' }}">
        <a href="{!! route('reports.index') !!}"><i class="fa fa-line-chart"></i><span>Transacciones</span></a>
    </li>

    <li class="{{ Request::is('reportss*') ? 'active' : '' }}">
        <a href="{!! route('reportss.index') !!}"><i class="fa fa-edit"></i><span>Item Bodegas</span></a>
    </li>

    <li class="{{ Request::is('logs*') ? 'active' : '' }}">
        <a href="{!! route('RepLog.index') !!}"><i class="fa fa-file-text"></i><span>Logs</span></a>
    </li>

    <li class="{{ Request::is('usuarioBodegas*') ? 'active' : '' }}">
        <a href="{!! route('usuarioBodegas.index') !!}"><i class="fa fa-sitemap"></i><span>Usuario Bodega</span></a>
    </li>

    <li class="{{ Request::is('usuarioNormals*') ? 'active' : '' }}">
        <a href="{!! route('usuarioNormals.index') !!}"><i class="fa fa-user-o"></i><span>Usuario Normal</span></a>
    </li>

    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Usuarios</span></a>
    </li>

    <li class="{{ Request::is('tran*') ? 'active' : '' }}">
        <a href="{!! route('tran.index') !!}"><i class="fa fa-exchange"></i><span>Transferir Item</span></a>
    </li>

    <li class="{{ Request::is('movimientos*') ? 'active' : '' }}">
        <a href="{!! route('movimientos.index') !!}"><i class="fa fa-truck"></i><span>Despacho/Devolucion</span></a>
    </li>


@elseif(!empty(Session::get('rol')) && Session::get('rol') == 2)
    

    <li class="{{ Request::is('reports*') ? 'active' : '' }}">
        <a href="{!! route('reports.index') !!}"><i class="fa fa-line-chart"></i><span>Transacciones</span></a>
    </li>

    <li class="{{ Request::is('reportss*') ? 'active' : '' }}">
        <a href="{!! route('reportss.index') !!}"><i class="fa fa-edit"></i><span>Item Bodegas</span></a>
    </li>

    <li class="{{ Request::is('usuarioBodegas*') ? 'active' : '' }}">
        <a href="{!! route('usuarioBodegas.index') !!}"><i class="fa fa-sitemap"></i><span>Usuario Bodega</span></a>
    </li>

    <li class="{{ Request::is('usuarioNormals*') ? 'active' : '' }}">
        <a href="{!! route('usuarioNormals.index') !!}"><i class="fa fa-user-o"></i><span>Usuario Normal</span></a>
    </li>

    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Usuarios</span></a>
    </li>

    <li class="{{ Request::is('tran*') ? 'active' : '' }}">
        <a href="{!! route('tran.index') !!}"><i class="fa fa-exchange"></i><span>Transferir Item</span></a>
    </li>

    <li class="{{ Request::is('movimientos*') ? 'active' : '' }}">
        <a href="{!! route('movimientos.index') !!}"><i class="fa fa-truck"></i><span>Despacho/Devolucion</span></a>

    </li>
    <li class="{{ Request::is('bodegaUsuarionormals*') ? 'active' : '' }}">
    <a href="{!! route('bodegaUsuarionormals.index') !!}"><i class="fa fa-edit"></i><span>Bodega Usuarionormals</span></a>
    </li>

    <li class="{{ Request::is('sadminBodegueros*') ? 'active' : '' }}">
        <a href="{!! route('sadminBodegueros.index') !!}"><i class="fa fa-edit"></i><span>Sadmin Bodegueros</span></a>

    </li>


@elseif(!empty(Session::get('rol')) && Session::get('rol') == 3)

    <li class="{{ Request::is('reports*') ? 'active' : '' }}">
        <a href="{!! route('reports.index') !!}"><i class="fa fa-line-chart"></i><span>Transacciones</span></a>
    </li>

    <li class="{{ Request::is('reportss*') ? 'active' : '' }}">
        <a href="{!! route('reportss.index') !!}"><i class="fa fa-edit"></i><span>Item Bodegas</span></a>
    </li>

    <li class="{{ Request::is('usuarioBodegas*') ? 'active' : '' }}">
        <a href="{!! route('usuarioBodegas.index') !!}"><i class="fa fa-sitemap"></i><span>Usuario Bodega</span></a>
    </li>

    <li class="{{ Request::is('usuarioNormals*') ? 'active' : '' }}">
        <a href="{!! route('usuarioNormals.index') !!}"><i class="fa fa-user-o"></i><span>Usuario Normal</span></a>
    </li>

    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Usuarios</span></a>
    </li>

    <li class="{{ Request::is('tran*') ? 'active' : '' }}">
        <a href="{!! route('tran.index') !!}"><i class="fa fa-exchange"></i><span>Transferir Item</span></a>
    </li>

    <li class="{{ Request::is('movimientos*') ? 'active' : '' }}">
        <a href="{!! route('movimientos.index') !!}"><i class="fa fa-truck"></i><span>Despacho/Devolucion</span></a>
    </li>

@endif


