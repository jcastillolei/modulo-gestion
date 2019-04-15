@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Grn Items
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($grnItems, ['route' => ['grnItems.update', $grnItems->id], 'method' => 'patch']) !!}

                        @include('grn_items.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection