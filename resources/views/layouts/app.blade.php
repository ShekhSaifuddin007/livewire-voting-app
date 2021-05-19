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

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900 text-sm">
        <header class="flex items-center justify-between px-8 py-4">
            <a href="#" class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-16">
                <span class="text-3xl font-semibold ml-3 text-teal-600 font-lobster">VotingApp</span>
            </a>

            <div class="flex items-center">
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

        <main class="container mx-auto flex">
            <div class="w-2/6 mr-5">
                <div class="bg-white border-2 rounded-xl mt-16 custom-gradient">
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Add an idea</h3>
                        <p class="text-xs mt-4">Let us know what you would like and we'll take a look over!</p>
                    </div>

                    <form action="#" method="POST" class="space-y-4 px-4 py-6">
                        <div>
                            <input type="text" class="w-full text-sm bg-gray-100 focus:ring-teal-500 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Your Idea">
                        </div>
                        <div>
                            <select name="category_add" id="category_add" class="w-full bg-gray-100 focus:ring-teal-500 text-sm rounded-xl border-none px-4 py-2">
                                <option value="Category One">Category One</option>
                                <option value="Category Two">Category Two</option>
                                <option value="Category Three">Category Three</option>
                                <option value="Category Four">Category Four</option>
                            </select>
                        </div>
                        <div>
                            <textarea name="idea" id="idea" rows="5" class="w-full bg-gray-100 focus:ring-teal-500 rounded-xl border-none placeholder-gray-900 text-sm px-4 py-2" placeholder="Describe your idea"></textarea>
                        </div>
                        <div class="flex items-center justify-between space-x-3">
                            <button
                                type="button"
                                class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 focus:outline-none font-semibold rounded-xl border border-gray-200 hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                            >
                                <svg class="text-gray-600 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                            <button
                                type="button"
                                class="flex items-center justify-center w-1/2 h-11 text-xs bg-teal-500 focus:outline-none text-white font-semibold rounded-xl hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                            >
                            <svg class="w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                            </svg>
                                <span class="ml-1">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-4/6">
                <nav class="flex items-center justify-between text-xs">
                    <ul class="flex uppercase font-semibold border-b-4 border-gray-300 pb-3 space-x-10">
                        <li><a href="#" class="border-b-4 border-teal-500 pb-3">All Ideas (87)</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 border-gray-300 hover:border-teal-500 pb-3">Considering (6)</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 border-gray-300 hover:border-teal-500 pb-3">In Progress (1)</a></li>
                    </ul>

                    <ul class="flex uppercase font-semibold border-b-4 border-gray-300 pb-3 space-x-10">
                        <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 border-gray-300 hover:border-teal-500">Implemented (10)</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 border-gray-300 hover:border-teal-500">Closed (55)</a></li>
                    </ul>
                </nav>

                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
