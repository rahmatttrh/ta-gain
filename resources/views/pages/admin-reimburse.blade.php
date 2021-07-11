<x-app-layout>
    @section('title')
    Daftar Reimburse
    @endsection
    <x-header><span class="font-bold">REIMBURSE</span> JOB ORDER</x-header>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Site</th>
                        <th class="px-4 py-3">Kordinator</th>
                        <th class="px-4 py-3">Keterangan Biaya</th>
                        <th class="px-4 py-3">Nominal </th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($reimbures as $key => $reimburse)
                    <tr class="text-gray-700 dark:text-gray-400 ">
                        <td class="px-4 py-3">
                            {{ ($reimbures->currentpage()-1) * $reimbures->perpage() + $key + 1 }}
                        </td>
                        <td class="px-4 py-3">
                            <p>{{$reimburse->order->site}}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p>{{$reimburse->order->kordinator->nama}}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p>{{$reimburse->keterangan}}</p>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <p class="font-semibold">{{formatRupiah($reimburse->nominal)}}</p>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href=""><img width="75px" style="cursor: pointer;" class="rounded" src="{{asset('storage/' .$reimburse->bukti_nota_kordinator)}}" alt=""></a>
                        </td>


                        @if ($reimburse->status == '1')
                        <!-- <td class="px-4 py-3 text-sm">
                            <p class='text-md text-sm text-blue-400'> Menunggu Validasi Client</p>
                        </td> -->

                        <td class="px-4 py-3 text-sm">
                            <a href='{{route('validasi.reimburse', $reimburse)}}' class=" bg-red-600 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded leading-tight hover:bg-red-400">
                                Validasi
                            </a>
                        </td>

                        <td></td>
                        @elseif($reimburse->status == '2')
                        <td class="px-4 py-3 text-sm">
                            <p class='text-md text-sm text-yellow-400'> Menunggu Approval Client</p>
                        </td>
                        <td></td>
                        @elseif($reimburse->status == '201' && auth()->user()->isTeknisi())

                        <td class="px-4 py-3 text-sm">
                            <p class="font-semibold">{{$reimburse->keterangan}}</p>
                        </td>
                        @elseif($reimburse->status == '3')
                        <td class="px-4 py-3 text-sm">
                            <p class='text-md text-sm text-green-400'> Done</p>
                        </td>
                        @endif



                        {{-- <?php

                                if ($reimburse->status == '201') { ?>
                            <td class="px-4 py-3 text-sm">
                                <a href='#tolak' rel="modal:open">
                                    <button class="modalReject mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-red-400 to-red-500 hover:from-red-300 hover:to-red-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal" data-id="{{$reimburse->id}}">Revisi</button>
                        </a>
                        </td>
                    <?php } else { ?>
                        <td class="px-4 py-3 text-sm"></td>
                        <td class="px-4 py-3 text-sm"></td>
                    <?php } ?> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</x-app-layout>