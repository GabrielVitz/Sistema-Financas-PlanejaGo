@extends('shared.layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div id="toast-alerta" class="hidden fixed top-5 right-5 z-50 transform transition-all duration-300 translate-y-[-20px] opacity-0">
    <div class="bg-emerald-600 text-white px-6 py-3.5 rounded-xl shadow-lg flex items-center space-x-3 font-semibold text-sm border border-emerald-500/30">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span id="toast-mensagem"></span>
    </div>
</div>

<div class="container mx-auto p-4 md:p-6 min-h-screen bg-gray-50 text-gray-800">
    <ol class="flex items-center whitespace-nowrap ">
        <li class="inline-flex items-center">
            <a class="flex items-center text-sm text-muted-foreground-1 hover:text-primary-focus focus:outline-hidden focus:text-primary-focus" href="/">
                Home
            </a>
            <svg class="shrink-0 mx-2 size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </li>
        <li class="inline-flex items-center text-sm font-semibold text-foreground truncate" aria-current="page">
            Calculadora
        </li>
    </ol>

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold tracking-tight text-[#615ACD] md:text-4xl">Calculadora</h1>

        <div class="w-full">
            <input type="radio" id="tab-juros" name="abas_calculadora" class="hidden peer/juros">
            <input type="radio" id="tab-comum" name="abas_calculadora" class="hidden peer/comum" checked>

            <div class="bg-gray-200/80 p-1 rounded-xl inline-flex items-center space-x-1 mb-8">
                <label for="tab-comum" class="px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center space-x-2.5 cursor-pointer text-gray-600 hover:text-gray-900 peer-checked/comum:bg-white peer-checked/comum:text-[#2C2966] peer-checked/comum:shadow-sm">
                    <span id="dot-comum" class="w-2 h-2 rounded-full border border-yellow-500 bg-transparent transition-all duration-300"></span>
                    <span>Comum</span>
                </label>
                <label for="tab-juros" class="px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center space-x-2.5 cursor-pointer text-gray-600 hover:text-gray-900 peer-checked/juros:bg-white peer-checked/juros:text-[#2C2966] peer-checked/juros:shadow-sm">
                    <span id="dot-juros" class="w-2 h-2 rounded-full border border-yellow-500 bg-transition-all duration-300"></span>
                    <span>Juros</span>
                </label>
            </div>

            <div class="hidden peer-checked/juros:grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-5 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <h2 class="text-lg font-bold text-[#2C2966] mb-6">Calculadora de Juros</h2>
                    <form onsubmit="event.preventDefault();" class="space-y-4">
                        <div><label class="block text-xs font-bold text-[#2C2966] uppercase mb-1.5">Valor inicial (R$)</label><input type="number" id="valor_inicial" step="0.01" placeholder="Ex: 1000" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#4E44CE] bg-gray-50/50"></div>
                        <div><label class="block text-xs font-bold text-[#2C2966] uppercase mb-1.5">Tipo de Juros</label><select id="tipo_juros" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#4E44CE] bg-white"><option value="simples">Simples</option><option value="composto">Composto</option></select></div>
                        <div><label class="block text-xs font-bold text-[#2C2966] uppercase mb-1.5">Taxa de Juros (%)</label><div class="grid grid-cols-12 gap-2"><input type="number" id="taxa_juros" step="0.01" placeholder="Ex: 2" class="col-span-7 border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#4E44CE] bg-gray-50/50"><select id="tempo_taxa" class="col-span-5 border border-gray-300 rounded-lg px-2 py-2.5 text-sm focus:outline-none focus:border-[#4E44CE] bg-white"><option value="mes">Ao mês</option><option value="ano">Ao ano</option></select></div></div>
                        <div><label class="block text-xs font-bold text-[#2C2966] uppercase mb-1.5">Período de Vigência</label><div class="grid grid-cols-12 gap-2"><input type="number" id="periodo" placeholder="Ex: 12" class="col-span-7 border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#4E44CE] bg-gray-50/50"><select id="tempo_periodo" class="col-span-5 border border-gray-300 rounded-lg px-2 py-2.5 text-sm focus:outline-none focus:border-[#4E44CE] bg-white"><option value="meses">Meses</option><option value="anos">Anos</option></select></div></div>
                        <button type="button" onclick="calcularJuros()" class="w-full bg-[#4E44CE] hover:bg-[#3b33a3] text-white font-semibold py-3 rounded-lg transition duration-200 mt-6 shadow-sm cursor-pointer">Calcular</button>
                    </form>
                </div>
                <div class="lg:col-span-7 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center min-h-[400px]">
                    <div class="text-center max-w-sm w-full">
                        <h3 class="text-sm font-bold text-gray-400 uppercase mb-2">Resultado</h3>
                        <div class="flex items-center justify-center space-x-2 mb-1">
                            <p class="text-2xl font-black text-[#4E44CE]" id="res_valor_final">Valor Final: R$ 0,00</p>
                            
                            <div class="relative inline-block text-left">
                                <button type="button" class="btn-salvar-resultado text-[#4E44CE] hover:text-[#3b33a3] cursor-pointer focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>

                                <div class="menu-dropdown-calculadora absolute right-0 z-40 hidden w-40 mt-2 origin-top-right bg-white border border-gray-100 rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none">
                                    <div class="py-1">
                                        <button type="button" class="btn-calc-despesa block w-full px-4 py-2 text-sm text-left text-gray-700 transition hover:bg-gray-100 hover:text-[#615ACD]">
                                            Nova Despesa
                                        </button>
                                        <button type="button" class="btn-calc-receita block w-full px-4 py-2 text-sm text-left text-gray-700 transition hover:bg-gray-100 hover:text-[#615ACD]">
                                            Nova Receita
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex justify-center space-x-4 text-xs font-semibold text-gray-500 mb-6"><span>Total de Juros: <strong class="text-gray-700" id="res_total_juros">R$ 0,00</strong></span><span>Rendimento: <strong class="text-gray-700" id="res_rendimento">0%</strong></span></div>
                        <div class="h-48 w-full relative mt-4">
                            <canvas id="graficoJuros"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden peer-checked/comum:block max-w-md mx-auto bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-4 text-right min-h-[84px] flex flex-col justify-center">
                    <div id="comum_expressao" class="text-xs text-gray-400 font-medium tracking-wide h-4"></div>
                    <div class="text-3xl font-bold text-[#2C2966] flex items-center justify-end space-x-2">
                        <span id="comum_resultado">0</span>

                        <div class="relative inline-block text-left">
                            <button type="button" class="btn-salvar-resultado text-[#4E44CE] hover:text-[#3b33a3] cursor-pointer focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>

                            <div class="menu-dropdown-calculadora absolute right-0 z-40 hidden w-40 mt-2 origin-top-right bg-white border border-gray-100 rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none">
                                <div class="py-1">
                                    <button type="button" class="btn-calc-despesa block w-full px-4 py-2 text-sm text-left text-gray-700 transition hover:bg-gray-100 hover:text-[#615ACD]">
                                        Nova Despesa
                                    </button>
                                    <button type="button" class="btn-calc-receita block w-full px-4 py-2 text-sm text-left text-gray-700 transition hover:bg-gray-100 hover:text-[#615ACD]">
                                        Nova Receita
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-5 gap-2.5 text-sm font-bold">
                    <button type="button" onclick="addComum('(')" class="p-3 bg-indigo-50/50 text-[#4E44CE] rounded-xl">(</button>
                    <button type="button" onclick="addComum(')')" class="p-3 bg-indigo-50/50 text-[#4E44CE] rounded-xl">)</button>
                    <button type="button" onclick="addComum('**')" class="p-3 bg-indigo-50/50 text-[#4E44CE] rounded-xl">^</button>
                    <button type="button" onclick="addComum('/100')" class="p-3 bg-indigo-50/50 text-[#4E44CE] rounded-xl">%</button>
                    <button type="button" onclick="limparComum()" class="p-3 bg-red-50 text-red-500 rounded-xl">AC</button>
                    <button type="button" onclick="addComum('7')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">7</button>
                    <button type="button" onclick="addComum('8')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">8</button>
                    <button type="button" onclick="addComum('9')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">9</button>
                    <button type="button" onclick="addComum('/')" class="p-3 bg-indigo-50 text-[#4E44CE] rounded-xl">÷</button>
                    <button type="button" onclick="addComum('*')" class="p-3 bg-indigo-50 text-[#4E44CE] rounded-xl">×</button>
                    <button type="button" onclick="addComum('4')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">4</button>
                    <button type="button" onclick="addComum('5')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">5</button>
                    <button type="button" onclick="addComum('6')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">6</button>
                    <button type="button" onclick="addComum('-')" class="p-3 bg-indigo-50 text-[#4E44CE] rounded-xl">-</button>
                    <button type="button" class="p-3 bg-indigo-50/50 text-gray-300 rounded-xl cursor-not-allowed">√</button>
                    <button type="button" onclick="addComum('1')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">1</button>
                    <button type="button" onclick="addComum('2')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">2</button>
                    <button type="button" onclick="addComum('3')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">3</button>
                    <button type="button" onclick="addComum('+')" class="p-3 bg-indigo-50 text-[#4E44CE] rounded-xl">+</button>
                    <button type="button" onclick="calcularComum()" class="p-3 bg-[#4E44CE] text-white rounded-xl row-span-2">=</button>
                    <button type="button" onclick="addComum('0')" class="col-span-2 p-3 bg-gray-50 text-gray-700 rounded-xl">0</button>
                    <button type="button" onclick="addComum('.')" class="p-3 bg-gray-50 text-gray-700 rounded-xl">.</button>
                    <button type="button" class="p-3 bg-indigo-50/50 text-gray-300 rounded-xl cursor-not-allowed">log</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="modalDespesa" class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full relative border border-gray-100">
            <button type="button" onclick="fecharModal('modalDespesa')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold text-xl cursor-pointer">&times;</button>
            <h3 class="text-center text-[#4E44CE] font-bold text-lg mb-5">Nova Despesa</h3>
            <form onsubmit="event.preventDefault();" class="space-y-4 text-xs font-semibold text-gray-500">
                <div><label class="block mb-1">Descrição</label><input type="text" placeholder="Ex: Investimento Inicial" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 font-normal focus:outline-none"></div>
                <div class="grid grid-cols-2 gap-3">
                    <div><label class="block mb-1">Valor</label><input type="text" id="modal_despesa_valor" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 font-normal bg-gray-50"></div>
                    <div><label class="block mb-1">Status</label><select class="w-full border border-gray-300 rounded-lg px-2 py-2 text-gray-700 font-normal bg-white"><option>Pago</option><option>Pendente</option></select></div>
                </div>
                <button type="button" onclick="mostrarToastPersonalizado('modalDespesa', 'Despesa adicionada com sucesso!')" class="w-full bg-[#008744] hover:bg-[#007038] text-white font-bold py-2.5 rounded-lg mt-2 transition text-sm cursor-pointer">Salvar</button>
            </form>
        </div>
    </div>

    <div id="modalReceita" class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full relative border border-gray-100">
            <button type="button" onclick="fecharModal('modalReceita')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold text-xl cursor-pointer">&times;</button>
            <h3 class="text-center text-[#4E44CE] font-bold text-lg mb-5">Nova Receita</h3>
            <form onsubmit="event.preventDefault();" class="space-y-4 text-xs font-semibold text-gray-500">
                <div><label class="block mb-1">Descrição</label><input type="text" placeholder="Ex: Rendimento Poupança" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 font-normal"></div>
                <div class="grid grid-cols-2 gap-3">
                    <div><label class="block mb-1">Valor</label><input type="text" id="modal_receita_valor" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-700 font-normal bg-gray-50"></div>
                    <div><label class="block mb-1">Data</label><input type="date" class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-gray-700 font-normal"></div>
                </div>
                <button type="button" onclick="mostrarToastPersonalizado('modalReceita', 'Receita adicionada com sucesso!')" class="w-full bg-[#008744] hover:bg-[#007038] text-white font-bold py-2.5 rounded-lg mt-2 transition text-sm cursor-pointer">Salvar</button>
            </form>
        </div>
    </div>
</div>

<div id="container-modal-receita" class="hidden">
    @include('lancamentos.modais.criarReceita')
</div>

<div id="container-modal-despesa" class="hidden">
    @include('lancamentos.modais.criarDespesa')
</div>

<script type="module">

    $(document).ready(function () {
        
        // 1. Abre e fecha o dropdown da calculadora ao clicar no botão de +
        $('.btn-salvar-resultado').on('click', function (event) {
            event.stopPropagation();
            $('.menu-dropdown-calculadora').not($(this).siblings('.menu-dropdown-calculadora')).addClass('hidden');
            $(this).siblings('.menu-dropdown-calculadora').toggleClass('hidden');
        });

        // 2. Esconde o dropdown se o usuário clicar em qualquer outro lugar da página
        $(document).on('click', function (event) {
            if (!$(event.target).closest('.btn-salvar-resultado').length &&
                !$(event.target).closest('.menu-dropdown-calculadora').length) {
                $('.menu-dropdown-calculadora').addClass('hidden');
            }
        });

        function obterValorCalculado(botaoClicado) {
            let textoValor = "";
            
            if ($(botaoClicado).closest('.peer-checked\\/comum\\:block').length > 0) {
                textoValor = $('#comum_resultado').text().trim();
            } else {
                textoValor = $('#res_valor_final').text().trim();
            }

            return textoValor
                .replace('Valor Final: R$ ', '') 
                .replace(/\./g, '')              
                .replace(',', '.')               
                .trim();
        }

        // 3. Clique em "Nova Despesa"
        $(document).on('click', '.btn-calc-despesa', function () {
            $('.menu-dropdown-calculadora').addClass('hidden');   
            $('#container-modal-despesa').removeClass('hidden');  
            
            let valorLimpo = obterValorCalculado(this);
            $('#container-modal-despesa #valor').val(valorLimpo); 
            $('#container-modal-despesa #descricao').val('Despesa Calculadora');
        });

        // 4. Clique em "Nova Receita"
        $(document).on('click', '.btn-calc-receita', function () {
            $('.menu-dropdown-calculadora').addClass('hidden');   
            $('#container-modal-receita').removeClass('hidden');  
            
            let valorLimpo = obterValorCalculado(this);
            $('#container-modal-receita #valor_receita').val(valorLimpo); 
            $('#container-modal-receita #descricao_receita').val('Rendimento Calculadora'); 
        });

        $(document).on('click', '#btn-fechar-modal', function () {
            $('#container-modal-despesa').addClass('hidden');
        });

        $(document).on('click', '#btn-fechar-modal-receita', function () {
            $('#container-modal-receita').addClass('hidden');
        });
    })


    let historicoCalculos =[];
    let meuGrafico = null;
    let expressaoComum = '';
    let calculoRealizado = false;

    function abrirModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function fecharModal(id) { document.getElementById(id).classList.add('hidden'); }

    function mostrarToastPersonalizado(modalId, mensagem, tipo = 'sucesso') {
    fecharModal(modalId);
    const toast = document.getElementById('toast-alerta');
    const toastMsg = document.getElementById('toast-mensagem');
    const toastDiv = toast.querySelector('div');

    // MUDANÇA: Forçamos a cor via estilo inline para garantir que mude
    if (tipo === 'erro') {
        toastDiv.style.backgroundColor = '#dc2626'; // Vermelho
        toastDiv.style.borderColor = '#991b1b';     // Borda vermelha escura
    } else {
        toastDiv.style.backgroundColor = '#059669'; // Verde original
        toastDiv.style.borderColor = '#065f46';     // Borda verde original
    }

    toastMsg.innerText = mensagem;
    toast.classList.remove('hidden');
    
    setTimeout(() => {
        toast.classList.remove('translate-y-[-20px]', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
    }, 10);

    setTimeout(() => {
        toast.classList.remove('translate-y-0', 'opacity-100');
        toast.classList.add('translate-y-[-20px]', 'opacity-0');
        setTimeout(() => { toast.classList.add('hidden'); }, 300);
    }, 3000);
}
    
    

    function calcularJuros() {
        const C = parseFloat(document.getElementById('valor_inicial').value) || 0;
        let i = parseFloat(document.getElementById('taxa_juros').value) || 0;
        let t = parseFloat(document.getElementById('periodo').value) || 0;
        const tipoJuros = document.getElementById('tipo_juros').value;
        const tempoTaxa = document.getElementById('tempo_taxa').value;
        const tempoPeriodo = document.getElementById('tempo_periodo').value;

        if (C <= 0 || i <= 0 || t <= 0) {
            mostrarToastPersonalizado('toast-alerta', 'Por favor, preencha todos os campos com valores maiores que zero.', 'erro');
            return;
        }

        let tempoOriginal = t; 
        if (tempoTaxa === 'mes' && tempoPeriodo === 'anos') t = t * 12;
        else if (tempoTaxa === 'ano' && tempoPeriodo === 'meses') t = t / 12;

        let valorFinal = 0;
        let totalJuros = 0;
        const taxaPercentual = i / 100;

        let labelsGrafico = [];
        let dadosGrafico = [];

        if (tipoJuros === 'simples') {
            totalJuros = C * taxaPercentual * t;
            valorFinal = C + totalJuros;
            for (let j = 0; j <= tempoOriginal; j++) {
                labelsGrafico.push(`${j}º`);
                let tPasso = tempoPeriodo === 'anos' && tempoTaxa === 'mes' ? j * 12 : j;
                if(tempoPeriodo === 'meses' && tempoTaxa === 'ano') tPasso = j / 12;
                dadosGrafico.push(C + (C * taxaPercentual * tPasso));
            }
        } else {
            valorFinal = C * Math.pow((1 + taxaPercentual), t);
            totalJuros = valorFinal - C;
            for (let j = 0; j <= tempoOriginal; j++) {
                labelsGrafico.push(`${j}º`);
                let tPasso = tempoPeriodo === 'anos' && tempoTaxa === 'mes' ? j * 12 : j;
                if(tempoPeriodo === 'meses' && tempoTaxa === 'ano') tPasso = j / 12;
                dadosGrafico.push(C * Math.pow((1 + taxaPercentual), tPasso));
            }
        }

        const formatarMoeda = (valor) => valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        document.getElementById('res_valor_final').innerText = `Valor Final: ${formatarMoeda(valorFinal)}`;
        document.getElementById('res_total_juros').innerText = formatarMoeda(totalJuros);
        document.getElementById('res_rendimento').innerText = `${((totalJuros / C) * 100).toFixed(1)}%`;
        document.getElementById('modal_despesa_valor').value = formatarMoeda(valorFinal);

        const ctx = document.getElementById('graficoJuros').getContext('2d');
        if (meuGrafico) meuGrafico.destroy();
        meuGrafico = new Chart(ctx, {
            type: 'line',
            data: { labels: labelsGrafico, datasets: [{ label: 'Evolução do Patrimônio', data: dadosGrafico, borderColor: '#4E44CE', backgroundColor: 'rgba(78, 68, 206, 0.1)', borderWidth: 3, fill: true, tension: 0.3, pointBackgroundColor: '#4E44CE' }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { grid: { color: '#E5E7EB' }, ticks: { callback: (v) => 'R$ ' + v.toFixed(0) } }, x: { grid: { display: false } } } }
        });
        historicoCalculos.push({
        label: `Cálculo ${historicoCalculos.length + 1}`,
        valor: valorFinal
    });
    atualizarGraficoHistorico();
        document.getElementById('valor_inicial').value = '';
        document.getElementById('taxa_juros').value = '';
        document.getElementById('periodo').value = '';
    }

    function addComum(caractere) {
        if (calculoRealizado && /[0-9.]/.test(caractere)) {
            expressaoComum = caractere;
            calculoRealizado = false;
        } else if (calculoRealizado && /[\+\-\*\/\(\)]/.test(caractere)) {
            expressaoComum += caractere;
            calculoRealizado = false;
        } else if (calculoRealizado && caractere === '**') {
            expressaoComum += caractere;
            calculoRealizado = false;
        } else if (calculoRealizado && caractere === '/100') {
            expressaoComum += caractere;
            calculoRealizado = false;
        } else


        
        expressaoComum += caractere;
        document.getElementById('comum_expressao').innerText = expressaoComum.replace(/\*\*/g, '^');
    }

    function limparComum() {
        expressaoComum = '';
        calculoRealizado = false;
        document.getElementById('comum_expressao').innerText = '';
        document.getElementById('comum_resultado').innerText = '0';
    }

    function calcularComum() {
        try {
            if (!expressaoComum || /[\+\-\*\/]$/.test(expressaoComum)) return;
            const resultado = eval(expressaoComum);
            if (resultado === undefined || isNaN(resultado)) return;
            document.getElementById('comum_resultado').innerText = resultado;
            document.getElementById('modal_receita_valor').value = resultado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            expressaoComum = resultado.toString();
            calculoRealizado = true;
        } catch (error) {
            document.getElementById('comum_resultado').innerText = 'Erro';
            expressaoComum = '';
        }
    }

    document.addEventListener('keydown', function(event) {
        if (!document.getElementById('tab-comum').checked) return;
        if (['INPUT', 'SELECT', 'TEXTAREA'].includes(event.target.tagName)) return;
        const key = event.key;
        if (/[0-9]/.test(key)) addComum(key);
        else if (['+', '-', '.', '(', ')'].includes(key)) addComum(key);
        else if (key === '*') addComum('*');
        else if (key === '/') addComum('/');
        else if (key === '^') addComum('**');
        else if (key === '%') addComum('/100');
        else if (key === 'Enter' || key === '=') { event.preventDefault(); calcularComum(); }
        else if (key === 'Backspace' || key === 'Escape' || key.toLowerCase() === 'c') limparComum();
    });

    document.getElementById('tab-juros').addEventListener('change', gerenciarBolinhas);
    document.getElementById('tab-comum').addEventListener('change', gerenciarBolinhas);

    function gerenciarBolinhas() {
        const dotJuros = document.getElementById('dot-juros');
        const dotComum = document.getElementById('dot-comum');
        if (document.getElementById('tab-juros').checked) {
            dotJuros.classList.add('bg-yellow-400');
            dotComum.classList.remove('bg-yellow-400');
        } else {
            dotComum.classList.add('bg-yellow-400');
            dotJuros.classList.remove('bg-yellow-400');
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        gerenciarBolinhas();
        const ctx = document.getElementById('graficoJuros').getContext('2d');
        meuGrafico = new Chart(ctx, {
            type: 'line',
            data: { labels: ['Início', 'Fim'], datasets: [{ data: [0, 0], borderColor: '#4E44CE', borderWidth: 2, fill: false }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    });
    function atualizarGraficoHistorico() {
    const ctx = document.getElementById('graficoJuros').getContext('2d');
    if (meuGrafico) meuGrafico.destroy();
    
    meuGrafico = new Chart(ctx, {
        type: 'bar', // Tipo barra para comparar vários cálculos
        data: {
            labels: historicoCalculos.map(h => h.label),
            datasets: [{
                label: 'Resultados',
                data: historicoCalculos.map(h => h.valor),
                backgroundColor: '#4E44CE'
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false 
        }
    });
}
    window.addComum = addComum;
    window.limparComum = limparComum;
    window.calcularComum = calcularComum;
    window.calcularJuros = calcularJuros;
    window.fecharModal = fecharModal;
    window.abrirModal = abrirModal;
    window.mostrarToastPersonalizado = mostrarToastPersonalizado;


</script>
@endsection