@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <h1>Register</h1>

                        @if(Session::has('error'))
                            <p class='text-danger'>{{ Session::get('error') }}</p>
                        @endif
                        @if(Session::has('success'))
                            <p class='text-success'>{{ Session::get('success') }}</p>
                        @endif

                        {{-- // custom session message --}}
                        @if(Session::has('custom_message'))
                            <p class="text-info">{{ Session::get('custom_message') }}</p>
                        @endif

                        <form action = "{{ route('register') }}" method="post">
                            @csrf
                            @method ('post')
                            <div class="row">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <p class='text-danger'>{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <p class='text-danger'>{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <p class='text-danger'>{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-r text-right">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection