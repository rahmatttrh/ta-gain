<x-app-layout>
    @section('title')
    JOB REPORT
    @endsection
    <x-header>JOB REPORT</x-header>

    <div class="w-full overflow-hidden rounded shadow-xs mb-5">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">

                        <th class="px-4 py-3">Detail</th>
                        <th class="px-4 py-3">Kordinator</th>
                        <th class="px-4 py-3">Site</th>
                        <th class="px-4 py-3">Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($orders as $order)
                    @if ($order->status == 6)
                    <tr class="text-gray-700 dark:text-gray-400 ">
                        {{-- <td class="px-4 py-3">
                            @if ($order->jobphotos->status == '201')
                                alert
                            @endif
                        </td> --}}
                        <td class="px-4 py-3 text-xs">
                            <a href="{{ route('jobreport.detail', $order) }}" class="mr-2 bg-green-500 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-600">
                                Report
                            </a>

                            <a href="{{ route('job.detail.teknisi', $order) }}" class=" bg-teal-600 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
                        </td>

                        <td class="px-4 py-3">
                            <p class="text-sm ">
                                {{$order->kordinator->nama}}
                            </p>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$order->site}}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <p>Paket : {{formatRupiah($order->harga_paket)}}</p>
                            <p>Reimburse : {{formatRupiah($order->total_reimburse)}}</p>
                            <p><b>Grand Total : {{formatRupiah($order->grand_total)}}</b></p>
                            
                        </td>

                    </tr>
                    @else
                    @endif

                    @endforeach




                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>