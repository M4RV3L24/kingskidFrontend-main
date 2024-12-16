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
    <div class="mt-10 p-10 rounded-lg bg-gray-200 bg-opacity-50 dark:bg-slate-800 dark:bg-opacity-80 max-w-full mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

            @forelse ($donations as $donation)
                <div href="#"
                    class="h-auto block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $donation->created_at }}
                    </h5>
                    <p class="font-semibold text-gray-700 dark:text-gray-400">
                        {{ 'Rp ' . number_format($donation->nominal, 0, ',', '.') }}
                    </p>
                    <p class="my-3 break-words font-light text-gray-700 dark:text-gray-400">
                        
                <span class="short-description">{{ Str::limit($donation->description, 20) }}</span>
                        @if (strlen($donation->description) > 100)
                            <span class="read-more" style="display: none;">{{ $donation->description }}</span>
                            <a href="javascript:void(0);" class="read-more-toggle text-blue-500">Read More</a>
                        @endif
                    </p>
                    <p class="my-3 break-words font-medium italic text-blue-500  dark:text-gray-400">
                        {{ $donation->name . ' & ' . $donation->email }} </p>


                </div>

            @empty
                <div class="col-span-3 text-center">
                    <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">No donations found.</p>
                </div>
            @endforelse


        </div>

    </div>
@endsection


@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreToggles = document.querySelectorAll('.read-more-toggle');
        readMoreToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const shortDescription = this.previousElementSibling.previousElementSibling;
                const fullDescription = this.previousElementSibling;
                if (fullDescription.style.display === 'none') {
                    fullDescription.style.display = 'inline';
                    shortDescription.style.display = 'none';
                    this.textContent = 'Read Less';
                } else {
                    fullDescription.style.display = 'none';
                    shortDescription.style.display = 'inline';
                    this.textContent = 'Read More';
                }
            });
        });
    });
</script>
@endsection
