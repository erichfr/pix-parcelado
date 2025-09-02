@extends('layouts.app')

@section('title', 'Login do Cliente')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card bg-dark text-white border-0 shadow">
            <div class="card-body p-4">
                <h4 class="mb-4 text-center">Login do Cliente</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('client.login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control bg-dark text-white border-secondary" name="email" id="email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control bg-dark text-white border-secondary" name="password" id="password" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info btn-hover">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

