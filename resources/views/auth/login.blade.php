@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-around">
        <img src="{{ asset('images/smartpoint-login.png') }}" alt="Logo" class="img-fluid col-8 col-sm-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center ">
                    <h2>Inicia Sesión</h2>
                </div>


                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username: (Unico)</label>
                            <input id="username" type="text" name="username" required autofocus class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password:</label>
                            <div class="col-sm-10">

                                <input id="password" type="password" name="password" required class="form-control col-sm-8">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Ingresa</button>
                        </div>
                        <div class="text-center">
                            <a href="/register" class="">Registrate</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
