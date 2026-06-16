@extends('layouts.master')

@section('content')

<div class="relative flex flex-col justify-center pt-12 gap-6 items-center w-full h-full">

   <div class="absolute top-0 right-0 w-[15vw] min-w-[120px] max-w-[400px] pointer-events-none -z-10">
        <img src="{{ asset('assets/images/FlorInvertida.png') }}" alt="Ilustração Flor Invertida" class="w-full h-auto object-contain">
    </div>

    <div class="absolute bottom-0 left-0 w-[20vw] min-w-[120px] max-w-[400px] pointer-events-none -z-10">
        <img src="{{ asset('assets/images/flor1.png') }}" alt="Ilustração Flor 1" class="w-full h-auto object-contain drop-shadow-sm">
    </div>

    <h1 class="text-5xl font-bold text-[#615ACD]">Criar Conta</h1>

    <div class="flex flex-col items-center w-full h-full pt-6 pb-12">
        <form action="{{ route('user.store') }}" method='POST'>
            @csrf

            <div class="flex flex-col w-full max-w-sm sm:w-87.5 border border-gray-300 bg-white shadow-lg rounded-xl p-6 md:p-8 gap-4">

                <div>
                    <label class="block mb-1.5 text-lg font-medium text-gray-700">Nome</label>
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD] placeholder-gray-400"
                        placeholder="Ex: João Silva" />
                </div>

                <div>
                    <label class="block mb-1.5 text-lg font-medium text-gray-700">Data de Nascimento</label>
                    @error('data_nascimento')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}"
                        class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD]" />
                </div>

                <div>
                    <label class="block mb-1.5 text-lg font-medium text-gray-700">Email</label>
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    @error('error')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror

                    <input type="text" name="email" value="{{ old('email') }}"
                        class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD] placeholder-gray-400"
                        placeholder="Ex: usuario@gmail.com" />
                </div>

                <div>
                    <label class="block mb-1.5 text-lg font-medium text-gray-700">Senha</label>
                    @error('password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    <input type="password" name="password"
                        class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD] placeholder-gray-400" />
                </div>

                <div>
                    <label class="block mb-1.5 text-lg font-medium text-gray-700">Confirmar Senha</label>
                    @error('password_confirmation')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    <input type="password" name="password_confirmation"
                        class="block w-full px-3 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-[#615ACD] focus:border-[#615ACD] placeholder-gray-400" />
                </div>

                <div class="flex flex-col gap-4 pt-4">
                    <div class="flex justify-center">
                        <button type="submit"
                            class="inline-block bg-[#5B51D8] hover:bg-[#4A40C5] text-white font-semibold w-full p-1.5 rounded-xl shadow-md transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Cadastrar-se
                        </button>
                    </div>

                    <a href="{{ route('login') }}" class="text-sm text-[#2C2966] text-center">Já tenho uma conta</a>
                </div>

            </div>
        </form>
    </div>

</div>

@endsection