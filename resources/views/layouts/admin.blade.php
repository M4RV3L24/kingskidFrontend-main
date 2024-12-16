<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($title) {{ $title }} - @endisset ADMIN TK KING'S KIDZ</title>

    {{-- TAILWIND CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- OTHER CSS --}}
    @yield('css')
</head>
<body>
    <div class="flex h-screen bg-gray-200">
        {{-- SIDEBAR --}}
        <div class="bg-blue-800 text-blue-100 w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
            {{-- Logo & Title --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4">
                <img src="{{ asset('images/kingskid.png') }}" alt="King's Kid Logo" class="w-10 h-10">
                <span class="text-xl font-extrabold text-white">TK KING'S KIDZ</span>
            </a>

            <hr class="border-blue-700 mx-2">
        
            <nav class="space-y-3">
                {{-- dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 text-white no-underline 
                   {{ request()->is('admin/dashboard*') ? 'bg-blue-700' : '' }}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>

                {{-- logs --}}
                <a href="{{ route('admin.logs') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 text-white no-underline 
                   {{ request()->is('admin/logs*') ? 'bg-blue-700' : '' }}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Logs</span>
                    </div>
                </a>

                {{-- events --}}
                <a href="{{ route('admin.event.show') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 text-white no-underline 
                   {{ request()->is('admin/event*') ? 'bg-blue-700' : '' }}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Events</span>
                    </div>
                </a>

                {{-- settings --}}
                <a href="{{ route('admin.settings') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 text-white no-underline 
                   {{ request()->is('admin/settings*') ? 'bg-blue-700' : '' }}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Settings</span>
                    </div>
                </a>

                <hr class="border-blue-700 mx-2">

                {{-- User Dashboard --}}
                <a href="{{ route('user.home') }}" 
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 text-white no-underline">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>User Dashboard</span>
                    </div>
                </a>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    @method('delete')
                    <button type="submit" 
                            class="w-full text-left py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 text-white">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Logout</span>
                        </div>
                    </button>
                </form>
            </nav>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- HEADER --}}
            <header class="bg-white shadow-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @yield('header', 'Admin Dashboard')
                    </h1>
                </div>
            </header>

            {{-- MAIN CONTENT AREA --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    {{-- SCRIPTS --}}
    @yield('script')
</body>
</html>