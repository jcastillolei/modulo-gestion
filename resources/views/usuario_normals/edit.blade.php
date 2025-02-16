@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Usuario Normal
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($usuarioNormal, ['route' => ['usuarioNormals.update', $usuarioNormal->id], 'method' => 'patch']) !!}

                        @include('usuario_normals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection