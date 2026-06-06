@extends('layouts.master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="p-8 max-w-7xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#615ACD] tracking-tight">Dashboard</h1>
        <p class="text-gray-600 mt-2 text-sm">Acompanhe seu progresso rumo aos R$ 30.000 da sua moto 0km.</p>
    </div>

    <div class="flex gap-4 mb-8">
        <button id="btn-abrir-modal-receita-dash" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-3 rounded-xl font-medium shadow-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Nova Receita
        </button>

        <button id="btn-abrir-modal-despesa-dash" class="flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white px-5 py-3 rounded-xl font-medium shadow-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
            Nova Despesa
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-[#D2D2F3] p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Receitas vs Despesas ({{ date('Y') }})</h2>
            <div class="relative h-80 w-full">
                <canvas id="graficoPrincipal"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-[#D2D2F3] p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Maiores Despesas</h2>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="graficoCategorias"></canvas>
            </div>
        </div>

    </div>
</div>

<div id="container-modal-receita" class="hidden">
    @include('lancamentos.modais.criarReceita')
</div>
<div id="container-modal-despesa" class="hidden">
    @include('lancamentos.modais.criarDespesa')
</div>

<script>
    $(document).ready(function() {
        // --- 1. Lógica para abrir/fechar os Modais ---
        $('#btn-abrir-modal-receita-dash').on('click', function () {
            $('#container-modal-receita').removeClass('hidden');
        });
        
        $('#btn-abrir-modal-despesa-dash').on('click', function () {
            $('#container-modal-despesa').removeClass('hidden');
        });

        $(document).on('click', '#btn-fechar-modal-receita', function () {
            $('#container-modal-receita').addClass('hidden');
        });

        $(document).on('click', '#btn-fechar-modal', function () {
            $('#container-modal-despesa').addClass('hidden');
        });

        // --- 2. Renderização do Gráfico Principal (Receitas vs Despesas) ---
        const ctxPrincipal = document.getElementById('graficoPrincipal').getContext('2d');
        new Chart(ctxPrincipal, {
            type: 'line',
            data: {
                labels: {!! json_encode($meses) !!},
                datasets: [
                    {
                        label: 'Receitas',
                        data: {!! json_encode($dadosReceitas) !!},
                        borderColor: '#10B981', // emerald-500
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Despesas',
                        data: {!! json_encode($dadosDespesas) !!},
                        borderColor: '#F43F5E', // rose-500
                        backgroundColor: 'rgba(244, 63, 94, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // --- 3. Renderização do Gráfico de Categorias (Pizza/Doughnut) ---
        const ctxCategorias = document.getElementById('graficoCategorias').getContext('2d');
        new Chart(ctxCategorias, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($labelsCategorias) !!},
                datasets: [{
                    data: {!! json_encode($dadosCategorias) !!},
                    backgroundColor: [
                        '#615ACD', // Roxo Identidade
                        '#F43F5E', // Vermelho
                        '#F59E0B', // Amarelo
                        '#3B82F6', // Azul
                        '#8B5CF6'  // Violeta
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection