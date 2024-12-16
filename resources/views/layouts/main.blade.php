{{-- General Layouts --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@isset($title) {{ $title }} - @endisset TK KING'S KIDZ</title>

    {{-- TAILWIND CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- OTHER CSS --}}
    @yield('css')
</head>
<body>
    {{-- Add Logo --}}
    <div class="flex items-center justify-center py-4">
        <img src="{{ asset('images/kingskid.png') }}" alt="King's Kid Logo" class="h-16 w-auto">
        <h1 class="text-3xl font-bold text-gray-900 ml-3">TK KING'S KIDZ</h1>
    </div>
    @yield('content')

    {{-- JAVASCRIPT --}}
    @yield('script')
</body>
</html>