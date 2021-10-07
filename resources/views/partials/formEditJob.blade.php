<x-app-layout>
  @section('title')
  Edit Job Order
  @endsection
  <div class="flex">
    <a href="{{route('job')}}" class=" mb-2 w-12 f item-center  mr-2 shadow-xs dark:bg-gray-700 text-blue-400 font-bold  p-3 rounded">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path>
      </svg>
    </a>
    <x-header><span class="font-bold">EDIT</span> JOB ORDER</x-header>
  </div>

  {{-- <div class="grid gap-2 mb-4  xl:grid-cols-6 xs:grid-cols-2"> --}}


  {{-- </div>   --}}









  <div class="w-full mb-5 px-6 py-6 dark:bg-gray-900  overflow-hidden rounded-lg shadow-xs">
    <div id="main" class="w-full ">
      <div class="container mx-auto grid">
        <form action="{{route('job.update', $order)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="client" value="{{$order->pelanggan_id}}">
          <div class="flex mb-4">
            <div class="mr-2 w-1/2">
              <label for="client" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Client</label>
              <input name="pelanggan" disabled value="{{$order->pelanggan->nama}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('client') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
              <label for="site" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Site</label>
              <input name="site" value="{{$order->site}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('site') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="flex mb-4">
            <div class="mr-2 w-1/2">
              <label for="provinsi" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Provinsi</label>
              <input name="provinsi" value="{{$order->provinsi}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('provinsi') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
              <label for="kabupaten" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Kabupaten</label>
              <input name="kabupaten" value="{{$order->kabupaten}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('kabupaten') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="flex mb-4">
            <div class="mr-2 w-1/2">
              <label for="alamat" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Alamat</label>
              <textarea name="alamat" value="" rows="4" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{$order->alamat}}</textarea>
              @error('alamat') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
              <label for="latlong" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Latitude - longitude</label>
              <input name="latitude" value="{{$order->latitude}}" type="text" class="mb-3 appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('latitude') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
              <input name="longitude" value="{{$order->longitude}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('longitude') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="flex mb-4">
            <div class="mr-2 w-1/2">
              <label for="nama_projek" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Nama Projek</label>
              <input name="nama_projek" value="{{$order->nama_projek}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('nama_projek') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
              <label for="no_telpon" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">No Telepon</label>
              <input name="no_telepon" value="{{$order->no_telpon}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('no_telepon') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="flex mb-4">
            <div class="mr-2 w-full">
              <label for="ukuran" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Ukuran</label>
              <input name="ukuran" value="{{$order->ukuran}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('ukuran') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full mr-2">
              <label for="system_antena" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">System Antena</label>
              <input name="system_antena" value="{{$order->system_antena}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('system_antena') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full mr-2">
              <label for="jenis_pekerjaan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Jenis Pekerjaan</label>
              <input name="jenis_pekerjaan" value="{{$order->jenis_pekerjaan}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('jenis_pekerjaan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full">
              <label for="modem" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Modem</label>
              <input name="modem" value="{{$order->modem}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('modem') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="flex mb-4">
            <div class="mr-2 w-1/2">
              <label for="harga_paket" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Harga Paket</label>
              <input name="harga_paket" value="{{formatRupiah($order->harga_paket)}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('harga_paket') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
              <label for="total_reimburse" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Total Reimburse</label>
              <input name="total_reimburse" value="{{formatRupiah($order->total_reimburse)}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('total_reimburse') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="flex mb-4">
            <div class="mr-2 w-1/2">
              <label for="grand_total" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Grand Total</label>
              <input name="grand_total" value="{{formatRupiah($order->grand_total)}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @error('grand_total') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>

          <button type="submit" class="w-full px-5  text-xs font-medium  text-white transition-colors duration-150 bg-teal-600 border border-transparent rounded sm:w-auto sm:px-4 py-2 active:bg-teal-600 hover:bg-blue-400 focus:outline-none focus:shadow-outline-teal">Update</button>


        </form>
      </div>

    </div>
    <hr class="mb-2 mt-10">

    {{-- <x-info>> Fitur ini digunakan untuk memasukan order.</x-info> --}}

  </div>

</x-app-layout>