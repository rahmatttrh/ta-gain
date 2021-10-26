<x-app-layout>
    @section('title')
    Draft Job Order
    @endsection
    <x-header><span class="font-bold">LIST</span> JOB DELEGASI KE TEKNISI</x-header>

    <!-- <x-menu-job></x-menu-job> -->

    <form action="{{route('kordinator.delegasi')}}" method="POST" class="overflow-x-auto">
        @csrf

        <div class="mb-4 md:flex items-end pt-2">
            <div class="w-1/2 mr-2">
                {{-- <label for="" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Teknisi</label> --}}

                <select name="teknisis[]" multiple="multiple" class="js-example-basic-multiple w-full mr-2 bg-gray-200 border border-gray-200 text-gray-700  px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" >
                    @foreach ($teknisis as $teknisi)
                    <option value="{{$teknisi->id}}">{{$teknisi->nama}}</option>
                    @endforeach
                </select>

            </div>
            <div class="flex items-end">
                <span id="total" class=" mr-2 bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></span>
                <button type="submit" name="submit" onclick="konfirmasi()" class="w-full mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">Delegasi</button>
            </div>
        </div>

        @error('teknisis')
        <div class="flex flex-col  mb-2 bg-red-500 p-2 rounded">
             <span class="text-sm w-full text-gray-100">Teknisi belum dipilih !</span> 
            {{-- @error('item_id') <span class="text-sm w-full text-red-500">Harga belum di isi</span> @enderror --}}
        </div>
        @enderror
        @error('id_item')
        <div class="flex flex-col  mb-2 bg-red-500 p-2 rounded">
             <span class="text-sm w-full text-gray-100">Site Order belum dipilih !</span> 
            {{-- @error('item_id') <span class="text-sm w-full text-red-500">Harga belum di isi</span> @enderror --}}
        </div>
        @enderror

        <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
            <div class="w-full overflow-x-auto">

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
                                <p class="text-sm ">
                                    {{$order->pelanggan->nama}}
                                </p>
                            </td>
                            <td class="px-4 py-3 text-sm">
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
                            <td class="px-4 py-3 text-sm">
                                <p>{{$order->latitude}}, {{$order->longitude}}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm">
                                    {{$order->nama_projek}}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{$order->no_telpon}}
                                </p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p>{{$order->ukuran}}</p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p>{{$order->system_antena}}</p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p>{{$order->jenis_pekerjaan}}</p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p>Paket : {{formatRupiah($order->harga_paket)}}</p>
                                <p>Reimburse : {{formatRupiah($order->total_reimburse)}}</p>
                                <p><b>Grand Total : {{formatRupiah($order->grand_total)}}</b></p>
                               
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <p>{{$order->modem}}</p>
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

    function konfirmasi() {
        confirm("Apakah anda yakin ingin mendelegasikan order ini ?");
    }

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>