<nav class="relative relative bg-[#2C2966] after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">

  <div class="mx-auto w-full px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">

        <!-- Mobile menu button-->
        <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>

      </div>

      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <!--Titulo principal -->
          <a href="{{ auth()->check() ? route('user.dashboard') : url('/') }}" class="text-lg font-bold text-[#FFA051] hover:text-white">PlanejaGo</a>
        </div>
          
        
        

        
        
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Area dos Links do Menu -->
            <a href="{{ route('user.lancamentos') }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-white/5 hover:text-white {{ request()->routeIs('user.lancamentos') ? 'underline decoration-2 underline-offset-4' : '' }}">Lançamentos</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-white/5 hover:text-white">Relatórios</a>
            <a href="{{ route('calculadora') }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-white/5 hover:text-white {{ request()->routeIs('calculadora') ? 'underline decoration-2 underline-offset-4' : '' }}">Calculadora</a>
          </div>
        </div>
      </div>

      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        
        @guest
          @if(Route::is('user.create') || Route::is('login.index'))
            <a href="{{ route('home') }}" class="bg-white p-2 border rounded-sm">Cancelar</a>
          @else
          <div class="flex space-x-2">
            
            <a href="{{ route('user.create') }}" class="bg-white p-2 border rounded-sm">Registrar-se</a>
            
            <a href="{{ route('login.index') }}" class="bg-purple-300 p-2 border rounded-sm">Login</a>
          </div>
          @endif
        @endguest
          
        @auth
          
        
      <!-- Notificações -->
        <button type="button" class="relative rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View notifications</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
            <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>

        <!-- Perfil dropdown-->
        <el-dropdown class="relative ml-3">
          <button class="relative flex rounded-full p-1 text-white/80 hover:bg-white/10 hover:text-white transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">Abrir menu de usuário</span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

          </button>

          <!-- Menu Responsivo -->
          <el-menu anchor="bottom end" popover class="w-48 origin-top-right rounded-md bg-gray-800 py-1 outline -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
            <a href="#" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden">Ver Perfil</a>
            <form action="{{ route('login.destroy') }}" method="POST">
                @csrf
                <button class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:outline-hidden">Deslogar</button>
            </form>
          </el-menu>

        </el-dropdown>
      </div>
      @endauth

    </div>
  </div>

  <!-- Menu Responsivo -->
  @auth
    <el-disclosure id="mobile-menu" hidden class="block sm:hidden">

      <div class="space-y-1 px-2 pt-2 pb-3">

        <a href="{{ route('user.lancamentos') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-white/5 hover:text-white {{ request()->routeIs('user.lancamentos') ? 'underline decoration-2 underline-offset-4' : '' }}">Lançamentos</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-white/5 hover:text-white">Relatórios</a>
        <a href="{{ route('calculadora') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-white/5 hover:text-white {{ request()->routeIs('calculadora') ? 'underline decoration-2 underline-offset-4' : '' }}">Calculadora</a>

      </div>
    </el-disclosure>
  @endauth
  <!------------>
  
</nav>