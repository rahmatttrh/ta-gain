<x-app-layout>
  @section('title')
  List Job Order
  @endsection
  <x-header>LIST JOB ORDER</x-header>

  <x-alert></x-alert>

  <!-- Table -->
  <div class="w-full mb-5  overflow-hidden rounded shadow-xs">
    <div id="main" class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap ">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left bg-gray-200 dark:bg-gray-900  text-gray-500 dark:text-gray-400 uppercase border-b dark:border-gray-700  ">
            <th class="px-4 py-3">No</th>
            <th class="px-2 py-3">Action</th>
            <th class="px-4 py-3">Site</th>
            <th class="px-2 py-3">Status</th>
            <th class="px-4 py-3">Kordinator</th>
            <th class="px-4 py-3">Harga</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($orders as $key => $order)
          @if ($order->status == '6' || $order->status == '7' || $order->status == '8')

          @else
          <tr class="text-gray-700 dark:text-gray-400 ">
            <td class="px-4 py-3">
              {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
            </td>
            <td class="px-4 py-3 text-xs flex ">
              <a href="{{route('job.detail.client', $order)}}" class=" bg-teal-600 font-semibold  text-gray-100 py-1 px-4 pr-8 mr-2 rounded-full leading-tight hover:bg-blue-400">Detail</a>
              @if ($order->status<='4') <form action="{{route('job.cancel.client') }}" method="post" id="cancel">
                @csrf
                <input type="hidden" name="id" id="orderId">
                <button type="sumbit" data-id="{{$order->id}}" class="cancel mr-1 bg-red-500 text-center text-gray-100 py-1 px-4 pr-8 rounded-full font-semibold  hover:bg-red-600">Cancel</button>
                </form>
                @endif
            </td>
            <td class="px-4 py-3 text-sm">
              {{$order->site}}
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
              {{-- <p class="text-sm text-blue-400">
                <?php if ($order->status == '3') {
                  echo 'Menunggu Tanggapan Kordinator';
                } else if ($order->status == '4') {
                  echo 'Menunggu Delegasi ke Teknisi';
                } else if ($order->status == '5') {
                  echo 'On Progress';
                } else {
                  echo 'Waiting';
                }
                ?> --}}

              </p>
            </td>
            <td class="px-4 py-3">
              <p class="text-sm">
                @if ($order->kordinator_id)
                {{$order->kordinator->nama}}
                @endif
              </p>
            </td>


            <td class="px-4 py-3 text-sm">
              <p>Paket : {{formatRupiah($order->harga_paket)}}</p>
              <p>Reimburse : {{formatRupiah($order->total_reimburse)}}</p>
              <p><b>Grand Total : {{formatRupiah($order->grand_total)}}</b></p>
            </td>
          </tr>
          @endif
          @endforeach


        </tbody>
      </table>


    </div>
    <div class="flex mt-2">
      {{ $orders->links() }}
    </div>
    <hr class="mb-2 mt-10">
    <x-info>> Fitur ini digunakan untuk melihat semua order.</x-info>

  </div>
  <!-- end table -->
</x-app-layout>

<script>
  $(".cancel").click(function(e) {
    // event.preventDefault();
    event.preventDefault();
    id = e.target.dataset.id;
    $('#orderId').val(id);

    swal({
        title: "Cancel",
        text: "Anda yakin ingin cancel order ini ?",
        icon: "warning",
        buttons: ["Batal", "Ya"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Berhasil! Order telah di cancel!", {
            icon: "success",
          });
          $(`#cancel`).submit();
        } else {
          swal("Batal Cancel.");
        }
      });
  })
</script>