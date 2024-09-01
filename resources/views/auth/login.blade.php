<x-guest-layout>
    <!-- Container da Página de Login -->
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 shadow-lg rounded-lg">
            <!-- Logotipo Personalizado -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/logoF.png') }}" alt="Logo Terapias Orientais" class="w-16 h-16">
            </div>

            <!-- Título da Página de Login -->
            <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Bem-vindo de Volta!</h2>

            <!-- Status da Sessão -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulário de Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Campo de Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Campo de Senha -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Lembrar de Mim -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-400" name="remember">
                        <span class="ml-2 text-sm text-gray-700">Lembrar-me</span>
                    </label>
                </div>

                <!-- Links e Botão de Login -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-indigo-600 hover:text-indigo-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            Esqueceu sua senha?
                        </a>
                    @endif

                    <x-primary-button class="ml-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Entrar
                    </x-primary-button>
                </div>
            </form>

            <!-- Opções Adicionais -->
            <div class="mt-6 flex justify-between">
                <!-- Link para Voltar à Página Inicial -->
                <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Voltar à Página Inicial
                </a>
                
                <!-- Link para Página de Cadastro -->
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-800 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Criar Conta
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
