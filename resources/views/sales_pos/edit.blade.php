@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sales Pos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($salesPos, ['route' => ['salesPos.update', $salesPos->id], 'method' => 'patch']) !!}

                        @include('sales_pos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection