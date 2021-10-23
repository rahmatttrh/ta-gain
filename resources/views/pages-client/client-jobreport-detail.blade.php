<x-app-layout>
    @section('title')
    Detail Job Report
    @endsection
    <div class="flex">

        <x-header><span class="font-bold">REPORT</span> JOB ORDER {{$order->site}}</x-header>
    </div>
    

    <!-- Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
        <div class="w-full overflow-x-auto">
            <x-alert></x-alert>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php $kondisi = 1; ?>
                    @foreach ($jobphotos as $key => $job)
                    <tr class="text-gray-700 dark:text-gray-400 ">
                        <td class="px-4 py-3">
                            {{ ($jobphotos->currentpage()-1) * $jobphotos->perpage() + $key + 1 }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            
                            <a href="{{ route('report.foto', $job) }}"><img  width="75px" style="cursor: pointer;" class="rounded" src="{{asset('storage/' .$job->foto_pekerjaan)}}" alt=""></a>
                            {{-- <a href="{{ route('report.foto', $job) }}"><img  width="75px" style="cursor: pointer;" class="rounded" src="{{asset('storage/app/' .$job->foto_pekerjaan)}}" alt=""></a> --}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <p class="font-medium">{{$job->judul_foto}}</p>
                            <p class="">{{$job->deskripsi_foto}}</p>
                        </td>
                        
                        
                        
                        <td class="px-4 py-3 text-xs">
                            <?php
                            if ($job->status == '1') {
                                $kondisi = $kondisi * 0;
                            ?>
                            @if (auth()->user()->isAdmin() || auth()->user()->isClient())
                                <a href='#setuju' rel="modal:open">
                                    <button class="modalApprove mr-2 px-4 py-1  leading-5 text-white transition-all duration-300 bg-green-500 hover:bg-green-700 rounded-full focus:outline-none focus:shadow-outline-teal" data-id="{{$job->id}}">Approve</button>
                                </a>

                                <a href='#tolak' rel="modal:open">
                                    <button class="modalReject mr-2 px-4 py-1   leading-5 text-white transition-all duration-300 bg-red-400 hover:bg-red-600 rounded-full active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal" data-id="{{$job->id}}">Reject</button>
                                </a>
                            @else
                                <p class='text-md text-sm text-blue-400'> Menunggu Validasi</p>
                            @endif

                            <?php } else if ($job->status == '2') {
                                $kondisi = $kondisi * 1;
                            ?>
                                <p class='text-md text-sm text-green-400'> Terverifikasi</p>
                            <?php  } else if ($job->status == '201') {
                                $kondisi = $kondisi * 0;
                            ?>
                                <p class='text-md text-sm text-blue-400'> Menunggu Revisi</p>
                            <?php  } ?>

                            <div id="setuju" class="modal">
                                {{-- <h2 class="mt-3 mb-3"> Konfimasi</h2> --}}
                                {{-- <hr> --}}
                                <form action="{{route('client.jobreport.approve')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="job_photo_id" value="{{$job->teknisi_id}} id="job_photo_id">
                                    <input type="hidden" name="job_photo_id" id="job_photo_id">
                                    <input type="hidden" name="order_id" id="" value="{{$job->order_id}}">
                                    <h3> Approve Report ini ? </h3>
                                    <br>
                                    <hr>
                                    <button type="submit" name="submit" class="mt-3 mb-3 mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-blue-400  rounded active:bg-teal-600 hover:bg-blue-600 focus:outline-none focus:shadow-outline-teal">Approve</button>
                                </form>
                            </div>

                            <div id="tolak" class="modal">
                                <h2 class="mt-3 mb-3"> Alasan Penolakan</h2>
                                <hr>
                                <br>
                                <form action="{{route('client.jobreport.reject')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="job_photo_id" id="job_photo_id2">
                                    <input type="hidden" name="order_id" id="" value="{{$job->order_id}}">
                                    <textarea class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="keterangan" id="" cols="44" rows="10" placeholder=" Foto yang kurang jelas"></textarea><br>
                                    <hr>
                                    <button type="submit" name="submit" class="mt-3 mb-3 mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-red-400  rounded active:bg-teal-600 hover:bg-red-600 focus:outline-none focus:shadow-outline-teal">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Endtable -->
    @if ($order->status == '6')
        <?php if ($kondisi == '1') { ?>

            <form action="{{route('job.approve', $order)}}" method="post" id="approve">
                @csrf
                <h3> Approve Semua Report? </h3>
                <button type="submit" name="submit" class="mt-3 mb-3 mr-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-all duration-300 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">Approve</button>
            </form>
        <?php } ?>
    @endif
    
</x-app-layout>

<script>
    $(function() {
        $('.modalApprove').on('click', function() {

            const id = $(this).data('id');

            $('#job_photo_id').val(id);
        });

        $('.modalReject').on('click', function() {

            const id = $(this).data('id');

            $('#job_photo_id2').val(id);
        });
    });
</script>