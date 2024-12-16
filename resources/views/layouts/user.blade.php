<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @isset($title)
            {{ $title }} -
        @endisset TK KING'S KIDZ
    </title>

    {{-- TAILWIND CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- OTHER CSS --}}
    @yield('css')
</head>

<body>
    {{-- for background purpose --}}
    <div class="overlay"></div>

    <div class="min-h-screen relative">
        <div class="relative z-10 min-h-screen flex flex-col">
            {{-- navigation --}}
            <nav class="bg-gray-800 bg-opacity-50 border-gray-700 shadow-lg">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <div class="flex items-center">
                        <img src="{{ asset('images/kingskid.png') }}" alt="King's Kid Logo" class="h-8 w-auto mr-3">
                        <span class="text-2xl font-semibold whitespace-nowrap text-white">TK KING'S KIDZ</span>
                    </div>
                    <button data-collapse-toggle="navbar-default" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-200 rounded-lg md:hidden hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-600"
                        aria-controls="navbar-default" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                        <ul
                            class="font-medium flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0">
                            <li>
                                <a href="{{ route('user.home') }}"
                                    @if(request()->is('home*')) class="block py-2 px-3 text-gray-50 bg-gray-700 rounded md:bg-transparent md:text-gray-50 md:p-0 md:active:bg-gray-700" @else class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-100 md:p-0 dark:hover:bg-gray-700 dark:hover:text-white" @endif
                                    aria-current="page">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('user.donate') }}"
                                    @if(request()->is('donate')) class="block py-2 px-3 text-gray-50 bg-gray-700 rounded md:bg-transparent md:text-gray-50 md:p-0 md:active:bg-gray-700" @else class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-100 md:p-0 dark:hover:bg-gray-700 dark:hover:text-white" @endif
                                    aria-current="page">Donate</a>
                            </li>

                            {{-- TODO: front end membuat tampilan list of donations dan setting account --}}
                            <li>
                                <a href="{{ route('user.donate.list') }}"
                                    @if(request()->is('donate/list*')) class="block py-2 px-3 text-gray-50 bg-gray-700 rounded md:bg-transparent md:text-gray-50 md:p-0 md:active:bg-gray-700" @else class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-100 md:p-0 dark:hover:bg-gray-700 dark:hover:text-white" @endif
                                    aria-current="page">List of Donation</a>
                            </li>
                            {{-- admin dashboard if user role is admin --}}
                            @if(auth()->user() && auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    @if(request()->is('admin/dashboard*')) class="block py-2 px-3 text-gray-50 bg-gray-700 rounded md:bg-transparent md:text-gray-50 md:p-0 md:active:bg-gray-700" @else class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-100 md:p-0 dark:hover:bg-gray-700 dark:hover:text-white" @endif
                                    aria-current="page">Admin Dashboard</a>
                            </li>
                            @endif

                            {{-- logout button --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="block py-2 px-3 text-gray-300 rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-100 md:p-0 dark:hover:bg-gray-700 dark:hover:text-white"
                                        aria-current="page">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- content --}}
            @yield('content')
        </div>
    </div>

    {{-- NAVBAR JAVASCRIPT (from Flowbite) --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    {{-- OTHER JS --}}
    @yield('script')
</body>

</html>
