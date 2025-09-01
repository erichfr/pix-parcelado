@extends('layouts.app')

@section('title','Clientes')

@section('content')
<h2 class="mb-5 text-center display-6 fw-bold">💠 Clientes</h2>

@if($clients->count())
    <div class="row g-4">
        @foreach($clients as $client)
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover shadow-lg">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><i class="bi bi-person-circle me-2"></i>{{ $client->nome }}</h5>
                        @if($client->email)
                            <p class="card-text text-light mb-3"><i class="bi bi-envelope me-2"></i>{{ $client->email }}</p>
                        @endif
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('payments.create', $client->id) }}" class="btn btn-sm btn-primary fw-bold btn-hover">
                                <i class="bi bi-cash-stack me-1"></i> Criar
                            </a>
                            <a href="{{ route('clients.payments.history', $client->id) }}" class="btn btn-sm btn-info fw-bold btn-hover">
                                <i class="bi bi-clock-history me-1"></i> Histórico
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning text-center">Nenhum cliente cadastrado ainda.</div>
@endif
@endsection
