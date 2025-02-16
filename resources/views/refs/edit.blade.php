@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Refs
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($refs, ['route' => ['refs.update', $refs->id], 'method' => 'patch']) !!}

                        @include('refs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection