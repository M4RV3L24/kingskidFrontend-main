@extends('layouts.user')

@section('css')
    <style>
        body {
            background-image: linear-gradient(to right, #87CEEB, #98FB98);
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
@endsection

@section('content')

    <div class="mt-10 p-10 rounded-lg bg-white bg-opacity-50 dark:bg-slate-800 dark:bg-opacity-80 max-w-full mx-auto">

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
            
        <form class="max-w-xl mx-auto" action="{{ route("user.donate.insert") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg mb-5 text-center font-semibold focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                     type="text" disabled placeholder="BCA - 8291595588 - Djulia Ekawidjaja Or Amelia Jauwena">
                    
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" readonly
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="name@gmail.com" required />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Name</label>
                        <input type="text" id="name" name="name" placeholder="John Doe"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            required />
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal</label>
                        <input type="number" id="nominal" name="nominal"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="20000" required />
                        @error('nominal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Proof</label>
                        <input name="proof" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                        @error('proof')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-start mb-5">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" value="0" name="anonymous" 
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                 />
                        </div>
                        <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Stay Anonymous</label>
                    </div>
                    
                </div>
                
                {{-- <div class="relative w-full">
                    <img src="{{ asset('images/qris.jpg') }}" class="absolute top-0 left-0 w-full h-full object-cover" alt="qris">
                </div> --}}
                <div>
                    
                    <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer mb-5 bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="description" id="desc" cols="30" rows="10"></textarea>

                    <label for="event" class="block mb-2 text-sm font-medium  text-gray-900 dark:text-white">Event</label>
                    <select id="event" name="event_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($events as $event)
                            @if ($event->id == 1)
                                <option value="{{ $event->id }}" selected>Choose an Event</option>
                            @else
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    
                </div>
            
            </div>
            <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Donate</button>


            
        </form>

    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        var checkbox = document.getElementById('terms');
        checkbox.addEventListener('change', function() {
            
            if (checkbox.checked) {
                checkbox.value = '1';
            } else {
                checkbox.value = '';
            }
        });
    </script>
@endsection
