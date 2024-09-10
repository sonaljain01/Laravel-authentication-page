@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <h1>Login</h1>

                        @if(Session::has('error'))
                            <p class='text-danger'>{{ Session::get('error') }}</p>
                        @endif
                        @if(Session::has('success'))
                            <p class='text-success'>{{ Session::get('success') }}</p>
                        @endif

                        <form action = "{{ route('login') }}" method="post">
                            @csrf
                            @method ('post')
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
                                <div class="col-8 text-left">
                                    <a href="#" class="btn btn-link">Forgot password?</a>
                                </div>
                                <div class="col-r text-right">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection