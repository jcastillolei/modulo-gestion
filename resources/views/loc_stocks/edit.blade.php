@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Loc Stock
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($locStock, ['route' => ['locStocks.update', $locStock->id], 'method' => 'patch']) !!}

                        @include('loc_stocks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection