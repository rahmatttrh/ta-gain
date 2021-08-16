<x-app-layout>
  @section('title')
  Detail Job Order
  @endsection
  <div class="flex">
    <x-header><span class="font-bold">DETAIL</span> JOB ORDER</x-header>
  </div>


  <div class="grid gap-2 mb-2 md:grid-cols-1 xl:grid-cols-2">
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded shadow-xs dark:bg-gray-700">
      <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded dark:text-blue-100 dark:bg-blue-500">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
          <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <div>
        <p class=" text-lg font-semibold text-gray-700 dark:text-gray-200">
          {{$order->site}}
        </p>
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
          Projek : {{$order->nama_projek}}
        </p>
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
          {{$order->no_telpon}}
        </p>
        <p class="text-sm font-medium text-gray-400 dark:text-gray-300">
          {{$order->pelanggan->nama}}
        </p>
      </div>
    </div>
    <div class="flex items-center p-4 bg-white rounded shadow-xs dark:bg-gray-700">
      <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded dark:text-orange-100 dark:bg-orange-500">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
        </svg>
      </div>
      <div>
        <p class=" text-lg font-semibold text-gray-700 dark:text-gray-200">
          Kordinator : @if ($order->kordinator_id)
          {{$order->kordinator->nama}}
          @endif

        </p>
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
          Teknisi :
          @foreach ($order->teknisis as $teknisi)
          {{$teknisi->nama}},
          @endforeach
        </p>
        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
          @if ($order->kordinator_id)
          {{$order->kordinator->no_hp}}
          @endif

        </p>
      </div>
    </div>

  </div>

  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
    <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Alamat</th>
            <th class="px-4 py-3">LATLONG</th>
            <th class="px-4 py-3">Jenis Pekerjaan</th>
            <th class="px-4 py-3">Spesifikasi</th>
            <th class="px-4 py-3">Harga</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

          <tr class="text-gray-700 dark:text-gray-400 ">
            <td class="px-4 py-3">
              <p class="text-sm ">
                {{$order->kabupaten}},{{$order->provinsi}}
              </p>
              <p class="text-xs text-gray-600 dark:text-gray-400">
                {{$order->alamat}}
              </p>
            </td>
            <td class="px-4 py-3">
              <p class="text-sm">{{$order->latitude}}, {{$order->longitude}}</p>
            </td>
            <td class="px-4 py-3 ">
              <p class="text-sm">{{$order->jenis_pekerjaan}}</p>
            </td>
            <td class="px-4 py-3 ">
              <p class="text-sm font-semibold">
                Ukuran : {{$order->ukuran}}
              </p>
              <p class="text-xs text-gray-600 dark:text-gray-400">
                {{$order->system_antena}}, {{$order->modem}}
              </p>
            </td>

            <td class="px-4 py-3 text-sm">
              <p>Paket : {{formatRupiah($order->harga_paket)}}</p>
              <p>Reimburse : {{formatRupiah($order->harga_all)}}</p>
              <p>Grand Total : {{formatRupiah($order->grand_total)}}</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    {{-- @if($order->status < '7' ) <!-- -->
      @if (auth()->user()->isAdmin())
      <a href="{{route('job.reimburse.admin', $order)}}" class="flex items-center justify-center w-25 px-3 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-yellow-400 to-yellow-500 hover:from-yellow-300 hover:to-yellow-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
        Validasi Reimburse
      </a>
      @endif
      <!-- Kordinator -->
      @if (auth()->user()->isKordinator())
      <a href="{{route('job.reimburse.kordinator', $order)}}" class="flex items-center justify-center w-28 px-3 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-yellow-400 to-yellow-500 hover:from-yellow-300 hover:to-yellow-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
        Reimbursement
      </a>
      @endif
      <!--  -->
      @endif --}}
      <hr>
      @if ($order->status == '6' || $order->status == '7' || $order->status == '8' || $order->status == '9')
      <div class="flex items-center justify-between p-4 mb-2 mt-4   text-gray-50 bg-green-400 rounded  ">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
          </svg>
          <span class="font-semibold text-sm">Job Order telah selesai</span>
          <a href="{{ route('jobreport.detail', $order) }}" class="ml-6 mr-2 bg-white text-xs font-medium  text-gray-500 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-gray-100">
            Report
          </a>
          <a href="{{route('download.bast', $order)}}" class=" bg-white font-medium text-xs text-gray-500 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-gray-100">Download BAST</a>
        </div>
      </div>
      @elseif($order->status == 202)
      <div class="flex items-center justify-between p-4 mb-2 mt-4 text-sm font-semibold text-gray-50 bg-red-400 rounded  ">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
          </svg>
          <!-- <p>Pending Order</p> -->
          <p class="font-semibold"> Keterangan Pending : {{$order->keterangan_status}}</p>
        </div>
      </div>
      @else

      <div class="flex items-center justify-between p-4 mb-2 mt-4 text-sm font-semibold text-gray-50 bg-blue-400 rounded  ">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
          </svg>
          <span>Progres Aktifitas</span>
        </div>
      </div>
      @endif


      @if (auth()->user()->isKordinator())
      @if ($order->status == '6' || $order->status == '7' || $order->status == '8' || $order->status == '9')

      @else
      @if ($order->status == 202)
      @else
      <form action="{{route('job.activity', $order)}}" method="post" class="xl:flex  ">
        @csrf
        <div class="w-full mr-2">
          <input name="activity" type="text" class="  mb-2 block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Kegiatan ...">
        </div>

        <div class="flex items-center">
          <div class="mr-2">
            <input type="time" name="jam" class=" mb-2 block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
          </div>
          <div class="mr-2">
            <input type="date" name="tanggal" class="mb-2 block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
          </div>
          <button type="submit" class="w-full px-5 mb-2 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded sm:w-auto sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-teal">
            Save
          </button>
        </div>
      </form>
      @error('activity') <span class="flex items-center justify-between p-4 mb-4 text-sm  text-purple-100 bg-red-500 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">{{ $message }}</span> @enderror
      @error('jam') <span class="flex items-center justify-between p-4 mb-4 text-sm  text-purple-100 bg-red-500 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">{{ $message }}</span> @enderror
      @error('tanggal') <span class="flex items-center justify-between p-4 mb-4 text-sm  text-purple-100 bg-red-500 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">{{ $message }}</span> @enderror
      
      @endif


      <div class="flex ">
        @if ($order->status == 202)
        <form action="{{route('continue.job', $order)}}" method="post" id="continue" class="mr-1">
          @csrf
          <button type="sumbit" class="w-full jobcontinue px-3 mb-2  py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-teal">Continue Order</button>
        </form>
        @else
        <form action="{{route('finish.job', $order)}}" method="post" id="finish" class="mr-1">
          @csrf
          <button type="sumbit" class="w-full jobfinish px-3 mb-2  py-1 text-xs  leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-2xl  active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-teal">Finish Order</button>
        </form>
        {{-- <a href='#pending' rel="modal:open">
          <button class="w-full modalReject px-3 mb-2  py-1 text-xs  leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-2xl sm:w-auto sm:px-4 sm:py-2 active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-teal" data-id="{{$order->id}}">Pending Order</button>
        </a> --}}
        @endif

      </div>

      @endif
      @endif



      <div class=" w-full overflow-hidden rounded-lg shadow-xs mb-5">
        <div class="w-full overflow-x-auto">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Aktivitas</th>
                <th class="px-4 py-3">Jam</th>
                <th class="px-4 py-3">Tanggal</th>
                {{-- <th class="px-4 py-3">Durasi</th> --}}
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              @foreach ($activities as $key => $act)
              <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3  text-sm">
                  {{ ($activities->currentpage()-1) * $activities->perpage() + $key + 1 }}
                </td>
                <td class="px-4 py-3 text-sm">
                  <p class="">{{$act->kegiatan}}</p>
                </td>
                <td class="px-4 py-3 text-sm">
                  <p class="">{{$act->jam}}</p>
                </td>
                <td class="px-4 py-3 text-sm">
                  <p class="">{{$act->tanggal}}</p>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>

        <div id="pending" class="modal">
          <h2 class="mt-3 mb-3"> Alasan Pending</h2>
          <form action="{{route('pending.job')}}" method="post">
            @csrf
            <input type="hidden" name="id" id="id">
            <textarea class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="keterangan_status" id="" cols="44" rows="10" placeholder="Contoh : Pending karena akse ke lokasi sulit"></textarea><br>
            <button type="submit" name="submit" class="mt-3 mb-3 mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">Submit</button>
          </form>
        </div>

