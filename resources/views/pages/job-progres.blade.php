<x-app-layout>
  @section('title')
  Job Progress
  @endsection
  <x-header><span class="font-bold">LIST</span> JOB PROGRESS</x-header>

  <x-menu-job></x-menu-job>


  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
    <div class="w-full overflow-x-auto">
      <x-alert></x-alert>
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3"></th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Kordinator</th>
            <th class="px-4 py-3">Client</th>
            <th class="px-4 py-3">Site</th>
            {{-- <th class="px-4 py-3">Harga</th> --}}
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($orders as $key => $order)
          <tr class="text-gray-500 dark:text-gray-400 ">
            <td class="px-4 py-3">
              {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
            </td>
            <td class="px-4 py-3 text-xs flex items-center">
              <a href="{{route('job.edit', $order)}}" class=" mr-2 bg-green-400  text-gray-100 py-1 px-4 rounded-full  leading-tight hover:bg-green-500">Edit</a>
              <a href="{{route('job.detail.admin', $order)}}" class=" bg-teal-600   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
            </td>
            <td class="px-4 py-3">
              @if ($order->status == 3)
                <p class="text-md text-sm text-green-400">Menunggu Tanggapan Kordinator</p>
                @elseif($order->status == 4)
                <p class="text-md text-sm text-green-400">Menunggu Delegasi ke Teknisi</p>
                @elseif($order->status == 5)
                <p class="text-md text-sm text-blue-400">On Progress</p>
                 @elseif($order->status == 202)
                 <p class="text-md text-sm text-red-400">Pending</p>
              @endif

              {{-- @if ()
                
              @endif
              @if ($order->status == 5)
                <p class="text-md text-sm text-blue-400">On Progress</p>
              @endif
              @if ($order->status == 202)
                <p class="text-md text-sm text-red-400">Pending</p>
              @endif --}}
              
            </td>
            <td class="px-4 py-3">
              <p class="text-sm">
                @if ($order->kordinator_id)
                {{$order->kordinator->nama}}
                @endif
              </p>
            </td>
            <td class="px-4 py-3">
              <p class="text-sm font-semibold">
                {{$order->pelanggan->nama}}
              </p>
            </td>
            <td class="px-4 py-3">
              <p class="text-sm">
                {{$order->site}}
              </p>
            </td>
            {{-- <td class="px-4 py-3 text-sm">
              <p class="text-md font-semibold ">Paket : {{$order->harga_paket}}</p>
              <p class="text-md font-semibold ">All : {{$order->harga_all}}</p>
            </td> --}}


          </tr>
          @endforeach




        </tbody>
      </table>
    </div>

</x-app-layout>