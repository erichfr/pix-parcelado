@extends('layouts.app')

@section('title','Criar Pagamento')

@section('content')
<h2 class="mb-4 text-center display-6 fw-bold">💰 Criar Pagamento</h2>

<div class="card card-hover shadow-lg mx-auto" style="max-width:600px;">
    <div class="card-body">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Cliente</label>
                <select name="client_id" class="form-control">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" @if(isset($selectedClient) && $selectedClient == $client->id) selected @endif>
                            {{ $client->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Valor Total (R$)</label>
                <input type="number" step="0.01" name="valor_total" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Parcelas</label>
                <input type="number" name="parcelas" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-hover w-100 fw-bold">
                <i class="bi bi-cash-stack me-1"></i> Criar Pagamento
            </button>
        </form>
    </div>
</div>
@endsection
