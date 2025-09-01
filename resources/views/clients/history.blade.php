@extends('layouts.app')

@section('title','Histórico de Pagamentos')

@section('content')
<h2 class="mb-4 text-center display-6 fw-bold">📜 Histórico - {{ $client->nome }}</h2>

@if($client->payments->count())
    @foreach($client->payments as $payment)
        <div class="card card-hover shadow-lg mb-4">
            <div class="card-body">
                <h5 class="mb-3">Pagamento #{{ $payment->id }} - Total: R$ {{ number_format($payment->valor_total,2,',','.') }} - {{ $payment->parcelas }}x</h5>
                <table class="table table-dark table-hover text-white align-middle">
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
                                    @if($inst->status === 'pendente')
                                        <form action="{{ route('installments.pay', $inst->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success btn-hover">Marcar como Pago</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-warning text-center">Esse cliente ainda não possui pagamentos cadastrados.</div>
@endif
@endsection
