@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Items
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($stockMaster, ['route' => ['stockMasters.update', $stockMaster->stock_id], 'method' => 'patch']) !!}

                        @include('stock_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection