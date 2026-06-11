@extends('layouts.master')

@section('content')

<div class="flex flex-col w-full h-full">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="container mx-auto mt-6 px-6 pb-10">

    <ol class="flex items-center whitespace-nowrap mb-2">
        <li class="inline-flex items-center">
            <a class="flex items-center text-sm text-gray-500 hover:text-[#615ACD] transition-colors" href="/">
                Home
            </a>
            <svg class="shrink-0 mx-2 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </li>
        <li class="inline-flex items-center text-sm font-semibold text-[#615ACD]" aria-current="page">
            Relatórios
        </li>
    </ol>

    <h2 class="text-3xl font-bold tracking-tight text-[#615ACD] md:text-4xl pb-4">Relatórios</h2>

    <form action="{{ route('relatorio.index') }}" method="GET"
          class="flex w-full h-fit gap-4 bg-[#E5E5F6] p-4 rounded-xl items-end flex-wrap md:flex-nowrap mb-8">

        <div class="w-full">
            <label for="periodo" class="block mb-1.5 text-sm font-medium text-gray-700">Período</label>
            <select id="periodo" name="periodo"
                    class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]">
                <option value="" disabled {{ !request('periodo') ? 'selected' : '' }}>Selecione</option>
                <option value="hoje"   {{ request('periodo') == 'hoje'  ? 'selected' : '' }}>Hoje</option>
                <option value="semana" {{ request('periodo') == 'semana'? 'selected' : '' }}>Esta semana</option>
                <option value="mes"    {{ request('periodo') == 'mes'   ? 'selected' : '' }}>Este mês</option>
            </select>
        </div>

        <div class="w-full">
            <label for="tipo_lancamento_id" class="block mb-1.5 text-sm font-medium text-gray-700">Tipo de Lançamento</label>
            <select id="tipo_lancamento_id" name="tipo_lancamento_id"
                    class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]">
                <option value="" disabled {{ !request('tipo_lancamento_id') ? 'selected' : '' }}>Selecione</option>
                @foreach($tipo_lancamentos as $tipoL)
                    <option value="{{ $tipoL->id }}" {{ request('tipo_lancamento_id') == $tipoL->id ? 'selected' : '' }}>
                        {{ $tipoL->titulo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full">
            <label for="categoria_id" class="block mb-1.5 text-sm font-medium text-gray-700">Categoria</label>
            <select id="categoria_id" name="categoria_id"
                    class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]">
                <option value="">Todas</option> 
                @foreach($categorias as $c)
                        <option value="{{ $c->id }}" {{ request('categoria_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->titulo }}
                        </option>
                @endforeach
            </select>
        </div>

        <div class="w-full">
            <label for="status_pago" class="block mb-1.5 text-sm font-medium text-gray-700">Status</label>
            <select id="status_pago" name="status_pago"
                    class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]">
                <option value="">Todos</option>
                <option value="1" {{ request('status_pago') == '1' ? 'selected' : '' }}>Paga</option>
                <option value="0" {{ request('status_pago') == '0' ? 'selected' : '' }}>Não Paga</option>
            </select>
        </div>

        <div class="flex justify-center h-fit shrink-0">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-[#5B51D8] hover:bg-[#4A40C5] text-white font-semibold px-6 py-2.5 rounded-xl shadow-md transition duration-200 ease-in-out hover:-translate-y-0.5 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                Gerar
            </button>
        </div>

    </form>

    @if(request()->hasAny(['periodo', 'tipo_lancamento_id', 'categoria_id', 'status_pago']))

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white rounded-xl border border-[#E5E5F6] p-4 flex flex-col gap-1">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total de Lançamentos</span>
            <span class="text-2xl font-bold text-[#615ACD]">{{ $lancamentosFiltrados->count() }}</span>
        </div>

        <div class="bg-white rounded-xl border border-[#E5E5F6] p-4 flex flex-col gap-1">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Valor Total</span>
            <span class="text-2xl font-bold text-[#615ACD]">
                R$ {{ number_format($lancamentosFiltrados->sum('valor'), 2, ',', '.') }}
            </span>
        </div>

        <div class="bg-white rounded-xl border border-[#E5E5F6] p-4 flex flex-col gap-1">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pagas</span>
            <span class="text-2xl font-bold text-emerald-500">
                {{ $lancamentosFiltrados->where('status_pago', 1)->count() }}
            </span>
        </div>

        <div class="bg-white rounded-xl border border-[#E5E5F6] p-4 flex flex-col gap-1">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Não Pagas</span>
            <span class="text-2xl font-bold text-red-500">
                {{ $lancamentosFiltrados->where('status_pago', 0)->count() }}
            </span>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white rounded-xl border border-[#E5E5F6] p-5">
            <h3 class="text-base font-semibold text-gray-700 mb-4">Despesas ao Longo da Semana</h3>
            <div id="chart-linha"></div>
        </div>

        <div class="bg-white rounded-xl border border-[#E5E5F6] p-5">
            <h3 class="text-base font-semibold text-gray-700 mb-4">Despesas por Categoria</h3>
            <div id="chart-pizza"></div>
        </div>

    </div>

    <div class="bg-white rounded-xl border border-[#E5E5F6] p-5 mb-8">
        <h3 class="text-base font-semibold text-gray-700 mb-4">Comparativo: Pagas vs Não Pagas</h3>
        <div id="chart-barras"></div>
    </div>

    <div class="bg-white rounded-xl border border-[#E5E5F6] overflow-hidden">
        <div class="px-5 py-4 border-b border-[#E5E5F6] flex items-center justify-between">
            <h3 class="text-base font-semibold text-gray-700">Despesas desse Período</h3>
            <span class="text-sm text-gray-400">{{ $lancamentosFiltrados->count() }} registro(s)</span>
        </div>

        @if($lancamentosFiltrados->isEmpty())
            <div class="px-5 py-10 text-center text-gray-400 text-sm">
                Nenhum lançamento encontrado para o período selecionado.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-[#F5F5FB] text-xs text-gray-500 uppercase tracking-wide">
                        <tr>
                            <th class="px-5 py-3">Descrição</th>
                            <th class="px-5 py-3">Categoria</th>
                            <th class="px-5 py-3">Valor</th>
                            <th class="px-5 py-3">Data</th>
                            <th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#F0F0FA]">
                        @foreach($lancamentosFiltrados as $lancamento)
                        <tr class="hover:bg-[#FAFAFF] transition-colors">
                            <td class="px-5 py-3 font-medium text-gray-800">{{ $lancamento->descricao }}</td>
                            <td class="px-5 py-3 text-gray-500">
                                {{ $categorias->where('id', $lancamento->categoria_id)->first()->titulo ?? '—' }}
                            </td>
                            <td class="px-5 py-3 font-semibold text-[#615ACD]">
                                R$ {{ number_format($lancamento->valor, 2, ',', '.') }}
                            </td>
                            <td class="px-5 py-3 text-gray-500">
                                {{ \Carbon\Carbon::parse($lancamento->data_criacao)->format('d/m/Y') }}
                            </td>
                            <td class="px-5 py-3">
                                @if($lancamento->status_pago)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                        Paga
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-600">
                                        Não Paga
                                    </span>
                                @endif
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @else

    <div class="flex flex-col items-center justify-center py-20 text-center">
        <div class="w-16 h-16 rounded-2xl bg-[#E5E5F6] flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-[#615ACD]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </div>
        <p class="text-gray-500 text-sm">Selecione os filtros acima e clique em <strong class="text-[#615ACD]">Gerar</strong> para visualizar o relatório.</p>
    </div>
    @endif

</div>
</div>

@if(request()->hasAny(['periodo', 'tipo_lancamento_id', 'categoria_id', 'status_pago']))
<script>
    const valoresLinha = @json($graficoLinhaSeries);

    //grafico pontos
    new ApexCharts(document.querySelector("#chart-linha"), {
        chart: {
            type: 'line',
            height: 280,
            toolbar: { show: false },
            fontFamily: 'inherit',
            animations: { enabled: true, speed: 600 }
        },
        series: [{ name: 'Despesas (R$)', data: valoresLinha }],
        xaxis: {
            categories: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
            labels: { style: { colors: '#9CA3AF', fontSize: '12px' } },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: { colors: '#9CA3AF', fontSize: '12px' },
                formatter: v => 'R$ ' + v.toFixed(0)
            }
        },
        stroke: { curve: 'smooth', width: 3 },
        colors: ['#FF3B30'],
        markers: { size: 5, strokeWidth: 2, strokeColors: '#fff', hover: { size: 7 } },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.3,
                opacityFrom: 0.15,
                opacityTo: 0.01,
                stops: [0, 100]
            }
        },
        grid: { borderColor: '#F3F4F6', strokeDashArray: 4 },
        tooltip: {
            y: { formatter: v => 'R$ ' + v.toFixed(2).replace('.', ',') }
        },
        noData: {
            text: 'Nenhum dado para este período',
            align: 'center',
            verticalAlign: 'middle',
            style: { color: '#9CA3AF', fontSize: '13px' }
        }
    }).render();

    // grafico pizza
    const labelsPizza  = @json($graficoPizzaLabels);
    const valoresPizza = @json($graficoPizzaSeries);

    new ApexCharts(document.querySelector("#chart-pizza"), {
        chart: {
            type: 'donut',
            height: 280,
            fontFamily: 'inherit',
            animations: { enabled: true, speed: 600 }
        },
        series: valoresPizza,
        labels: labelsPizza,
        colors: ['#5B51D8', '#FFB347', '#FF3B30', '#34C759', '#32ADE6', '#AF52DE'],
        legend: {
            position: 'bottom',
            fontSize: '13px',
            labels: { colors: '#6B7280' }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '65%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '13px',
                            color: '#9CA3AF',
                            formatter: w => {
                                const sum = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                return 'R$ ' + sum.toFixed(2).replace('.', ',');
                            }
                        }
                    }
                }
            }
        },
        tooltip: {
            y: { formatter: v => 'R$ ' + v.toFixed(2).replace('.', ',') }
        },
        noData: {
            text: 'Nenhum dado encontrado',
            align: 'center',
            verticalAlign: 'middle',
            style: { color: '#9CA3AF', fontSize: '13px' }
        }
    }).render();

    // grafico barras
    const totalPagas    = {{ $lancamentosFiltrados->where('status_pago', 1)->sum('valor') }};
    const totalNaoPagas = {{ $lancamentosFiltrados->where('status_pago', 0)->sum('valor') }};

    new ApexCharts(document.querySelector("#chart-barras"), {
        chart: {
            type: 'bar',
            height: 220,
            toolbar: { show: false },
            fontFamily: 'inherit',
            animations: { enabled: true, speed: 600 }
        },
        series: [
            { name: 'Paga', data: [totalPagas] },
            { name: 'Não Paga', data: [totalNaoPagas] }
        ],
        xaxis: {
            categories: ['Lançamentos'],
            labels: { style: { colors: '#9CA3AF', fontSize: '12px' } },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: { colors: '#9CA3AF', fontSize: '12px' },
                formatter: v => 'R$ ' + v.toFixed(0)
            }
        },
        colors: ['#34C759', '#FF3B30'],
        plotOptions: {
            bar: { horizontal: false, columnWidth: '40%', borderRadius: 6 }
        },
        dataLabels: {
            enabled: true,
            formatter: v => 'R$ ' + v.toFixed(2).replace('.', ','),
            style: { fontSize: '12px', colors: ['#fff'] }
        },
        grid: { borderColor: '#F3F4F6', strokeDashArray: 4 },
        legend: {
            position: 'top',
            fontSize: '13px',
            labels: { colors: '#6B7280' }
        },
        tooltip: {
            y: { formatter: v => 'R$ ' + v.toFixed(2).replace('.', ',') }
        }
    }).render();
</script>
@endif

@endsection