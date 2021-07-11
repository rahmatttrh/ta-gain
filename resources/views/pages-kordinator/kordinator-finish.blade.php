<x-app-layout>
  @section('title')
  Finish Job Order
  @endsection
  <x-header>FINISH JOB ORDER</x-header>

  <div class="w-full overflow-hidden rounded shadow-xs mb-5">
    <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left bg-gray-200 dark:bg-gray-900  text-gray-500 dark:text-gray-400 uppercase border-b dark:border-gray-700  ">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Action</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Site</th>
            <th class="px-4 py-3">Client</th>
            <th class="px-4 py-3">Harga</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($orders as $key => $order)
          <tr class="text-gray-700 dark:text-gray-400 ">
            <td class="px-4 py-3">
              {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
            </td>
            <td class="px-4 py-3 text-xs">

              {{-- <a href="{{route('bast', $order)}}" class=" items-center mr-1 bg-green-500 text-gray-100 py-1 px-4 rounded-xl leading-tight hover:bg-green-600">
              <span>BAST</span>
              </a> --}}
              <a href="{{route('download.bast', $order)}}" class=" items-center mr-1 bg-green-500 text-gray-100 py-1 px-4  rounded-xl leading-tight hover:bg-green-600">Download BAST</a>
    </div>
    <a href="{{route('job.detail.kordinator', $order)}}" class=" bg-teal-600 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
    </td>
    <td class="px-4 py-3 text-xs">
      @if ($order->status == 6)
      <p class="text-md text-blue-400">Progress Report</p>
      @elseif($order->status == 7)
      <p class="text-md text-green-400">Report Tervalidasi</p>
      @endif

    </td>
    <td class="px-4 py-3 text-sm">
      {{$order->site}}
    </td>
    <td class="px-4 py-3 text-sm font-semibold">
      {{$order->pelanggan->nama}}
    </td>

    <td class="px-4 py-3 text-sm">
      <p>Paket : {{formatRupiah($order->harga_paket)}}</p>
      <p>Reimburse : {{formatRupiah($order->total_reimburse)}}</p>
      <p><b>Grand Total : {{formatRupiah($order->grand_total)}}</b></p>
      
    </td>


    </tr>
    @endforeach




    </tbody>
    </table>
  </div>

</x-app-layout>