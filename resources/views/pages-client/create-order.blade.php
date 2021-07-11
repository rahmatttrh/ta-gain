<x-app-layout>
    @section('title')
      Create Job Order
  @endsection
    <main id="main" class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid my-4">
            <div class="flex-col md:flex-row mb-2 flex justify-between w-full">
                <div class="flex">
                    <button class="  mb-2 mr-2 bg-gray-500 hover:bg-gray-400 text-white font-bold py-2 px-4  hover:border-gray-500 rounded-md">
                        <a href="{{route('client-order')}}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg></a>
                    </button>
                    <div class="bg-orange-lightest mb-2 border-l-4  border-orange text-center text-gray-500 py-2 px-3" role="alert">
                        <p class="font-bold uppercase">Buat Order <span class="text-blue-500"></span></p>
                    </div>
                </div>
            </div>

            <div>
                @if (session()->has('pesan'))
                <div class="bg-blue-900 mb-2 text-center py-4 lg:px-4">
                    <div class="p-2 bg-blue-800 items-center text-blue-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <span class="flex rounded-full bg-blue-500 uppercase px-2 py-1 text-xs font-bold mr-3">New</span>
                        <span class="font-semibold mr-2 text-left flex-auto"></span>
                        <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" /></svg>
                    </div>
                </div>
                @endif
            </div>

            <!-- Table -->
            <div class="w-full mb-5  overflow-hidden rounded-lg shadow-xs">
                <div id="main" class="w-full ">
                    <div class="container mx-auto grid my-4">
                        <form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlFile1" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Upload file excel</label>
                                <input type="file" name="excel" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                @error('excel') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <footer class="flex flex-col items-center justify-start px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row ">
                                <button type="submit" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-teal-600 border border-transparent rounded-md sm:w-auto sm:px-4 sm:py-2 active:bg-teal-600 hover:bg-teal-700 focus:outline-none focus:shadow-outline-teal">Simpan</button>
                             </footer>
                        </form>
                    </div>

                </div>
                <hr class="mb-2 mt-10">

                <x-info>> Fitur ini digunakan untuk memasukan order.</x-info>

            </div>
          
        </div>

    </main>
</x-app-layout>