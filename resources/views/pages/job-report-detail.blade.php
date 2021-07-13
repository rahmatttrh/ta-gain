<x-app-layout>
    @section('title')
    Detail Job Report
    @endsection
    <div class="flex">

        <x-header><span class="font-bold">ADD</span> JOB REPORT {{$order->site}}</x-header>
    </div>


    @if (auth()->user()->isTeknisi())
    <!-- Form -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs  mb-4">
        <div class="mt-4 mb-2 px-5">
            <form action="{{route('jobreport.create.teknisi')}}" method="POST" class="w-full md:flex" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <input type="hidden" name="pelanggan_id" value="{{$order->pelanggan_id}}">
                <input type="hidden" name="teknisi_id" value="{{$teknisi->id}}">
                <div class="mr-4 w-full">
                    <div class="mb-4">
                        <label for="judul_foto" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Judul Foto</label>
                        <input type="text" name="judul_foto" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Judul Foto...">
                        @error('judul_foto') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 ">
                        <label for="deskripsi_foto" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Deskripsi </label>
                        <textarea name="deskripsi_foto" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="" cols="35" rows="3" placeholder=" Deskripsi Foto......."></textarea>
                        @error('deskripsi_foto') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                   
                </div>
                <div class="w-full">
                    <div class="mb-4">
                        <label for="foto_pekerjaan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Foto Pekerjaan</label>
                        <input class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="foto_pekerjaan" type="file">
                        <img class="w-1/2 mr-2 rounded" src="">
                        @error('foto_pekerjaan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <button class="flex items-center justify-center w-full px-6 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end form -->
    @endif
    @if ($jobphotos == !null)
        <a href="{{route('get.zip', $order)}}" class="flex mb-4 items-center justify-center w-full px-6 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-teal-500  rounded active:bg-teal-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-teal">
            Download Report
        </a>
    @endif
    
    <!-- Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
        <div class="w-full overflow-x-auto">
            <x-alert></x-alert>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Judul Pekerjaan</th>
                        <th class="px-4 py-3">Deskripsi </th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @foreach ($jobphotos as $key => $job)
                    <tr class="text-gray-700 dark:text-gray-400 ">
                        <td class="px-4 py-3">
                            {{ ($jobphotos->currentpage()-1) * $jobphotos->perpage() + $key + 1 }}
                          </td>
                        {{-- <td class="px-4 py-3 text-sm">
                            <?php
                            if ($job->status == '1') {
                                # code...
                                echo "<p class='font-semibold'> Menunggu Validasi Client</p>";
                            } else if ($job->status == '2') {
                                echo "<p class='font-semibold'> Terverifikasi</p>";
                            }
                            if ($job->status == '201') {
                                echo "<p class='font-semibold'> Reject</p>";
                            }  ?>
                        </td> --}}
                        <td class="px-4 py-3">
                            <p class="font-semibold">{{$job->judul_foto}}</p>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <p class="font-semibold">{{$job->deskripsi_foto}}</p>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('report.foto', $job) }}"><img  width="75px" style="cursor: pointer;" class="rounded" src="{{asset('storage/app/' .$job->foto_pekerjaan)}}" alt=""></a>
                            {{-- <img width="75px" class="rounded" src="{{asset('storage/' .$job->foto_pekerjaan)}}" alt=""> --}}
                        </td>

                        
                        @if ($job->status == '1')
                        <td class="px-4 py-3 text-sm">
                            <p class='text-md text-sm text-blue-400'> Menunggu Validasi Client</p>
                        </td>
                        <td></td>
                        @elseif($job->status == '2')
                        <td class="px-4 py-3 text-sm">
                            <p class='text-md text-sm text-green-400'> Terverifikasi</p>
                        </td>
                        <td></td>
                        @elseif($job->status == '201' && auth()->user()->isTeknisi())
                        <td class="px-4 py-3 text-sm">
                            <a href='{{route('revisi.report', $job)}}' class=" bg-red-600 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded leading-tight hover:bg-red-400">
                                Revisi
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <p class="font-semibold">{{$job->keterangan}}</p>
                        </td>
                        @endif
                    


                        {{-- <?php

                        if ($job->status == '201') { ?>
                            <td class="px-4 py-3 text-sm">
                                <a href='#tolak' rel="modal:open">
                                    <button class="modalReject mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-red-400 to-red-500 hover:from-red-300 hover:to-red-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal" data-id="{{$job->id}}">Revisi</button>
                                </a>
                            </td>
                           
                            <td class="px-4 py-3 text-sm">
                                <p class="font-semibold">{{$job->keterangan}}</p>
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
    </div>
    <!-- Endtable -->

    <!-- Modal -->
    {{-- <div id="tolak" class="modal">
        <h2 class="mt-3 mb-3"> Revisi</h2>
        <form action="{{route('jobreport.revisi.teknisi')}}" method="post">
            @csrf
            <input type="hidden" name="job_photo_id" id="job_photo_id">
            <div class="mb-4">
                <label for="judul_foto" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Judul Foto</label>
                <input type="text" name="judul_foto" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Judul Foto..." required>
                @error('judul_foto') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="deskripsi_foto" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi_foto" id="" cols="35" rows="5" placeholder=" Deskripsi Foto......."></textarea>
                @error('deskripsi_foto') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="foto_pekerjaan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Foto Pekerjaan</label>
                <input class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="revisi_foto_pekerjaan" type="file">
                <img class="w-1/2 mr-2 rounded" src="">
                @error('foto_pekerjaan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" name="submit" class="mt-3 mb-3 mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">Ya, saya yakin</button>
        </form>
    </div> --}}


</x-app-layout>

{{-- <script>
    $(function() {

        $('.modalReject').on('click', function() {

            const id = $(this).data('id');

            $('#job_photo_id').val(id);
        });
    });
</script> --}}