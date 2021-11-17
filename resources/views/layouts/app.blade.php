<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

        <title>{{ $title ?? config('app.name') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles />

        @stack('styles')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900 text-sm">
        <header class="flex items-center justify-between md:px-8 px-4 py-4">
            <a href="{{ route('/') }}" class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 md:w-12">
                <span class="text-xl md:text-3xl font-semibold ml-3 text-teal-600 font-lobster">VotingApp</span>
            </a>

            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                    <div class="hidden md:block px-6 py-4">
                        @auth
                            <div class="flex items-center space-x-4">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log out') }}
                                    </a>
                                </form>

                                <livewire:comment-notifications />
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-700">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-semibold ml-4 text-gray-700">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

                <div class="flex items-center">
                    @auth
                        <div class="block md:hidden mt-3 mr-3">
                            <livewire:comment-notifications />
                        </div>

                        <img src="{{ auth()->user()->photoUrl() }}" alt="avatar" class="w-10 h-10 rounded-full">
                    @else
                        <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar" class="w-10 h-10 rounded-full">
                    @endauth

                    <div
                        x-data="{ isOpen: false }"
                        class="mobile-menu block md:hidden ml-3 cursor-pointer relative">

                        <svg @click.prevent="isOpen = ! isOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.75 5.75H19.25"/>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18.25H19.25"/>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 12H19.25"/>
                        </svg>

                        <div
                            x-show.transition.opacity="isOpen"
                            x-cloak
                            class="absolute bg-white h-auto right-0 rounded-md shadow-md top-10 w-28 z-20">
                            @auth
                                <div class="flex items-center space-x-4 py-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{ route('logout') }}" class="px-4"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log out') }}
                                        </a>
                                    </form>
                                </div>
                            @else
                                <div class="flex flex-col space-y-2 py-3">
                                    <a href="{{ route('login') }}" class="font-semibold px-4 text-gray-700">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="font-semibold px-4 text-gray-700">Register</a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="container mx-auto flex flex-col md:flex-row px-3 md:px-0">
            <div class="w-full md:w-2/6 mr-0 md:mr-5">
                <livewire:create-idea />

                <livewire:mobile-create-idea />
            </div>

            <div class="w-full md:w-4/6">

                <livewire:status-filters />

                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
        </main>

        @if (session('message'))
            <x-success-notification
                :redirect="true"
                message="{{ session('message') }}"
            />
        @endif

        @if (session('error_message'))
            <x-success-notification
                type="error"
                :redirect="true"
                message="{{ session('error_message') }}"
            />
        @endif

        @stack('modals')

        <livewire:scripts />

        @stack('scripts')
    </body>
</html>
