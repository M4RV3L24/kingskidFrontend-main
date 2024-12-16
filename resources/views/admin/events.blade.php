@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <!-- DataTables Buttons CSS dan JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection


@section('content')
    <h2 class="font-semibold text-center text-3xl mb-2">Event Management</h2>
    <div class="grid grid-cols-2 gap-5 p-2 my-3 bg-indigo-300 rounded-lg">

        <form action="{{ route('admin.event.add') }}" method="POST" class="p-3 max-w-xl">
            @csrf
            <div class="mb-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal</label>
                <input type="number"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="nominal" name="nominal" required>
            </div>
            <div class="grid grid-cols-2 mb-3 gap-x-3">

                <div class="">
                    <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                        Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="">
                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                        Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="overflow-y-auto p-3 max-h-96">
            {{-- progress bar between event needed amount and total donation --}}
            @foreach ($events as $event)
                @if ($loop->iteration == 1)
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-base font-medium text-blue-700 dark:text-white">{{ $event->name }}</span>
                            <span class="text-sm font-medium text-blue-700 dark:text-white">{{ $event->available }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                        </div>

                    </div>
                @else
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-base font-medium text-blue-700 dark:text-white">{{ $event->name }}</span>
                            <span
                                class="text-sm font-medium text-blue-700 dark:text-white">{{ $event->available . '/' . $event->nominal }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full"
                                style="width: {{ ($event->available / $event->nominal) * 100 > 100 ? 100 : ($event->available / $event->nominal) * 100 }}%">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 col-span-full">
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


        <table id="eventTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Nominal</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->nominal }}</td>
                        <td>{{ $event->start_date . ',' . $event->end_date }}</td>
                        <td>
                            <a href="{{ route('admin.event.restore', $event->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.event.delete') }}" method="POST" class="inline">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $event->id }}">
                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('#eventTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                ordering: true,
                paging: true,
                pageLength: 10,
                columnDefs: [{
                        targets: 3,
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                    },
                    {
                        targets: 4,
                        render: function(data) {
                            let start_date = new Date(data.split(',')[0]).toLocaleString('id-ID', {
                                timeZone: 'Asia/Jakarta',
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric',
                            });

                            let end_date = new Date(data.split(',')[1]).toLocaleString('id-ID', {
                                timeZone: 'Asia/Jakarta',
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric',
                            });

                            return start_date + " - " + end_date;
                        }
                    }
                ]

            });
        });
    </script>
@endsection
