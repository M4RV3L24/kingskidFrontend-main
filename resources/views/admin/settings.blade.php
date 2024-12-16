@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Admin Settings</h1>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-xl font-semibold mb-4">General Settings</h2>
        <form>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="siteName">
                    Site Name
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="siteName" type="text" placeholder="TK KING'S KIDZ">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="adminEmail">
                    Admin Email
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="adminEmail" type="email" placeholder="admin@example.com">
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                    Save Settings
                </button>
            </div>
        </form>

        {{-- add new admin --}}
        <h2 class="text-xl font-semibold mt-6 mb-6">Add New Admin</h2>
        {{-- add alert --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session()->get('success') }}</span>
            </div>
        @elseif(session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session()->get('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.newAdmin') }}">
            @csrf
            {{-- <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="adminName">
                    Admin Name
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="adminName" name="name" type="text" placeholder="John Doe">
            </div> --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="adminEmail">
                    Admin Email
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="adminEmail" name="email" type="email" placeholder="Johndoe@gmail.com">

            </div>
            {{-- submit form --}}
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Add Admin
            </button>
        </form>
    </div>
@endsection