</x-app-layout>

<script>
  $(".jobfinish").click(function(e) {
    // event.preventDefault();
    event.preventDefault();
    id = e.target.dataset.id;
    swal({
        title: "WARNING",
        text: "Anda yakin telah menyelesaikan Order ini?",
        icon: "warning",
        buttons: ["Batal", "Ya"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Berhasil! Order telah selesai!", {
            icon: "success",
          });
          $(`#finish`).submit();
        } else {
          swal("Batal.");
        }
      });
  })

  $('.modalReject').on('click', function() {

    const id = $(this).data('id');

    $('#id').val(id);
  });

  $(".jobpending").click(function(e) {
    // event.preventDefault();
    event.preventDefault();
    id = e.target.dataset.id;
    swal({
        title: "WARNING",
        text: "Anda yakin ingin Pending Order ini?",
        icon: "warning",
        buttons: ["Batal", "Ya"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Berhasil! Order telah di Pending!", {
            icon: "success",
          });
          $(`#pending`).submit();
        } else {
          swal("Batal.");
        }
      });
  })

  $(".jobcontinue").click(function(e) {
    // event.preventDefault();
    event.preventDefault();
    id = e.target.dataset.id;
    swal({
        title: "WARNING",
        text: "Anda yakin ingin melanjutkan Order ini?",
        icon: "warning",
        buttons: ["Batal", "Ya"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Berhasil! Order dilanjutkan!", {
            icon: "success",
          });
          $(`#continue`).submit();
        } else {
          swal("Batal.");
        }
      });
  })
</script>