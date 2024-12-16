@extends('layouts.main')

@section('css')
    <style>
        body {
            background-image: url('{{ asset('images/background_image.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .bg-white-transparent {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 bg-white-transparent p-10 rounded-xl shadow-md">
    <div class="text-center">
        <img src="{{ asset('images/kingskid.png') }}" alt="King's Kid Logo" class="mx-auto h-20 w-auto">
        <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
            TK KING'S KIDZ
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Welcome to our donation platform
                </p>
            </div>

            {{-- alert --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('alert'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Alert!</strong>
                    <span class="block sm:inline">{{ session('alert') }}</span>
                </div>
            @endif

            <div class="space-y-4">
                {{-- user login --}}
                <div>
                    <a href="{{ route('google.redirect') }}"
                       class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                        </svg>
                        Continue With Google
                    </a>
                </div>

                {{-- admin login --}}
                <div>
                    <a href="{{ route('google.redirect.admin') }}"
                       class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px" fill="white">
                            <path d="M 12 3 A 4 4 0 0 0 8 7 A 4 4 0 0 0 12 11 A 4 4 0 0 0 16 7 A 4 4 0 0 0 12 3 z M 12 14 C 11.686 14 11.334844 14.019734 10.964844 14.052734 L 9.6230469 16.064453 C 9.3260469 16.509453 8.6739531 16.509453 8.3769531 16.064453 L 7.4921875 14.740234 C 5.1331875 15.463234 3 16.715 3 18.5 L 3 20 C 3 20.552 3.448 21 4 21 L 20 21 C 20.552 21 21 20.552 21 20 L 21 18.5 C 21 16.715 18.866812 15.463234 16.507812 14.740234 L 15.623047 16.064453 C 15.326047 16.509453 14.673953 16.509453 14.376953 16.064453 L 13.035156 14.052734 C 12.665156 14.019734 12.314 14 12 14 z"/>
                        </svg>
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
