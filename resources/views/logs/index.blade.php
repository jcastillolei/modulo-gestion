@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-center">Reporte Logs</h1>
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
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($est))
                            {!! Form::open(['route' => 'RepLog.store']) !!}

                                <tr>
                                    <td>
                                        {!! Form::select('idUsu', $usuarios, 0, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::date('fecha', null, ['class' => 'form-control','id'=>'email_verified_at']) !!}     
                                    </td>
                                     <td>
                                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}

                                        <a class="btn btn-success" href="

                                            {!! url('exportExcelLog') !!}">    

                                            Descargar Excel
                                        </a>
                                        <!--<a class="btn btn-danger" href="
                                            {!! url('exportPdfLog') !!}">Descargar PDF
                                        </a>-->
                                    </td>
                                </tr>

                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => 'reports.store']) !!}

                                <tr>
                                    <td>
                                        {!! Form::select('idUsu', $usuarios, 0, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                         {!! Form::date('fecha', null, ['class' => 'form-control','id'=>'email_verified_at']) !!}
                                    </td>
                                     <td>
                                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}

                                        <a class="btn btn-success" href="

                                            {!! url('exportExcelLog') !!}">    

                                            Descargar Excel
                                        </a>
                                        <a class="btn btn-danger" href="
                                            {!! url('exportPdfLog') !!}">Descargar PDF
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
                    @include('logs.table')
            </div>
        </div>
    </div>
@endsection

