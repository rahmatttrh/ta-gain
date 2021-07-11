<x-app-layout>
    @section('title')
    Detail Job Report
    @endsection
    <div class="flex">
        <a href="{{ URL::previous() }}" class=" mb-4 w-12 f item-center  mr-2 shadow-xs dark:bg-gray-700 text-blue-400 font-bold  p-3 rounded">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path>
            </svg>
        </a>
        <x-header><span class="font-bold">REVISI</span> JOB REPORT {{$reimburse->site}}</x-header>
    </div>



    <!-- Form -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs  mb-4">
        <div class="mt-4 mb-2 px-5 md:flex">
            <input type="hidden" name="reimburse_id" value="{{$reimburse->id}}">
            <div class="mr-4 w-full">
                <div class="mb-4">
                    <label for="" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Nominal</label>
                    <input type="text" name="" value="{{formatRupiah($reimburse->nominal)}}" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Judul Foto..." disabled>
                </div>
                <div class="mb-4 ">
                    <label for="" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Keterangan </label>
                    <textarea name="" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="" cols="35" rows="3" placeholder=" Deskripsi Foto......." disabled>{{$reimburse->keterangan}}</textarea>
                </div>

            </div>
            <div class="w-full ">
                <p class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Foto Bon Dari Kordinator</p>
                <img class="rounded-md" src="{{asset('storage/' .$reimburse->bukti_nota_kordinator)}}" alt="">
            </div>

        </div>
    </div>
    <!-- end form -->

    <!-- Form -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs  mb-4">
        <div class="mr-3 w-full mt-3">
            <h2>Form Revisi</h2>
        </div>
        <div class="mt-4 mb-2 px-5 md:flex">
            <form action="{{route('revisi.reimburse', $reimburse)}}" method="POST" enctype="multipart/form-data" class="w-full mr-4 mb-6" enctype="multipart/ form-data">

                @csrf
                @method('put')
                <input type="hidden" name="reimburse_id" value="{{$reimburse->id}}">
                <div class="mr-4 w-full">
                    <div class="mb-4">
                        <label for="nominal" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Nominal</label>
                        <input type="text" name="nominal" value="{{formatRupiah($reimburse->nominal)}}" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Judul Foto...">
                        @error('nominal') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 ">
                        <label for="keterangan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Keterangan </label>
                        <textarea name="keterangan" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="" cols="35" rows="3" placeholder=" Deskripsi Foto.......">{{$reimburse->keterangan}}</textarea>
                        @error('keterangan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="mb-4">
                    <label for="bukti_nota_admin" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Upload Bon Setelah Markup</label>
                    <input class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="bukti_nota_admin" type="file">
                    <img class="w-1/2 mr-2 rounded" src="">
                    @error('bukti_nota_admin') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <button class="flex items-center justify-center w-full px-6 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
                    Revisi
                </button>

            </form>

        </div>
    </div>
    <!-- end form -->







</x-app-layout>