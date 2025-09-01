@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<h2 class="mb-5 text-center display-6 fw-bold">📊 Dashboard PIX Parcelado</h2>

<div class="row g-4">
    {{-- Total de Clientes --}}
    <div class="col-md-3">
        <div class="card card-hover shadow-lg text-center p-3">
            <h5><i class="bi bi-people-fill me-2"></i>Total de Clientes</h5>
            <h2 class="fw-bold">{{ $totalClients }}</h2>
            <div class="progress mt-2" style="height:10px; border-radius:5px; background-color:#111;">
                <div class="progress-bar bg-info" role="progressbar"
                     style="width: 100%"
                     aria-valuenow="{{ $totalClients }}" aria-valuemin="0" aria-valuemax="{{ $totalClients }}">
                </div>
            </div>
            <a href="{{ route('home') }}" class="btn btn-sm btn-info btn-hover mt-2">
                Ver Clientes
            </a>
        </div>
    </div>

    {{-- Parcela Pendentes --}}
    <div class="col-md-3">
        <div class="card card-hover shadow-lg text-center p-3">
            <h5><i class="bi bi-card-checklist me-2"></i>Parcelas Pendentes</h5>
            <h2 class="fw-bold">{{ $pending }}</h2>
            <div class="progress mt-2" style="height:10px; border-radius:5px; background-color:#111;">
                <div class="progress-bar bg-warning" role="progressbar"
                     style="width: {{ $totalInstallments > 0 ? ($pending/$totalInstallments*100) : 0 }}%"
                     aria-valuenow="{{ $pending }}" aria-valuemin="0" aria-valuemax="{{ $totalInstallments }}">
                </div>
            </div>
            <a href="{{ route('installments.status','pendente') }}" class="btn btn-sm btn-warning btn-hover mt-2">
                Ver Pendentes
            </a>
        </div>
    </div>

    {{-- Parcela Pagas --}}
    <div class="col-md-3">
        <div class="card card-hover shadow-lg text-center p-3">
            <h5><i class="bi bi-check2-circle me-2"></i>Parcelas Pagas</h5>
            <h2 class="fw-bold">{{ $paid }}</h2>
            <div class="progress mt-2" style="height:10px; border-radius:5px; background-color:#111;">
                <div class="progress-bar bg-success" role="progressbar"
                     style="width: {{ $totalInstallments > 0 ? ($paid/$totalInstallments*100) : 0 }}%"
                     aria-valuenow="{{ $paid }}" aria-valuemin="0" aria-valuemax="{{ $totalInstallments }}">
                </div>
            </div>
            <a href="{{ route('installments.status','pago') }}" class="btn btn-sm btn-success btn-hover mt-2">
                Ver Pagas
            </a>
        </div>
    </div>

    {{-- Parcelas Vencidas --}}
    <div class="col-md-3">
        <div class="card card-hover shadow-lg text-center p-3">
            <h5><i class="bi bi-exclamation-circle me-2"></i>Parcelas Vencidas</h5>
            <h2 class="fw-bold">{{ $overdue }}</h2>
            <div class="progress mt-2" style="height:10px; border-radius:5px; background-color:#111;">
                <div class="progress-bar bg-danger" role="progressbar"
                     style="width: {{ $totalInstallments > 0 ? ($overdue/$totalInstallments*100) : 0 }}%"
                     aria-valuenow="{{ $overdue }}" aria-valuemin="0" aria-valuemax="{{ $totalInstallments }}">
                </div>
            </div>
            <a href="{{ route('installments.status','vencido') }}" class="btn btn-sm btn-danger btn-hover mt-2">
                Ver Vencidas
            </a>
        </div>
    </div>
</div>

{{-- Gráfico de Parcelas --}}
<div class="card card-hover shadow-lg mt-5 p-3">
    <h5 class="mb-3"><i class="bi bi-bar-chart-fill me-2"></i>Status das Parcelas</h5>
    <canvas id="installmentsChart" height="150"></canvas>
</div>

{{-- Links rápidos para histórico e agendamento --}}
<div class="row g-4 mt-4">
    <div class="col-md-6">
        <a href="{{ route('home') }}" class="card card-hover shadow-lg p-4 text-center text-white text-decoration-none">
            <h4><i class="bi bi-clock-history me-2"></i> Histórico Completo</h4>
            <p>Visualize todos os pagamentos e parcelas de cada cliente.</p>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('payments.create') }}" class="card card-hover shadow-lg p-4 text-center text-white text-decoration-none">
            <h4><i class="bi bi-cash-stack me-2"></i> Criar Pagamento</h4>
            <p>Agende novos pagamentos parcelados com PIX para qualquer cliente.</p>
        </a>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('installmentsChart').getContext('2d');
    const gradientPending = ctx.createLinearGradient(0, 0, 0, 400);
    gradientPending.addColorStop(0, 'rgba(0,255,255,0.8)');
    gradientPending.addColorStop(1, 'rgba(0,255,255,0.3)');

    const gradientPaid = ctx.createLinearGradient(0, 0, 0, 400);
    gradientPaid.addColorStop(0, 'rgba(0,200,0,0.8)');
    gradientPaid.addColorStop(1, 'rgba(0,200,0,0.3)');

    const gradientOverdue = ctx.createLinearGradient(0, 0, 0, 400);
    gradientOverdue.addColorStop(0, 'rgba(255,0,0,0.8)');
    gradientOverdue.addColorStop(1, 'rgba(255,0,0,0.3)');

    const installmentsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pendentes', 'Pagas', 'Vencidas'],
            datasets: [{
                label: 'Parcelas',
                data: [{{ $pending }}, {{ $paid }}, {{ $overdue }}],
                backgroundColor: [gradientPending, gradientPaid, gradientOverdue],
                borderRadius: 10,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1500,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#0ff', font: { weight: 'bold', size: 14 } },
                    grid: { color: 'rgba(0,255,255,0.1)' }
                },
                x: {
                    ticks: { color: '#0ff', font: { weight: 'bold', size: 14 } },
                    grid: { color: 'rgba(0,255,255,0.1)' }
                }
            }
        }
    });
</script>
@endsection
