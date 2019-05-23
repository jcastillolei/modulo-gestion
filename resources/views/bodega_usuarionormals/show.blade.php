@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bodega Usuarionormal
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('bodega_usuarionormals.show_fields')
                    <a href="{!! route('bodegaUsuarionormals.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
