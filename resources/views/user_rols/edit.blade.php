@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Rol
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userRol, ['route' => ['userRols.update', $userRol->id], 'method' => 'patch']) !!}

                        @include('user_rols.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection