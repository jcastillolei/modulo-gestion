@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-center">Transacciones</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="transaccions-table">
                    <thead>
                        <tr>
                            <th>Bodega</th>
                            <th>Item</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($est))
                            {!! Form::open(['route' => 'reports.store']) !!}

                            <tr>
                                <td>
                                    {!! Form::select('idBodega', $bodegas, 0, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::select('idItemBodega', $items, 0, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::select('idUsuario', $usuarios, 0, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::date('fecha', null, ['class' => 'form-control','id'=>'email_verified_at']) !!}
                                    </td>
                                    
                                     <td>
                                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}

                                        <a class="btn btn-success" href="

                                            {!! url('exportExcelTran') !!}">    

                                            Descargar Excel
                                        </a>
                                    </td>
                                </tr>

                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => 'reports.store']) !!}

                                <tr>
                                    <td>
                                    {!! Form::select('idBodega', $bodegas, $idBod, ['class' => 'form-control']) !!}
                                    </td>
                                     <td>
                                        {!! Form::select('idItemBodega', $items, $idItm, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::select('idUsuario', $usuarios, $idUsuario, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::date('fecha', $fecha, ['class' => 'form-control','id'=>'email_verified_at']) !!}
                                    </td>
                                     <td>
                                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}

                                        <a class="btn btn-success" href="

                                            {!! url('exportExcelTran') !!}">    

                                            Descargar Excel
                                        </a>
                                    </td>
                                </tr>
                            {!! Form::close() !!}
                        @endif     
                    </tbody>
                </table>         
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('stock_moves.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection


