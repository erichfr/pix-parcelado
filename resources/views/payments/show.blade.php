@extends('layouts.app')

@section('title','Detalhes do Pagamento')

@section('content')
<div class="card">
    <div class="card-header">
        Parcelamento - Cliente: {{ $payment->client->nome }}
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <p><strong>Total:</strong> R$ {{ number_format($payment->valor_total,2,',','.') }}</p>
        <p><strong>Parcelas:</strong> {{ $payment->parcelas }}</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Parcela</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                    <th>Status</th>
                    <th>PIX</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payment->installments as $inst)
                    <tr>
                        <td>{{ $inst->numero_parcela }}/{{ $payment->parcelas }}</td>
                        <td>R$ {{ number_format($inst->valor,2,',','.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($inst->data_vencimento)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $inst->status == 'pago' ? 'success' : ($inst->status == 'vencido' ? 'danger' : 'secondary') }}">
                                {{ ucfirst($inst->status) }}
                            </span>
                        </td>
                        <td>
                            <p><code>{{ $inst->pix_code }}</code></p>
                            {!! QrCode::size(120)->generate($inst->pix_code) !!}

                            {{-- botão só aparece se estiver pendente --}}
                            @if($inst->status === 'pendente')
                                <form action="{{ route('installments.pay', $inst->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Marcar como Pago</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
