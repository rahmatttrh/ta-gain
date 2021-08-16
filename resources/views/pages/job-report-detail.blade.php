<x-app-layout>
    @section('title')
    Detail Job Report
    @endsection
    <div class="flex">

        <x-header><span class="font-bold"></span> JOB REPORT {{$order->site}}</x-header>
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
        <a href="{{route('get.zip', $order)}}" class="flex mb-4 items-center justify-center w-full px-6 py-3 text-xs font-medium leading-5 text-white transition-all duration-300 bg-teal-500  rounded active:bg-teal-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-teal">
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
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Judul</th>
                        {{-- <th class="px-4 py-3">Deskripsi </th> --}}
                        <th class="px-4 py-3">Status</th>
                        {{-- <th class="px-4 py-3">Keterangan</th> --}}
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    @foreach ($jobphotos as $key => $job)
                    <tr class="text-gray-700 dark:text-gray-400 ">
                        <td class="px-4 py-3">
                            {{ ($jobphotos->currentpage()-1) * $jobphotos->perpage() + $key + 1 }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('report.foto', $job) }}"><img  width="75px" style="cursor: pointer;" class="rounded" src="{{asset('storage/app/' .$job->foto_pekerjaan)}}" alt=""></a>
                            {{-- <a href="{{ route('report.foto', $job) }}"><img  width="75px" style="cursor: pointer;" class="rounded" src="{{asset('storage/app/' .$job->foto_pekerjaan)}}" alt=""></a> --}}
                        </td>
                       
                        <td class="px-4 py-3 text-sm">
                            <p class="font-medium">{{$job->judul_foto}}</p>
                            <p class="text-gray-400">{{$job->deskripsi_foto}}</p>
                        </td>
                        
                        

                        
                        @if ($job->status == '1')
                        <td class="px-4 py-3 text-xs">
                            <p class='text-md text-xs text-blue-400'> Menunggu Validasi Client</p>
                        </td>
                        <td></td>
                        @elseif($job->status == '2')
                        <td class="px-4 py-3 text-xs">
                            <p class='text-md text-xs text-green-400'> Terverifikasi</p>
                        </td>
                        <td></td>
                        @elseif($job->status == '201' && auth()->user()->isTeknisi())
                        <td class="px-4 py-3 text-xs">
                            <a href='{{route('revisi.report', $job)}}' class=" bg-red-600  text-gray-100 py-1 px-4 pr-8 rounded leading-tight hover:bg-red-400">
                                Revisi
                            </a>
                        </td>
                        {{-- <td class="px-4 py-3 text-sm">
                            <p class="font-semibold">{{$job->keterangan}}</p>
                        </td> --}}
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

