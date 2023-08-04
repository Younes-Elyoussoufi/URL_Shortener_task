@extends('layouts.app')

@section('content')
<div class="row my-5">
    <div class="col-md-12">
        <home-component :user_id={{auth()->user()->id ? auth()->user()->id:3}}></home-component>
    </div>
</div>
@endsection