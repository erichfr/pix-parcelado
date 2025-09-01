@extends('layouts.app')

@section('title','Parcelas ' . ucfirst($status))

@section('content')
<h2 class="mb-4 text-center display-6 fw-bold">
    {{ $status == 'pendente' ? 'Parcelas Pendentes' : ($status == 'pago' ? 'Parcelas Pagas' : 'Parcelas Vencidas') }}
</h2>

@if($installments->count())
    <div class="accordion" id="clientsAccordion">
        @foreach($installments->groupBy('payment.client.id') as $clientId => $clientInstallments)
            @php $clientName = $clientInstallments->first()->payment->client->nome; @endphp
            <div class="accordion-item mb-3" style="background: linear-gradient(135deg,#1a1a2e,#162447); border-radius:15px;">
                <h2 class="accordion-header" id="heading{{ $clientId }}">
                    <button class="accordion-button collapsed bg-transparent text-white fw-bold" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $clientId }}"
                            aria-expanded="false" aria-controls="collapse{{ $clientId }}"
                            style="border-radius:15px; background-color: transparent; color: #0ff;">
                        {{ $clientName }} <span class="ms-2 badge bg-info">{{ $clientInstallments->count() }} parcelas</span>
                    </button>
                </h2>
                <div id="collapse{{ $clientId }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $clientId }}" data-bs-parent="#clientsAccordion">
                    <div class="accordion-body p-0">
                        <div class="row g-3 m-3">
                            @foreach($clientInstallments as $inst)
                                <div class="col-md-6">
                                    <div class="card card-hover shadow-lg p-3 h-100" style="background: linear-gradient(135deg,#1a1a2e,#162447); border-radius:15px; border: 1px solid #0ff;">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold text-white">Pagamento #{{ $inst->payment->id }}</span>
                                            <span class="badge bg-{{ $inst->status == 'pago' ? 'success' : ($inst->status == 'vencido' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($inst->status) }}
                                            </span>
                                        </div>
                                        <ul class="list-group list-group-flush mb-2">
                                            <li class="list-group-item bg-transparent text-white p-2">
                                                <strong>Parcela:</strong> {{ $inst->numero_parcela }}/{{ $inst->payment->parcelas }}
                                            </li>
                                            <li class="list-group-item bg-transparent text-white p-2">
                                                <strong>Valor:</strong> R$ {{ number_format($inst->valor,2,',','.') }}
                                            </li>
                                            <li class="list-group-item bg-transparent text-white p-2">
                                                <strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($inst->data_vencimento)->format('d/m/Y') }}
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-end mt-auto">
                                            {{-- Botão para abrir modal de pagamento --}}
                                            @if($inst->status == 'pendente')
                                                <button type="button" class="btn btn-sm btn-warning btn-hover" data-bs-toggle="modal" data-bs-target="#payModal{{ $inst->id }}">
                                                    Pagar
                                                </button>
                                            @endif
                                            <a href="{{ route('payments.show', $inst->payment->id) }}" class="btn btn-sm btn-primary btn-hover ms-2">Detalhes</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal de pagamento --}}
                                <div class="modal fade" id="payModal{{ $inst->id }}" tabindex="-1" aria-labelledby="payModalLabel{{ $inst->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="background: linear-gradient(135deg,#1a1a2e,#162447); color:white; border: 2px solid #0ff; box-shadow: 0 0 15px #0ff;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="payModalLabel{{ $inst->id }}">Pagar Parcela #{{ $inst->numero_parcela }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>Escaneie o QR Code abaixo para realizar o pagamento via Pix:</p>
                                                <img src="{{ route('installments.qrcode', $inst->id) }}" alt="QR Code Parcela {{ $inst->numero_parcela }}" class="img-fluid mb-3" style="border:2px solid #0ff; padding:5px;">
                                                <p>Valor: <strong>R$ {{ number_format($inst->valor,2,',','.') }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-hover" data-bs-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning text-center">Não há parcelas com este status.</div>
@endif
@endsection
