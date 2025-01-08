@extends('layouts.admin')

@section('header')
    <h2 class="fs-4">Dashboard</h2>
@endsection

@section('content')
    {{-- Gráfico de Visitas --}}
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Visitas ao perfil</div>
                <div class="card-body">
                    <canvas id="views" style="max-width: calc(100%); height: 300px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        {{-- Coluna 1 --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Links mais clicados</div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto">
                    <ul class="list-group">
                        @foreach ($links as $link)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $link->title }}
                                <span class="badge bg-primary rounded-pill">{{ sizeof($link->clicks) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/chart.js') }}"></script>

    <script>
        const ctx = document.getElementById('views').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'Acessos',
                    data: @json($chartData['data']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Dias',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Acessos',
                        },
                    },
                },
            }
        });
    </script>
@endpush
