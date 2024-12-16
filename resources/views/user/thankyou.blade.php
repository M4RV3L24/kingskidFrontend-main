@extends('layouts.user')

@section('css')
    <style>
        body {
            background-image: linear-gradient(to right, #87CEEB, #98FB98);
        }
    </style>
@endsection

@section('content')
    <div class="flex items-center justify-center mx-1 my-12">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-md text-center">
            <h2 class="text-3xl font-extrabold text-yellow-500 mb-4">
                THANK YOU FOR YOUR CONTRIBUTION!
            </h2>
            <p class="text-xl text-gray-700 mb-8">
                Your Donation Means A Lot For Us, <span class="font-bold">For Our Future!</span>
            </p>
            <a href="{{ route('user.home') }}"
                class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-full transition duration-300">
                Back Home
            </a>
        </div>
    </div>
@endsection
