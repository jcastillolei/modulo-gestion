@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Item Codes
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($itemCodes, ['route' => ['itemCodes.update', $itemCodes->id], 'method' => 'patch']) !!}

                        @include('item_codes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection