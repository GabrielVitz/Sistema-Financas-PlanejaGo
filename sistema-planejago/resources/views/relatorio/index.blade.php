@extends('layouts.master')

@section('content')

<div class="flex flex-col w-full h-full "> 
    
    <div class="container mx-auto mt-6 px-6">
        <ol class="flex items-center whitespace-nowrap ">
            <li class="inline-flex items-center">
                <a class="flex items-center text-sm text-muted-foreground-1 hover:text-primary-focus focus:outline-hidden focus:text-primary-focus" href="/">
                Home
                </a>
                <svg class="shrink-0 mx-2 size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </li>
            <li class="inline-flex items-center text-sm font-semibold text-foreground truncate" aria-current="page">
                Relatórios
            </li>
        </ol>

        <div class="flex items-center gap-2">
            <h2 class="text-3xl font-bold tracking-tight text-[#615ACD] md:text-4xl pb-4">Relatórios</h2>
        </div>

        <form action="{{ route('relatorio.index') }}" method="GET" class="flex w-full h-fit gap-6 bg-[#E5E5F6] p-4 rounded-xl items-center flex-wrap md:flex-nowrap">
            
            <div class="w-full">
                <label for="periodo" class="block mb-1.5 text-sm font-medium text-gray-700">Periodo</label>
                <select id="periodo" name="periodo" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required>
                    <option value="" disabled>Selecione</option>
                    <option value="hoje" {{ request('periodo') == 'hoje' ? 'selected' : '' }}>Hoje</option>
                    <option value="semana" {{ request('periodo') == 'semana' ? 'selected' : '' }}>Esta semana</option>
                    <option value="mes" {{ request('periodo') == 'mes' ? 'selected' : '' }}>Este mês</option>
                </select>
            </div>
            
            <div class="w-full">
                <label for="tipo_lancamento_id" class="block mb-1.5 text-sm font-medium text-gray-700">Tipo de Lancamento</label>
                <select id="tipo_lancamento_id" name="tipo_lancamento_id" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required>
                    <option value="" disabled>Selecione</option>
                    @foreach( $tipo_lancamentos as $tipoL)
                        <option value="{{ $tipoL->id }}" {{ request('tipo_lancamento_id') == $tipoL->id ? 'selected' : '' }}>{{ $tipoL->titulo }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="w-full">
                <label for="categoria_id" class="block mb-1.5 text-sm font-medium text-gray-700">Categoria</label>
                <select id="categoria_id" name="categoria_id" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" required>
                    <option value="" disabled>Selecione</option>
                    @foreach( $categorias as $c)
                        <option value="{{ $c->id }}" {{ request('categoria_id') == $c->id ? 'selected' : '' }}>{{ $c->titulo }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="w-full">
                <label for="status" class="block mb-1.5 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]">
                    <option value="">Todos</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Paga</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Não Paga</option>
                </select>
            </div>

            <div class="flex justify-center h-fit pt-6"> <button type="submit" class="inline-block bg-[#5B51D8] hover:bg-[#4A40C5] text-white font-semibold w-full pt-1.5 pb-1.5 pl-2.5 pr-2.5 rounded-xl shadow-md transition duration-200 ease-in-out transform hover:-translate-y-0.5">Gerar</button>
            </div>
            
        </form>

    </div>





</div>


@endsection