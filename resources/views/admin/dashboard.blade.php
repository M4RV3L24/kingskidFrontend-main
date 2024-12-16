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
    <h2 class="text-3xl font-semibold mb-6 text-center">Dashboard Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- total number of transactions --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-2">Total Number of Transactions</h3>
            <p class="text-3xl font-bold" id="totalTransaction">{{ count($donations) }}</p>
        </div>

        {{-- total receipts connected --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-2">Total Amount</h3>
            <p class="text-3xl font-bold" id="totalAmount">{{ $totalAmount }}</p>
        </div>

        {{-- fundraiser status --}}
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


            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Nominal</th>
                        <th>Proof</th>
                        <th>Time</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donations as $donation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $donation->name }}</td>
                            <td>{{ $donation->email }}</td>
                            <td>{{ $donation->nominal }}</td>
                            <td><a class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    href="{{ asset('storage/' . $donation->proof) }}" target="_blank">open image</a></td>
                            <td>{{ $donation->created_at }}</td>
                            <td>{{ $donation->description }}</td>
                            {{-- delete donation --}}
                            <td>
                                <form action="{{ route('admin.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $donation->id }}">
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
@endsection

@section('script')
    <script>
        var table
        $(document).ready(function() {
            table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                ordering: true,
                paging: true,
                pageLength: 10,
                columnDefs: [
                    {
                        targets: 3,
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                    },
                    {
                        targets: 5,
                        render: function(data) {
                            return new Date(data).toLocaleString('id-ID', {
                                timeZone: 'Asia/Jakarta',
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric',
                            });
                        }
                    }
                ],
                drawCallback: function() {
                    updateTotalAmount();
                    updateTotalTransaction();
                }

            });
            function updateTotalAmount() {
                var totalAmount = 0;
                if (!table) {
                    console.error("Table is not defined.");
                    return;
                }
                table.rows({ search: 'applied' }).every(function() {
                    var data = this.data();
                    totalAmount += parseFloat(data[3]) || 0; // Assuming the nominal value is in the 4th column (index 3)
                });
                $('#totalAmount').text('Rp ' + totalAmount.toLocaleString('id-ID', {
                    minimumFractionDigits: 2
                }));
            }

            function updateTotalTransaction () {
                var totalTransaction = 0;
                if (!table) {
                    console.error("Table is not defined.");
                    return;
                }
                table.rows({ search: 'applied' }).every(function() {
                    totalTransaction += 1;
                });

                $('#totalTransaction').text(totalTransaction);
            }

            // Initial calculation
            updateTotalAmount();
            updateTotalTransaction();

             // Recalculate total amount on search
            table.on('search.dt', function() {
                updateTotalAmount();
            });


        });
    </script>
@endsection
