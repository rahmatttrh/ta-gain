<x-app-layout>
  @section('title')
  Edit Kordinator
  @endsection
  <div class="flex">
    <a href="{{route('kordinator')}}" class=" mb-2 w-12 f item-center  mr-2 shadow-xs dark:bg-gray-700 text-blue-400 font-bold  p-3 rounded">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path>
      </svg>
    </a>
    <x-header><span class="font-bold">KORDINATOR</span> EDIT</x-header>
  </div>




  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-4">
    <div class="mt-4 mb-6 px-5">
      
      <form action="{{route('kordinator.update', $kordinator)}}" method="POST" class="w-full flex" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mr-4 w-1/2">
          <div class="mb-4">
            <label for="namaKordinator" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Nama</label>
            <input type="text" value="{{ old('namaKordinator') ?? $kordinator->nama}}" name="namaKordinator" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            @error('namaKordinator') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          </div>
          <div class="mb-4">
            <label for="noKordinator" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">No HP</label>
            <input name="noKordinator" value="{{ old('noKordinator') ?? $kordinator->no_hp}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="No HP ...">
            @error('noKordinator') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          </div>
          <div class="mb-4">
            <label for="email" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Email</label>

            <input name="email" readonly type="email" value="{{ old('email') ?? $kordinator->email}}" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Email ...">
            <span class="text-sm text-gray-400">* Tidak bisa di ubah</span>
          </div>
          <div class="mb-4">
            <label for="area" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Area</label>
            <input name="area" type="text" value="{{ old('area') ?? $kordinator->area}}" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Area ...">
            @error('area') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          </div>

        </div>
        <div class="w-1/2">
          <div class="mb-4">
            <label for="noRek" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">No. Rekening</label>
            <input name="noRek" value="{{ old('noRek') ?? $kordinator->no_rek}}" type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="No. Rek ...">
            @error('noRek') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          </div>
          <div class="mb-4">
            <label for="fotoKtp" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Foto KTP</label>
            <input class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="fotoKtp" type="file">
            <img class="w-1/2 mr-2 rounded" src="">
            @error('fotoKtp') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          </div>
          <div class="mb-4">
            <label for="fotoDiri" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Foto Diri</label>
            <input class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="fotoDiri" type="file">
            <img class="w-1/2 mr-2 rounded" src="">
            @error('fotoDiri') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
          </div>
          <button class="flex items-center justify-center w-full px-6 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
            Update
          </button>
        </div>
      </form>
      <hr>
      <div class="flex w-full mb-4 mt-6">
        <div class="w-1/2 mr-4 ">
          <p class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Foto KTP</p>
          <img class="rounded-md" src="{{asset('storage/app/' .$kordinator->foto_ktp)}}" alt="">
        </div>
        <div class="w-1/2 ">
          <p class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Foto Diri</p>
          <img class="rounded-md" src="{{asset('storage/app/' .$kordinator->foto_diri)}}" alt="">
        </div>
      </div>
    </div>
  </div>

</x-app-layout>