@extends('layouts.master')

@section('content')

    @if (session('sucesso'))
        <div id="alerta-sucesso" class="flex items-center p-4 mb-4 text-sm text-emerald-800 border border-emerald-300 rounded-lg bg-emerald-50" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Sucesso</span>
            <div>
                <span class="font-medium">Tudo certo!</span> {{ session('sucesso') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alerta-sucesso" aria-label="Close" onclick="document.getElementById('alerta-sucesso').style.display='none'">
                <span class="sr-only">Fechar</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        <script type="module">
            $(document).ready(function(){
                $('#alerta-sucesso').delay(4000).fadeOut(500, function() {
                    $(this).remove();
                });
            });
        </script>

    @endif


    <div class="flex gap-4 items-center">
        @auth
            <form action="{{ route('login.destroy') }}" method="POST">
                @csrf
                {{-- <button type="submit" class="bg-red-400 text-white p-2 border rounded-sm">Sair</button> --}}
            </form>
        @endauth
    </div>

    <div class="container mx-auto mt-6 px-6">
        <ol class="flex items-center whitespace-nowrap ">
            <li class="inline-flex items-center">
                <a class="flex items-center text-sm text-muted-foreground-1 hover:text-primary-focus focus:outline-hidden focus:text-primary-focus" href="/">
                Home
                </a>
                <svg class="shrink-0 mx-2 size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </li>
            <li class="inline-flex items-center text-sm font-semibold text-foreground truncate" aria-current="page">
                Lançamentos
            </li>
        </ol>

        <div class="flex items-center gap-2">
            <h2 class="text-3xl font-bold tracking-tight text-[#615ACD] md:text-4xl">Lançamentos</h2>

            <div class="relative inline-block text-left">
                <button type="button" id="btn-dropdown-lancamento" class="flex items-center focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-[#615ACD] hover:text-[#FFA051] transition-colors cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>

                <div id="menu-dropdown-lancamento" class="absolute left-0 z-40 hidden w-40 mt-2 origin-top-left bg-white border border-gray-100 rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none">
                    <div class="py-1">
                        <button type="button" id="btn-abrir-modal-despesa" class="block w-full px-4 py-2 text-sm text-left text-gray-700 transition hover:bg-gray-100 hover:text-[#615ACD]">
                            Nova Despesa
                        </button>
                        <button type="button" id="btn-abrir-modal-receita" class="block w-full px-4 py-2 text-sm text-left text-gray-700 transition hover:bg-gray-100 hover:text-[#615ACD]">
                            Nova Receita
                        </button>
                    </div>
                </div>
            </div>
        </div>



    </div>

   <div class="container mx-auto mt-6 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-xl shadow-sm p-6 border border-[#D2D2F3]">
                <h3 class="text-sm font-medium text-gray-500 mb-2 uppercase tracking-wider">Saldo Total</h3>
                <p class="text-3xl font-extrabold {{ ($saldoTotal ?? 0) >= 0 ? 'text-[#615ACD]' : 'text-red-500' }}">
                    R$ {{ number_format($saldoTotal ?? 0, 2, ',', '.') }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-[#D2D2F3]">
                <h3 class="text-sm font-medium text-gray-500 mb-2 uppercase tracking-wider">Receitas</h3>
                <p class="text-3xl font-extrabold text-emerald-500">
                    + R$ {{ number_format($totalReceitas ?? 0, 2, ',', '.') }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-[#D2D2F3]">
                <h3 class="text-sm font-medium text-gray-500 mb-2 uppercase tracking-wider">Despesas</h3>
                <p class="text-3xl font-extrabold text-red-500">
                    - R$ {{ number_format($totalDespesas ?? 0, 2, ',', '.') }}
                </p>
            </div>

        </div>
    </div>

    <div class="container mx-auto mt-6 px-6">

    <div class="flex justify-end w-full">
        <form class="w-full max-w-md">
            <label for="search" class="sr-only">Search</label>
            <div class="relative group">
                <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-600 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="search" class="block w-full py-2.5 px-4 ps-11 text-sm text-gray-900 bg-white border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 placeholder:text-gray-400" placeholder="Pesquisar lançamento...">
            </div>
        </form>
    </div>
</div>

    <div class="container mx-auto mt-6 px-6 w-full">
        <div class="overflow-x-auto w-full rounded-lg shadow-sm">
            <table class="w-full table-auto text-sm md:text-base min-w-[700px]">

            <!--Parte mes-->
            <thead class="bg-[#E5E5F6] text-[#131047]">
                    <tr>
                        <th colspan="6">
                            <div class="flex items-center justify-between py-3 px-2 relative">

                                <button type="button" id="btn-mes-anterior" class="p-2 rounded-full hover:bg-white/60 transition focus:outline-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:text-[#615ACD] transition">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>

                                <div class="relative">
                                    <button type="button" id="btn-dropdown-meses" class="flex items-center gap-1 text-lg font-semibold cursor-pointer hover:text-[#615ACD] transition focus:outline-hidden">
                                        <span id="label-mes-atual">Maio</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mt-0.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>

                                    <div id="dropdown-meses" class="absolute left-1/2 -translate-x-1/2 z-50 hidden w-36 mt-2 bg-white border border-gray-100 rounded-md shadow-lg ring-1 ring-black/5 focus:outline-hidden">
                                        <div class="py-1 max-h-60 overflow-y-auto">
                                            @foreach(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'] as $index => $mesNome)
                                                <button type="button" class="item-mes-select block w-full px-4 py-2 text-sm text-left text-gray-700 transition hover:bg-gray-100 hover:text-[#615ACD]" data-mes="{{ $index }}">
                                                    {{ $mesNome }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="btn-proximo-mes" class="p-2 rounded-full hover:bg-white/60 transition focus:outline-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:text-[#615ACD] transition">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                            </div>


                            <button type="button" id="btn-proximo-mes" class="p-2 rounded-full hover:bg-white/60 transition focus:outline-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hover:text-[#615ACD] transition">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                        </div>
                    </th>
                </tr>
            </thead>


            <thead class="bg-[#F8F8FF] text-[#131047]">
                <tr>
                    <th class="p-3"></th>
                    <th class="p-3 text-left">Tipo</th>
                    <th class="p-3 text-left">Descrição</th>
                    <th class="p-3 text-left">Categoria</th>
                    <th class="p-3 text-left">Valor</th>
                    <th class="p-3 text-left">Ações</th>
                </tr>
            </thead>


            <tbody id="tabela-lancamentos" class="divide-y divide-gray-100">
                @forelse ($lancamentos as $lancamento)
                    <tr class="hover:bg-gray-50/50 transition duration-150 linha-lancamento" data-data="{{ \Carbon\Carbon::parse($lancamento->data_criacao)->format('Y-m') }}">

                        <td class="p-3">
                            @if($lancamento->tipo_lancamento_id == 1)
                                <label class="inline-flex items-center cursor-pointer">
                                    <span class="text-xs font-medium text-gray-500 mr-2">Não Paga</span>

                                    <input type="checkbox" class="sr-only peer switch-status" data-id="{{ $lancamento->id }}" {{ $lancamento->status_pago ? 'checked' : '' }}>

                                    <div class="w-9 h-5 bg-gray-200 rounded-full relative peer-focus:ring-2 peer-focus:ring-[#615ACD]
                                                peer-checked:bg-emerald-500 transition-colors
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                after:bg-white after:h-4 after:w-4 after:rounded-full after:shadow-sm
                                                after:transition-transform peer-checked:after:translate-x-full">
                                    </div>

                                    <span class="text-xs font-medium text-gray-500 ml-2">Paga</span>
                                </label>
                            @endif
                        </td>

                        <td class="p-3 coluna-busca">{{ $lancamento->tipoLancamento->titulo ?? 'N/A' }}</td>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $lancamento->tipo_lancamento_id == 2 ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                {{ $lancamento->tipoLancamento->titulo ?? 'N/A' }}
                            </span>
                        <td class="p-3 coluna-busca font-medium text-gray-800">{{ $lancamento->descricao }}</td>
                        
                        <td class="p-3 coluna-busca text-gray-600">{{ $lancamento->categoria->titulo ?? 'N/A' }}</td>
                        
                        <td class="p-3 font-bold" {{ $lancamento->tipo_lancamento_id == 2 ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $lancamento->tipo_lancamento_id == 2 ? '+' : '-' }} R$ {{ number_format($lancamento->valor, 2, ',', '.') }}
                        </td>

                        <td class="p-3 flex gap-2">
                            @if($lancamento->tipo_lancamento_id == 1)

                                <button class="p-2 rounded-md hover:bg-gray-100 transition group btn-abrir-modal-ver-despesa"
                                        data-descricao="{{ $lancamento->descricao }}"
                                        data-valor="{{ $lancamento->valor }}"
                                        data-status="{{ $lancamento->status_pago ? 'true' : 'false' }}"
                                        data-categoria="{{ $lancamento->categoria_id }}"
                                        data-frequencia="{{ $lancamento->frequencia_id }}"
                                        data-criacao="{{ \Carbon\Carbon::parse($lancamento->data_criacao)->format('Y-m-d') }}"
                                        data-vencimento="{{ $lancamento->data_vencimento ? \Carbon\Carbon::parse($lancamento->data_vencimento)->format('Y-m-d') : '' }}">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-[#615ACD] transition">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>

                                <button class="p-2 rounded-md hover:bg-gray-100 transition group btn-abrir-modal-editar-despesa"
                                        data-id="{{ $lancamento->id }}"
                                        data-descricao="{{ $lancamento->descricao }}"
                                        data-valor="{{ $lancamento->valor }}"
                                        data-status="{{ $lancamento->status_pago ? 'true' : 'false' }}"
                                        data-categoria="{{ $lancamento->categoria_id }}"
                                        data-frequencia="{{ $lancamento->frequencia_id }}"
                                        data-criacao="{{ \Carbon\Carbon::parse($lancamento->data_criacao)->format('Y-m-d') }}"
                                        data-vencimento="{{ $lancamento->data_vencimento ? \Carbon\Carbon::parse($lancamento->data_vencimento)->format('Y-m-d') : '' }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600 group-hover:text-blue-500 transition">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>

                            @elseif ($lancamento->tipo_lancamento_id == 2)
                                
                                <button class="p-2 rounded-md hover:bg-gray-100 transition group btn-abrir-modal-ver-receita"
                                        data-descricao="{{ $lancamento->descricao }}"
                                        data-valor="{{ $lancamento->valor }}"
                                        data-categoria="{{ $lancamento->categoria_id }}"
                                        data-frequencia="{{ $lancamento->frequencia_id }}"
                                        data-criacao="{{ \Carbon\Carbon::parse($lancamento->data_criacao)->format('Y-m-d') }}">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-[#615ACD] transition">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>

                                <button class="p-2 rounded-md hover:bg-gray-100 transition group btn-abrir-modal-editar-receita"
                                        data-id="{{ $lancamento->id }}"
                                        data-descricao="{{ $lancamento->descricao }}"
                                        data-valor="{{ $lancamento->valor }}"
                                        data-categoria="{{ $lancamento->categoria_id }}"
                                        data-frequencia="{{ $lancamento->frequencia_id }}"
                                        data-criacao="{{ \Carbon\Carbon::parse($lancamento->data_criacao)->format('Y-m-d') }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                            @endif

                            <button type="button" class="p-2 rounded-md hover:bg-rose-50 transition group btn-abrir-modal-deletar" 
                                    data-id="{{ $lancamento->id }}" 
                                    data-descricao="{{ $lancamento->descricao }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-rose-500 transition">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-base font-medium">Nenhuma movimentação registrada.</p>
                                <p class="text-sm mt-1">Comece adicionando uma receita ou despesa no botão acima!</p>
                            </div>
                        </td>
                    </tr>    
                @endforelse
        
    </div>

    <div id="container-modal-receita" class="hidden">
        @include('lancamentos.modais.criarReceita')
    </div>

    <div id="container-modal-despesa" class="hidden">
        @include('lancamentos.modais.criarDespesa')
    </div>

    <div id="container-modal-editar-despesa" class="hidden">
        @include('lancamentos.modais.editarDespesa')
    </div>

    <div id="container-modal-editar-receita" class="hidden">
        @include('lancamentos.modais.editarReceita')
    </div>

    <div id="container-modal-deletar" class="hidden">
        @include('lancamentos.modais.deletar')
    </div>

    <div id="container-modal-ver-despesa" class="hidden">
        @include('lancamentos.modais.verDespesa')
    </div>

    <div id="container-modal-ver-receita" class="hidden">
        @include('lancamentos.modais.verReceita')
    </div>



    <script type="module">
        $(document).ready(function () {

            $('#btn-dropdown-lancamento').on('click', function (event) {
                event.stopPropagation();
                $('#menu-dropdown-lancamento').toggleClass('hidden');
            });

            $(document).on('click', function (event) {
                if (!$(event.target).closest('#btn-dropdown-lancamento').length &&
                    !$(event.target).closest('#menu-dropdown-lancamento').length) {
                    $('#menu-dropdown-lancamento').addClass('hidden');
                }
            });

            // Region Carregar Modal
            $('#btn-abrir-modal-despesa').on('click', function () {
                $('#menu-dropdown-lancamento').addClass('hidden');
                $('#container-modal-despesa').removeClass('hidden');
            });

            $('#btn-abrir-modal-receita').on('click', function () {
                $('#menu-dropdown-lancamento').addClass('hidden');
                $('#container-modal-receita').removeClass('hidden');
            });

            $('.btn-abrir-modal-editar-despesa').on('click', function () {
                const id = $(this).data('id');
                const descricao = $(this).data('descricao');
                const valor = $(this).data('valor');
                const status = String($(this).data('status'));
                const categoria = $(this).data('categoria');
                const frequencia = $(this).data('frequencia');
                const dataCriacao = $(this).data('criacao');
                const dataVencimento = $(this).data('vencimento');

                $('#form-editar-despesa').attr('action', '/lancamentos/despesa/editar/' + id);

                $('#modal-descricao').val(descricao);
                $('#modal-valor').val(valor);
                $('#modal-status').val(status);
                $('#modal-categoria').val(categoria);
                $('#modal-frequencia').val(frequencia);
                $('#modal-dataCriacao').val(dataCriacao);
                $('#modal-dataVencimento').val(dataVencimento);

                $('#menu-dropdown-lancamento').addClass('hidden');
                $('#container-modal-editar-despesa').removeClass('hidden');
            });

            $('.btn-abrir-modal-editar-receita').on('click', function () {
                const id = $(this).data('id');
                const descricao = $(this).data('descricao');
                const valor = $(this).data('valor');
                const categoria = String($(this).data('categoria'));
                const frequencia = String($(this).data('frequencia'));
                const dataCriacao = $(this).data('criacao');

                $('#form-editar-receita').attr('action', '/lancamentos/receita/editar/' + id);

                $('#modal-editar-descricao-receita').val(descricao);
                $('#modal-editar-valor-receita').val(valor);
                $('#modal-editar-categoria-receita').val(categoria);
                $('#modal-editar-frequencia-receita').val(frequencia);
                $('#modal-editar-dataCriacao-receita').val(dataCriacao);

                $('#menu-dropdown-lancamento').addClass('hidden');
                $('#container-modal-editar-receita').removeClass('hidden');
            });

            $('.btn-abrir-modal-ver-despesa').on('click', function () {
                const descricao = $(this).data('descricao');
                const valor = $(this).data('valor');
                const status = String($(this).data('status'));
                const categoria = $(this).data('categoria');
                const frequencia = $(this).data('frequencia');
                const dataCriacao = $(this).data('criacao');
                const dataVencimento = $(this).data('vencimento');

                $('#modal-ver-descricao').val(descricao);
                $('#modal-ver-valor').val(valor);
                $('#modal-ver-status').val(status);
                $('#modal-ver-categoria').val(categoria);
                $('#modal-ver-frequencia').val(frequencia);
                $('#modal-ver-dataCriacao').val(dataCriacao);
                $('#modal-ver-dataVencimento').val(dataVencimento);

                $('#menu-dropdown-lancamento').addClass('hidden');
                $('#container-modal-ver-despesa').removeClass('hidden');
            });

            $('.btn-abrir-modal-deletar').on('click', function () {
                const id = $(this).data('id');
                const descricao = $(this).data('descricao');

                $('#form-deletar-lancamento').attr('action', '/lancamentos/deletar/' + id);
                
                $('#texto-descricao-deletar').text(descricao);
                $('#container-modal-deletar').removeClass('hidden');
            });

            $('.btn-abrir-modal-ver-receita').on('click', function () {
                const descricao = $(this).data('descricao');
                const valor = $(this).data('valor');
                const categoria = String($(this).data('categoria'));
                const frequencia = String($(this).data('frequencia'));
                const dataCriacao = $(this).data('criacao');

                $('#modal-ver-descricao-receita').val(descricao);
                $('#modal-ver-valor-receita').val(valor);
                $('#modal-ver-categoria-receita').val(categoria);
                $('#modal-ver-frequencia-receita').val(frequencia);
                $('#modal-ver-dataCriacao-receita').val(dataCriacao);

                $('#menu-dropdown-lancamento').addClass('hidden');
                $('#container-modal-ver-receita').removeClass('hidden');
            });
            // Endregion Carregar Modal
            
            //Region Abrir Modal
            $('#btn-abrir-modal-receita').on('click', function(){
                $('#container-modal-receita').removeClass('hidden');
            });
            
            $('#btn-abrir-modal-despesa').on('click', function(){
                $('#container-modal-despesa').removeClass('hidden');
            });

            // Region Fechar Modal
            $(document).on('click', '#btn-fechar-modal', function () {
                $('#container-modal-despesa').addClass('hidden');
            });

            $(document).on('click', '#btn-fechar-modal-receita', function () {
                $('#container-modal-receita').addClass('hidden');
            });

            $(document).on('click', '#btn-fechar-modal-editar-despesa', function () {
                $('#container-modal-editar-despesa').addClass('hidden');
            });

            $('#btn-fechar-modal-editar-receita').on('click', function() {
                $('#container-modal-editar-receita').addClass('hidden');
            });

            $('#btn-fechar-modal-deletar').on('click', function() {
                $('#container-modal-deletar').addClass('hidden');
            });

            $('#btn-fechar-modal-ver-despesa').on('click', function() {
                $('#container-modal-ver-despesa').addClass('hidden');
            });

            $('#btn-fechar-modal-ver-receita').on('click', function() {
                $('#container-modal-ver-receita').addClass('hidden');
            });
            // Endregion Fechar Modal
    

            // filtro
            $('#search').on('keyup', function() {
                var termoBusca = $(this).val().toLowerCase(); // Pega o que o usuário digitou e passa pra minúsculo

                $('#tabela-lancamentos .linha-lancamento').each(function() {
                    var textoLinha = $(this).find('.coluna-busca').text().toLowerCase();

                    if (textoLinha.indexOf(termoBusca) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('.switch-status').on('change', function() {
                var idLancamento = $(this).data('id');
                var isChecked = $(this).is(':checked') ? 1 : 0;
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/lancamentos/atualizar-status/' + idLancamento,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}", // Token de segurança do Laravel
                        status: isChecked
                    },
                    error: function(error) {
                        alert('Erro ao atualizar o status. Tente novamente.');
                        $(this).prop('checked', !isChecked);
                    }
                });
            });

            //Parte mês
            const mesesNomes = [
                'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ];

            // Mês e Ano atuais
            let dataFiltroAtual = new Date();

            function aplicarFiltroMes() {
                let ano = dataFiltroAtual.getFullYear();
                let mes = dataFiltroAtual.getMonth();

                $('#label-mes-atual').text(mesesNomes[mes] + ' de ' + ano);

                // Formata o mês
                let mesFormatado = String(mes + 1).padStart(2, '0');
                let chaveAnoMes = ano + '-' + mesFormatado;

                let totalLinhasVisiveis = 0;

                // Filtra a tabela ocultando ou exibindo as trs
                $('#tabela-lancamentos .linha-lancamento').each(function() {
                    let dataLinha = $(this).data('data'); // Pega o "Y-m" da linha

                    if (dataLinha === chaveAnoMes) {
                        $(this).show();
                        totalLinhasVisiveis++;
                    } else {
                        $(this).hide();
                    }
                });

                // Se não houver nenhum lançamento exibe uma mensagem
                $('#linha-vazia-feedback').remove();
                if (totalLinhasVisiveis === 0) {
                    $('#tabela-lancamentos').append(
                        `<tr id="linha-vazia-feedback"><td colspan="6" class="p-6 text-center text-gray-500">Nenhum lançamento encontrado para este mês.</td></tr>`
                    );
                }
            }

            // Executa o filtro
            aplicarFiltroMes();

            // Mês Anterior
            $('#btn-mes-anterior').on('click', function(e) {
                e.stopPropagation();
                dataFiltroAtual.setMonth(dataFiltroAtual.getMonth() - 1);
                aplicarFiltroMes();
            });

            // Próximo Mês
            $('#btn-proximo-mes').on('click', function(e) {
                e.stopPropagation();
                dataFiltroAtual.setMonth(dataFiltroAtual.getMonth() + 1);
                aplicarFiltroMes();
            });

            // Abrir/Fechar o Dropdown
            $('#btn-dropdown-meses').on('click', function(e) {
                e.stopPropagation();
                $('#dropdown-meses').toggleClass('hidden');
            });

            $(document).on('click', function() {
                $('#dropdown-meses').addClass('hidden');
            });

            $('.item-mes-select').on('click', function(e) {
                e.stopPropagation();
                let mesSelecionado = $(this).data('mes');

                dataFiltroAtual.setMonth(mesSelecionado);
                aplicarFiltroMes();
                $('#dropdown-meses').addClass('hidden'); // Fecha o menu
            });




        });
    </script>
@endsection


