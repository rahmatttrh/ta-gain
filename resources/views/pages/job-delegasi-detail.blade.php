<x-app-layout>
    @section('title')
    Draft Job Order
    @endsection
    <div class="flex">
        <a href="{{route('job.delegasi')}}" class=" mb-4 w-12 f item-center  mr-2 shadow-xs dark:bg-gray-700 text-blue-400 font-bold  p-3 rounded">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path>
            </svg>
        </a>
        <x-header><span class="font-bold">LIST</span> JOB DELEGASI</x-header>
    </div>

    <!-- <x-menu-job></x-menu-job> -->

    <form action="{{route('job.delegasi')}}" method="POST" class="overflow-x-auto">
        @csrf

        <!-- <div class="flex items-center mb-4"> -->
        <div class="mb-4 flex items-end">
            <div class="w-1/4 mr-2">
                <label for="" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Kordinator</label>
                <select name="kordinator" class="w-full mr-2 bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" required>
                    <option disabled selected>Pilih</option>
                    @foreach ($kordinators as $kordinator)
                    <option value="{{$kordinator->id}}">{{$kordinator->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/8 mr-2">
                <label for="" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Site</label>
                {{-- <label for="" class="block  uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2"> Site</label> --}}
                <div class="flex">
                    <span id="total" class="w-full   bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></span>
                </div>

            </div>
            <div class="w-1/4 mr-2">
                <button type="submit" name="submit" onclick="konfirmasi()" class="mr-2 px-6 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">Hand Over</button>
            </div>
        </div>



        <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
            <div id="main" class="w-full overflow-x-auto">

                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">
                                <input type="checkbox" name="" id="selectall">
                            </th>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Client</th>
                            <th class="px-4 py-3">Site</th>
                            <th class="px-4 py-3">Alamat</th>
                            <th class="px-4 py-3">Lat - Long</th>
                            <th class="px-4 py-3">Nama Projek</th>
                            <th class="px-4 py-3">Ukuran</th>
                            <th class="px-4 py-3">Sistem Antena</th>
                            <th class="px-4 py-3">Jenis Pekerjaan</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Modem</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($orders as $key => $order)
                        <tr class="text-gray-500 dark:text-gray-400 ">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="case" name="id_item[]" value="{{$order->id}}" />
                            </td>
                            <td class="px-4 py-3">
                                {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm font-semibold">
                                    {{$order->pelanggan->nama}}
                                </p>
                            </td>
                            <td class="px-4 py-3">
                                {{$order->site}}
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm">
                                    {{$order->kabupaten}},{{$order->provinsi}}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{$order->alamat}}
                                </p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm">{{$order->latitude}}, {{$order->longitude}}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm font-semibold">
                                    {{$order->nama_projek}}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{$order->no_telpon}}
                                </p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm">{{$order->ukuran}}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm">{{$order->system_antena}}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm">{{$order->jenis_pekerjaan}}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm font-semibold ">{{$order->grand_total}}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm">{{$order->modem}}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </form>
</x-app-layout>

{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script>
    $(document).ready(function() {
        $('.tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });


    var total = document.getElementById("total");
    // var total = document.getElementById("total").value;
    var jumlahCheck = 0;
    total.innerHTML = jumlahCheck;

    $(function() {

        $("#selectall").change(function() {
            if (this.checked) {
                $(".case").each(function() {
                    this.checked = true;
                });
                var jumlahCheck = $(".case").length;
            } else {
                $(".case").each(function() {
                    this.checked = false;
                });
                var jumlahCheck = 0;
            }

            // menampilkan output ke elemen hasil
            total.innerHTML = jumlahCheck;
            // console.log(jumlahCheck);
        });

        $(".case").click(function() {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;
                var jumlahCheck = $('input:checkbox:checked').length;

                $(".case").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $("#selectall").prop("checked", true);

                    jumlahCheck = $(".case").length;
                }


            } else {
                $("#selectall").prop("checked", false);

                jumlahCheck = $('input:checkbox:checked').length;
            }
            total.innerHTML = jumlahCheck;
            console.log(jumlahCheck);

        });

    });

    // $(".delegate").click(function(e){
    //       // event.preventDefault();
    //       event.preventDefault();
    //       id = e.target.dataset.id;
    //       swal({
    //         title: "Anda yakin?",
    //         text: "Anda akan delegasi order.",
    //         icon: "warning",
    //         buttons: ["Batal", "Ya"],
    //         dangerMode: true,
    //       })
    //       .then((willDelete) => {
    //         if (willDelete) {
    //           swal("Berhasil!", {
    //             icon: "success",
    //           });
    //           $(`#delegate`).onClick(konfirmasi());
    //         } else {
    //           swal("Batal menghapus.");
    //         }
    //       });
    //     })

    function konfirmasi() {
        confirm("Apakah anda yakin ingin mendelegasikan order ini ?");
    }
</script>