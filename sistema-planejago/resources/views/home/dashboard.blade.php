@extends('layouts.master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap');
    .font-roboto { font-family: 'Roboto', sans-serif; }
</style>

<div class="p-8 max-w-7xl mx-auto font-roboto">

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8 w-full">
        
        <div>
            <h1 class="text-4xl font-bold text-[#615ACD] mb-2">
                Olá, {{ explode(' ', auth()->user()->name)[0] }}!    
            </h1>
            <p class="text-xl font-bold text-[#2D2A54]">
                Poupar hoje é garantir tranquilidade amanhã.
            </p>
        </div>

        <div class="bg-[#EAEAF6] rounded-xl px-8 py-4 shadow-sm">
            <div class="text-center mb-3">
                <span class="text-sm font-bold text-[#2D2A54]">Acesso Rápido</span>
            </div>

            <div class="flex flex-row items-center justify-center gap-6">
                <button id="btn-abrir-modal-despesa-dash" class="flex items-center gap-2 text-[#2D2A54] hover:text-[#615ACD] transition group">
                    <span class="text-2xl font-black leading-none group-hover:scale-110 transition-transform">+</span>
                    <span class="font-medium text-sm md:text-base">Criar Nova Despesa</span>
                </button>
            
                <button id="btn-abrir-modal-receita-dash" class="flex items-center gap-2 text-[#2D2A54] hover:text-[#615ACD] transition group">
                    <span class="text-2xl font-black leading-none group-hover:scale-110 transition-transform">+</span>
                    <span class="font-medium text-sm md:text-base">Criar Nova Receita</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    
        <div class="bg-[#EAEAF6] rounded-xl p-6 flex flex-col items-center justify-center shadow-sm">
            <h3 class="text-xl font-bold text-[#2D2A54] mb-2">Total a Pagar</h3>
            <p class="text-3xl font-bold text-[#FF6B6B]">R$ {{ number_format($totalDespesas ?? 0, 2, ',', '.') }}</p>
        </div>

        <div class="bg-[#EAEAF6] rounded-xl p-6 flex flex-col items-center justify-center shadow-sm">
            <h3 class="text-xl font-bold text-[#2D2A54] mb-2">Total Receitas</h3>
            <p class="text-3xl font-bold text-[#20C997]">R$ {{ number_format($totalReceitas ?? 0, 2, ',', '.') }}</p>
        </div>

        <div class="bg-[#EAEAF6] rounded-xl p-6 flex flex-col items-center justify-center shadow-sm">
            <h3 class="text-xl font-bold text-[#2D2A54] mb-2">Saldo Atual</h3>
            <p class="text-3xl font-bold text-[#339AF0]">R$ {{ number_format($saldoTotal ?? 0, 2, ',', '.') }}</p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-[#F8F8FF] rounded-xl shadow-sm border border-[#D2D2F3] p-6 flex flex-col items-center">
            
            <div class="bg-[#EAEAF6] text-[#2D2A54] px-6 py-2 rounded-full font-bold text-base mb-4">
                Semestre Atual
            </div>

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
        // Lógica para abrir/fechar os Modais
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

        //Renderização do Gráfico Principal
        const ctxPrincipal = document.getElementById('graficoPrincipal').getContext('2d');
        new Chart(ctxPrincipal, {
            type: 'line',
            data: {
                labels: {!! json_encode($meses) !!},
                datasets: [
                    {
                        label: 'Receitas',
                        data: {!! json_encode($dadosReceitas) !!},
                        borderColor: '#3B82F6', 
                        backgroundColor: '#3B82F6',
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: false,
                        tension: 0
                    },
                    {
                        label: 'Despesas',
                        data: {!! json_encode($dadosDespesas) !!},
                        borderColor: '#EF4444', // rose-500
                        backgroundColor: '#EF4444',
                        borderWidth: 2,
                        fill: false,
                        tension: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'Top', 
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            padding: 20,
                            font: {family: 'Roboto, size: 14'}
                        }
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        //Renderização do Gráfico de Categorias
        const ctxCategorias = document.getElementById('graficoCategorias').getContext('2d');
        new Chart(ctxCategorias, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($labelsCategorias) !!},
                datasets: [{
                    data: {!! json_encode($dadosCategorias) !!},
                    backgroundColor: [
                        '#615ACD', 
                        '#F43F5E', 
                        '#F59E0B', 
                        '#3B82F6', 
                        '#8B5CF6'  
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