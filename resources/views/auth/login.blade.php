@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                            <input id="username" type="text" name="username" required autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="form-group">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                            <input id="password" type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
