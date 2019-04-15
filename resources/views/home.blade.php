@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	{{ Session::get('rol')}}
    </div>
</div>
@endsection
