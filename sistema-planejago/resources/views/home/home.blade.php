@extends('layouts.master')

@section('content')
<div class="min-h-[calc(100vh-4rem)] bg-white flex flex-col justify-center items-center px-6 py-12 md:px-16 lg:px-24">
    
    <div class="w-full max-w-7xl flex flex-col md:flex-row items-center justify-between gap-12">
        
        <div class="w-full md:w-1/2 flex flex-col items-start text-left space-y-6">
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#3B3A7F] tracking-tight">
                Organize suas Finanças
            </h1>
            
            <h2 class="text-2xl md:text-3xl font-bold text-[#F2994A]">
                Cresça financeiramente
            </h2>
            
            <p class="text-[#3B3A7F]/80 text-base md:text-lg max-w-lg leading-relaxed font-medium">
                O PlanejaGo é um sistema de gestão de finanças pessoais que te ajuda a gerir o controle de despesas de forma simples e fácil.
            </p>
            
            <div class="pt-4">
                <a href="{{ route('user.create') }}" class="inline-block bg-[#5B51D8] hover:bg-[#4A40C5] text-white font-semibold px-10 py-3.5 rounded-xl shadow-md transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                    Começar
                </a>
            </div>
            
        </div>

        <div class="w-full md:w-1/2 flex justify-center items-center">
            <img src="{{ asset('assets/images/home-illustration.png') }}" alt="Ilustração PlanejaGo" class="w-full max-w-md md:max-w-lg object-contain drop-shadow-sm">
        </div>

    </div>
</div>
@endsection