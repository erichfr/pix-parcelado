@extends('layouts.app')

@section('title','Cadastrar Cliente')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg p-4" style="background: linear-gradient(135deg,#1a1a2e,#162447); border-radius:15px; color:white;">
            <h3 class="text-center mb-4">Cadastrar Novo Cliente</h3>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome <span class="text-warning">*</span></label>
                    <input type="text" class="form-control bg-dark text-white border-0" id="nome" name="nome" value="{{ old('nome') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control bg-dark text-white border-0" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control bg-dark text-white border-0" id="telefone" name="telefone" value="{{ old('telefone') }}">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-info btn-hover px-5">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
