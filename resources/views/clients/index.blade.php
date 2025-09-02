@extends('layouts.app')

@section('title','Clientes')

@section('content')
<h2 class="mb-4 text-center display-6 fw-bold">Lista de Clientes</h2>

<div class="row">
    @forelse($clients as $client)
        <div class="col-md-4">
            <div class="card card-hover shadow-lg p-3 mb-3" style="background: linear-gradient(135deg,#1a1a2e,#162447); border-radius:15px;">
                <h5 class="text-white">{{ $client->nome }}</h5>
                <p class="text-white mb-1"><strong>Email:</strong> {{ $client->email ?? '-' }}</p>
                <p class="text-white"><strong>Telefone:</strong> {{ $client->telefone ?? '-' }}</p>
                <div class="d-flex justify-content-between mt-2">
                    <a href="{{ route('payments.create', $client->id) }}" class="btn btn-sm btn-primary btn-hover">Criar Pagamento</a>
                    @php
                        $lastPayment = optional($client->payments)->last();
                    @endphp

                    @if($lastPayment)
                        <a href="{{ route('payments.show', $lastPayment->id) }}"
                        class="btn btn-sm btn-info btn-hover">
                            Detalhes
                        </a>
                    @else
                        <button class="btn btn-sm btn-secondary" disabled title="Nenhum pagamento encontrado">
                            Sem detalhes
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">Nenhum cliente cadastrado ainda.</div>
        </div>
    @endforelse
</div>
@endsection
