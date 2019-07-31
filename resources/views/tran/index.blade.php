@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-center">Transferir Item</h1>
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
                            <th>Nombre Item</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
		                    <tr>
		                        <td>
		                            {!! Form::select('item', $items, 1, ['class' => 'form-control']) !!}
		                        </td>
		                        <td>
		                            {!! Form::number('cantidad', null, ['class' => 'form-control', 'required']) !!}
		                        </td>                                  
		                        <td>	
		                        	{!! Form::hidden('acc', 2) !!}
		                            {!! Form::submit('Añadir', ['class' => 'btn btn-primary']) !!}
		                            <a class="btn btn-success" href="
                                        {!! url('limpiar') !!}">Limpiar lista</a>
		                        </td>
		                    </tr>
                        {!! Form::close() !!}      
                    </tbody>
                </table>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="transaccions-table">
                    <thead>
                        <tr>
                            <th>Bodega Origen</th>
                            <th>Bodega Destino</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    	{!! Form::open(['route' => 'tran.store']) !!}
	                        @if (empty($est))
	                            <tr>
	                                <td>
	                                    {!! Form::select('idBodegaOrigen', $bodegas, 1, ['class' => 'form-control', 'required']) !!}
	                                </td>
	                                <td>
	                                    {!! Form::select('idBodegaDestino', $bodegas, 1, ['class' => 'form-control']) !!}
	                                </td>
	                                <td>
	                                    {!! Form::date('fecha', date('Y-m-d'), ['class' => 'form-control','id'=>'email_verified_at']) !!}
	                                </td>                                  
	                                <td>	
	                                	{!! Form::hidden('acc', 1) !!}
	                                    {!! Form::submit('Transferir', ['class' => 'btn btn-primary']) !!}
	                                </td> 
	                            </tr>
	                        @else
	                                <tr>
		                                <td>
		                                    {!! Form::select('idBodegaOrigen', $bodegas, Session::get('idBod'), ['class' => 'form-control', 'required']) !!}
		                                </td>
		                                <td>
		                                    {!! Form::select('idBodegaDestino', $bodegas, Session::get('idItm'), ['class' => 'form-control']) !!}
		                                </td>
		                                <td>
		                                    {!! Form::date('fecha', date('Y-m-d'), ['class' => 'form-control','id'=>'email_verified_at']) !!}
		                                </td>
		                                <td>	
		                                	{!! Form::hidden('acc', 1) !!}
	                                    {!! Form::submit('Transferir', ['class' => 'btn btn-primary']) !!}
	                                </td>                                  
		                            </tr>                      
	                        @endif
	                    {!! Form::close() !!}

	                    {!! Form::open(['route' => 'tran.store']) !!}       
                    </tbody>
                </table>                     
            </div>
               
        </div>
        @if(!empty($itemsLista))
        	@if(empty($repor))
	        	<div class="box box-primary">       	
		            <div class="box-body">	            	
		                    @include('tran.table')	                
		            </div>
	        	</div>
	        @else
	        	<div class="box box-primary">       	
		            <div class="box-body">	            	
		                <center><a class="btn btn-danger" href="
                            {!! url('exportPdfTransf') !!}">Descargar PDF
                        </a></center>	                
		            </div>
	        	</div>
	        @endif
        @endif
        <div class="text-center">
        
        </div>
    </div>
@endsection