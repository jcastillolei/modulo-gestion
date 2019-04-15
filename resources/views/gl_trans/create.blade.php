@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gl Trans
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'glTrans.store']) !!}

                        @include('gl_trans.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
