@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Reporte Inventario</h1>
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
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($est))
                            {!! Form::open(['route' => 'reportss.store']) !!}
                                <tr>
                                    <td>
                                        {!! Form::select('idBodega', $bodegas, 0, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::select('idItem', $items, 0, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                                        <a class="btn btn-success" href="
                                        {!! url('exportExcel') !!}">Descargar Excel</a>
                                        <a class="btn btn-danger" href="
                                        {!! url('exportPdf') !!}">Descargar PDF</a>
                                    </td>
                                </tr>

                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => 'reportss.store']) !!}
                                <tr>
                                    <td>
                                        {!! Form::select('idBodega', $bodegas, $idBod, ['class' => 'form-control']) !!}
                                    </td>
                                     <td>
                                        {!! Form::select('idItem', $items, $idItem, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                                        <a class="btn btn-success" href="
                                        {!! url('exportExcel') !!}">Descargar Excel</a>
                                        <a class="btn btn-danger" href="
                                        {!! url('exportPdf') !!}">Descargar PDF</a>
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
                    @include('item_bodegas.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

