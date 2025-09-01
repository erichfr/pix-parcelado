@extends('layouts.app')

@section('title','Detalhes do Pagamento')

@section('content')
<h2 class="mb-4 text-center display-6 fw-bold">Parcelamento - Cliente: {{ $payment->client->nome }}</h2>

<div class="row g-4">
    @foreach($payment->installments as $inst)
        <div class="col-md-6 col-lg-4">
            <div class="card card-hover shadow-lg p-3 h-100" style="background: linear-gradient(135deg,#1a1a2e,#162447); border-radius:15px; color:white;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold">Parcela {{ $inst->numero_parcela }}/{{ $payment->parcelas }}</span>
                    <span class="badge bg-{{ $inst->status == 'pago' ? 'success' : ($inst->status == 'vencido' ? 'danger' : 'warning') }}">
                        {{ ucfirst($inst->status) }}
                    </span>
                </div>
                <ul class="list-group list-group-flush mb-2">
                    <li class="list-group-item bg-transparent text-white p-2">
                        <strong>Valor:</strong> R$ {{ number_format($inst->valor,2,',','.') }}
                    </li>
                    <li class="list-group-item bg-transparent text-white p-2">
                        <strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($inst->data_vencimento)->format('d/m/Y') }}
                    </li>
                    <li class="list-group-item bg-transparent text-white p-2 text-center">
                        <strong>PIX:</strong>
                        <p><code>{{ $inst->pix_code }}</code></p>
                        {!! QrCode::size(120)->generate($inst->pix_code) !!}
                    </li>
                </ul>
                @if($inst->status === 'pendente')
                    <form action="{{ route('installments.pay', $inst->id) }}" method="POST" class="mt-2 d-flex justify-content-center">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm w-100">Marcar como Pago</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
