<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="{{ route('/') }}" class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-16">
                <span class="text-3xl font-semibold ml-3 text-teal-600 font-lobster">VotingApp</span>
            </a>

            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                    <div class="px-6 py-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log out') }}
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-700">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-semibold ml-4 text-gray-700">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <a href="#">
                    <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar" class="w-10 h-10 rounded-full">
                </a>
            </div>
        </header>

        <main class="container mx-auto flex flex-col md:flex-row px-3 md:px-0">
            <div class="w-full md:w-2/6 mr-0 md:mr-5">
                <div class="bg-white md:sticky md:top-8 border-2 rounded-xl mt-8 md:mt-16 custom-gradient">
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Add an idea</h3>
                        <p class="text-xs mt-4">
                            @auth
                                Let us know what you would like and we'll take a look over!
                            @else
                                Please login to create an idea
                            @endauth
                        </p>
                    </div>
                    @auth
                        <livewire:create-idea />
                    @else
                        <div class="my-6 text-center">
                            <a
                                href="{{ route('register') }}"
                                class="inline-block justify-center w-1/2 h-11 text-sm bg-gray-200 focus:outline-none font-semibold rounded-xl border border-gray-200 hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                            >
                                Sign up
                            </a>

                            <a
                                href="{{ route('login') }}"
                                class="inline-block mt-2 justify-center w-1/2 h-11 text-sm bg-teal-500 focus:outline-none text-white font-semibold rounded-xl hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                            >
                                Login
                            </a>
                        </div>
                    @endauth

                </div>
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




        @stack('modals')

        <livewire:scripts />

        @stack('scripts')
    </body>
</html>
