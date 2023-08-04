@extends('layouts.app')

@section('content')

<div class="demo-container">
    <div class="container">
      <div class="row">
        @if(Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif
        <div class="col-lg-6 col-12 mx-auto mt-5">
          
          <div class="p-3 bg-white rounded shadow-lg">
            <h2 class="mb-2 text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <label class="font-500">Email</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
               <label class="font-500">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
              <button type="submit" class="btn btn-success  w-100 shadow-lg mt-3">Login</button>
            </form>
           <div class="text-center pt-4 ">
            <p class="m-0">Do not have an account? <a href="{{route('register')}}" class="text-dark font-weight-bold">Register</a></p>
          </div>          
          </div>        
        </div>
      </div>
    </div>
  </div>

<div id="dropDownSelect1"></div>
@endsection