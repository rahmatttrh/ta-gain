<x-app-layout>
    @section('title')
    Job Report
    @endsection
    <x-header>VALIDATE JOB ORDER</x-header>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap basic-datatables">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left bg-gray-50 dark:bg-gray-900  text-gray-500 dark:text-gray-400 uppercase border-b dark:border-gray-700  ">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Action</th>
                        <th class="px-4 py-3">Site</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Kordinator</th>
                        {{-- <th class="px-4 py-3">Harga</th> --}}
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($orders as $key => $order)
                    <tr class="text-gray-700 dark:text-gray-400 ">
                        <td class="px-4 py-3">
                            {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
                        </td>

                        <td class="px-2 py-3 text-xs flex " >
                            @if ($order->status == 7)
                                    <form action="{{ route('approve.bast', $order) }}" method="post" id="approve">
                                        @csrf
                                        <input type="hidden" name="id" id="id">
                                        <button type="sumbit" data-id="{{$order->id}}" class="approve mr-1 bg-blue-400 text-center text-gray-100 py-1 px-4 pr-8 rounded-full   hover:bg-blue-500">Approve BAST</button>
                                    </form>
                                    <a href="{{route('download.bast', $order)}}" class="mr-1 bg-green-500   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-600">Download BAST</a>
                                
                                @else
                                 <a href="{{route('client.jobreport.detail', $order)}}" class="mr-2 bg-green-500   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-600">Report</a>
                                
                            @endif
                            <a href="{{route('job.detail.client', $order)}}" class=" bg-teal-600   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
                           
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$order->site}}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @if ($order->status == 6)
                            <p class="text-md text-blue-400">Validasi Report</p>
                            @elseif($order->status == 7)
                            <p class="text-md text-green-400">Validasi BAST</p>
                            @endif
                            @if ($order->bast)
                                <p class="text-md text-gray-400">BAST Uploaded</p>
                            @else
                            <p class="text-xs text-gray-400">BAST Empty</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm ">
                                @if ($order->kordinator_id)
                                {{$order->kordinator->nama}}
                                @endif
                            </p>
                        </td>
                        {{-- <td class="px-4 py-3 text-sm">
                            <p>Paket : {{formatRupiah($order->harga_paket)}}</p>
                            <p>Reimburse : {{formatRupiah($order->total_reimburse)}}</p>
                            <p><b>Grand Total : {{formatRupiah($order->grand_total)}}</b></p>
                            
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</x-app-layout>

<script>
  $(".approve").click(function(e) {
    // event.preventDefault();
    event.preventDefault();


    // id = e.target.dataset.id;
    swal({
        title: "Approve",
        text: "Anda yakin BAST sudah lengkap?",
        icon: "warning",
        buttons: ["Batal", "Ya"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
        //   swal("Berhasil! Pekerjaan telah selesai!", {
        //     icon: "success",
        //   });
          const id = $(this).data('id');
          $('#id').val(id);
          $(`#approve`).submit();
        } else {
          swal("Batal Approve.");
        }
      });
  })
</script>