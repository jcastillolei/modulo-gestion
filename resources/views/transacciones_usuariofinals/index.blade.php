@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-center">Transacciones Usuario final</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box-body">
            <table class="table table-responsive" id="transaccions-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha Desde</th>
                        <th>Fecha Hasta</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($est))
                        {!! Form::open(['route' => 'transaccionesUsuariofinals.store']) !!}
                        <tr>
                            <td>  
                                <select name="idUsuario" id="idUsuario" class="form-control">
                                     <option value="">Seleccione Usuario</option>
                                     @foreach($usuarios as $usu)
                                        <option value="{!! $usu->id !!}">
                                            {!! $usu->nombre.' '.$usu->apellido !!}
                                        </option>
                                     @endforeach
                                </select>
                            </td>
                            <td>
                                {!! Form::date('desde', null, ['class' => 'form-control','id'=>'desde']) !!}
                            </td>
                            <td>
                                {!! Form::date('hasta', null, ['class' => 'form-control','id'=>'hasta']) !!}
                            </td>
                            <td>
                                {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}

                                <a class="btn btn-success" href="{!! url('exportExcelTransUsu') !!}">    
                                    Descargar Excel
                                </a>
                            </td>
                        </tr>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => 'transaccionesUsuariofinals.store']) !!}

                            <tr>
                                <td>  
                                    <select name="idUsuario" id="idUsuario" class="form-control">
                                         <option value="">Seleccione Usuario</option>
                                         @foreach($usuarios as $usu)
                                            <option value="{!! $usu->id !!}">
                                                {!! $usu->nombre.' '.$usu->apellido !!}
                                            </option>
                                         @endforeach
                                    </select>
                                </td>
                                <td>
                                    {!! Form::date('desde', null, ['class' => 'form-control','id'=>'desde']) !!}
                                </td>
                                <td>
                                    {!! Form::date('hasta', null, ['class' => 'form-control','id'=>'hasta']) !!}
                                </td>
                                <td>
                                    {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}

                                    <a class="btn btn-success" href="{!! url('exportExcelTransUsu') !!}">    
                                        Descargar Excel
                                    </a>
                                </td>
                            </tr>
                        {!! Form::close() !!}
                    @endif     
                </tbody>
            </table>         
        </div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('transacciones_usuariofinals.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

