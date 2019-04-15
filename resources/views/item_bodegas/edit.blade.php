@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Item Bodega
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($itemBodega, ['route' => ['itemBodegas.update', $itemBodega->id], 'method' => 'patch']) !!}

                        @include('item_bodegas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection