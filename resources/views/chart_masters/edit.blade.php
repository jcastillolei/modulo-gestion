@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Chart Master
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($chartMaster, ['route' => ['chartMasters.update', $chartMaster->id], 'method' => 'patch']) !!}

                        @include('chart_masters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection