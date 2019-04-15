@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Transaccion
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoTransaccion, ['route' => ['tipoTransaccions.update', $tipoTransaccion->id], 'method' => 'patch']) !!}

                        @include('tipo_transaccions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection