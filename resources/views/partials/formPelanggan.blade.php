<x-app-layout>
  @section('title')
      Create Client
  @endsection
  <div class="flex">
    <a href="{{route('client')}}" class=" mb-4 w-12 f item-center  mr-2 shadow-xs dark:bg-gray-700 text-blue-400 font-bold  p-3 rounded">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
    </a>
    <x-header>CREATE <span class="font-bold">CLIENT</span></x-header>
  </div>
  

  

 <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
  
   <div class="mt-4 mb-6 px-5">
    <form action="{{route('client.create')}}" method="POST" class="w-full lg:flex " enctype="multipart/form-data">
      @csrf
      <div class="lg:w-1/2 lg:mr-4">
        <div class="mb-4">
          <label for="namaPerusahaan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Nama Perusahaan</label>
          <input  type="text" name="namaPerusahaan" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nama ...">
          @error('namaPerusahaan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
          <label for="email" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Email Perusahaan</label>
          <input  type="email" name="email" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Email ...">
          @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
          <label for="alamatPerusahaan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Alamat Perusahaan</label>
          <textarea name="alamatPerusahaan" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="" cols="30" rows="4"></textarea>
          @error('alamatPerusahaan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
          <label for="pm" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Project Manager</label>
          <input name="pm"  type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nama ...">
          @error('pm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          <input name="nopm"  type="text" class=" mt-2 appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="No HP ...">
          @error('nopm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
      </div>
      <div class="lg:w-1/2">
        <div class="form-group mb-4">
          <label for="exampleFormControlFile1" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">File BAST</label>
          <input type="file" name="bast" class="w-full bg-gray-200   text-gray-700  border border-gray-200  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
          @error('bast') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
      </div>
        <div class="mb-4">
          <label for="gm" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Project GM</label>
          <input name="gm"  type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nama ...">
          @error('gm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          <input name="nogm"  type="text" class=" mt-2 appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="No HP ...">
          @error('nogm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
        <button class="flex items-center justify-center w-full px-6 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
          Save
        </button>
      </div>
        
        
        {{-- <footer
        class="flex flex-col items-center justify-start px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
      >
      
        <button type="submit"
          class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-teal-600 border border-transparent rounded sm:w-auto sm:px-4 sm:py-2 active:bg-teal-600 hover:bg-teal-700 focus:outline-none focus:shadow-outline-teal"
        >
          Simpan
        </button>
      </footer>
       --}}
    </form>
  </div>
  
 </div>



</x-app-layout>