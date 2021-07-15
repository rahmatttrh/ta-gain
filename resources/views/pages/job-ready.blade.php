<x-app-layout>
  @section('title')
  Ready to Pay
  @endsection
  <x-header><span class="font-bold">READY TO PAY</span> JOB ORDER</x-header>
  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
    <div id="main" class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Aksi</th>
            <th class="px-4 py-3">Harga</th>
            <th class="px-4 py-3">Site</th>
            <th class="px-4 py-3">Kordinator</th>
            <th class="px-4 py-3">Client</th>
            

          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($orders as $key => $order)
          <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">
              {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
            </td>
            <td class="px-2 py-3 text-xs ">
              {{-- <a href="{{route('job.detail.admin', $order)}}" class=" bg-green-400 font-semibold text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-500">Upload</a> --}}
              <form action="{{ route('payment.konfirmasi', $order) }}" method="post" id="payment">
                @csrf
                <button type="sumbit" class="payment mr-1 mb-2 bg-blue-400 text-center text-gray-100 py-1 px-4 pr-8 rounded-full   hover:bg-blue-500">Konfirmasi</button>
              </form>

              <a href="{{route('job.detail.admin', $order)}}" class=" bg-teal-600   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
            </td>

            <td class="px-4 py-3 text-xs">
              <p>Paket : {{formatRupiah($order->harga_paket)}}</p>
              <p>Grand Total : {{formatRupiah($order->grand_total)}}</p>
            </td>
            <td class="px-4 py-3 text-sm">
              <p>{{$order->site}}</p>
            </td>
            <td class="px-4 py-3 ">
              @if ($order->kordinator_id)
              <p class="text-sm">{{$order->kordinator->nama}}</p>
              <p class="text-xs text-gray-600 dark:text-gray-400">
                {{$order->kordinator->no_hp}}
              </p>
              @endif
            </td>
            <td class="px-4 py-3 text-sm">
              <p class="">{{$order->pelanggan->nama}}</p>
              <p class="text-xs text-gray-600 dark:text-gray-400">
                {{$order->pelanggan->no_gm}}
              </p>
            </td>

            


          </tr>
          @endforeach





        </tbody>
      </table>
    </div>


</x-app-layout>