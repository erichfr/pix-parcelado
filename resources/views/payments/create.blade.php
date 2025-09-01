@extends('layouts.app')

@section('title','Criar Pagamento')

@section('content')
<h2 class="mb-4 text-center display-6 fw-bold">💳 Criar Pagamento Parcelado</h2>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-hover shadow-lg p-4" style="background: linear-gradient(135deg,#1a1a2e,#162447); color:white; border-radius:15px;">
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="client_id" class="form-select" required>
                        <option value="">Selecione o cliente</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor Total (R$)</label>
                    <input type="number" step="0.01" name="total_amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantidade de Parcelas</label>
                    <input type="number" name="installments" class="form-control" required min="1">
                </div>

                <div class="mb-3">
                    <label class="form-label">Primeira Data de Vencimento</label>
                    <input type="date" name="first_due_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-hover w-100">Criar Pagamento Parcelado</button>
            </form>
        </div>
    </div>
</div>
@endsection
