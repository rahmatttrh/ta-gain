<x-app-layout>
  @section('title')
      Kordinator
  @endsection
  <x-header><span class="font-bold">KORDINATOR</x-header>

  <div class="grid gap-2 mb-4  md:grid-cols-7 grid-cols-2">
    <a href="{{route('kordinator.create')}}" class="">
      <div class="flex  items-center justify-center text-gray-100 p-3 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded ">
        <p class=" text-sm font-medium ">
          Create
        </p>
      </div>
    </a>  
    <form action="" class="flex">
      <input
      class="p-2 mr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-4  rounded dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
      type="text"
      placeholder="Cari .."
      aria-label="Search"
      />
      <button class="flex px-4 items-center justify-center text-gray-100 p-2 bg-gray-500 rounded hover:bg-gray-600"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg></button>
    </form>
  </div>
  
  

  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
    <div class="w-full overflow-x-auto">
      <x-alert></x-alert>
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">Foto</th>
            <th class="px-4 py-3">Area</th>
            <th class="px-4 py-3">Rekening</th>
            <th class="px-2 py-3"></th>
            {{-- <th></th> --}}
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          
          @foreach ($kordinators as $kordi)
          <tr class="text-gray-700 dark:text-gray-400 ">
            <td class="px-4 py-3">
              <p class="">{{$kordi->nama}}</p>
              <p class="text-xs text-gray-600 dark:text-gray-400">
                {{$kordi->no_hp}}
              </p>
            </td>
           
            <td class="px-4 py-3 text-sm">
              {{-- <img width="75px" class="rounded" src="{{asset('storage/app/' .$kordi->foto_diri)}}" alt=""> --}}
              <img width="75px" class="rounded" src="{{asset('storage/' .$kordi->foto_diri)}}" alt="">
            </td>
            <td class="px-4 py-3 text-sm">
              <p class="">{{$kordi->area}}</p>
            </td>
            <td class="px-4 py-3 text-sm">
              <p class="text-xs text-gray-600 dark:text-gray-400">
                {{$kordi->no_rek}}
              </p>
            </td>
            <td class="px-2 py-3 text-xs flex flex-col ">
              {{-- <span class="px-2 py-1 w-full mb-2 text-center font-semibold leading-tight text-white bg-green-400 rounded-full dark:bg-green-700 dark:text-green-100">
                ON
              </span> --}}
              <a href="{{route('kordinator.edit', $kordi)}}" class=" mb-1 hover:bg-gray-600 text-center py-1  leading-tight text-gray-100 bg-gray-500 rounded-full dark:bg-gray-700 dark:text-gray-100">EDIT</a>
              <form id="data-{{ $kordi->id }}" action="{{route('kordinator.delete', $kordi->id)}}"></form>
                  <button onclick="deleteRow( {{ $kordi->id }} )" class="w-full mb-1 hover:bg-red-600 text-center py-1 px-4 leading-tight text-gray-100 bg-red-400 rounded-full dark:bg-red-700 dark:text-gray-100">HAPUS</button>
            </td>
            
            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
   
</x-app-layout>