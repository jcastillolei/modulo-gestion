@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Transacciones Usuariofinal
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($transaccionesUsuariofinal, ['route' => ['transaccionesUsuariofinals.update', $transaccionesUsuariofinal->id], 'method' => 'patch']) !!}

                        @include('transacciones_usuariofinals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection