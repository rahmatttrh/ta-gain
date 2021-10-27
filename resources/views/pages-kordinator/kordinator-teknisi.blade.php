<x-app-layout>
  @section('title')
      List Teknisi
  @endsection
  <x-header><span class="font-bold">LIST TEKNISI</x-header>

  <div class="grid gap-2 mb-4  xl:grid-cols-4 xs:grid-cols-2">
    <a href="{{route('teknisi.create')}}" class="">
      <div class="flex w-full items-center justify-center text-gray-100 p-3 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded ">
        <p class=" text-sm font-medium ">
          Create
        </p>
      </div>
    </a>  
  </div>
 
  

  <div class="w-full overflow-hidden rounded shadow-xs mb-5">
    <div class="w-full overflow-x-auto">
      <x-alert></x-alert>

      <table class="w-full whitespace-no-wrap basic-datatables">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">KTP</th>
            <th class="px-4 py-3">Foto</th>
            <th class="px-4 py-3">Area</th>
            <th class="px-4 py-3">Rekening</th>
            <th class="px-4 py-3">Status</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($teknisis as $tek)
          <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
              
                  <p class="font-semibold">{{$tek->nama}}</p>
                  <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{$tek->no_hp}}
                  </p>
              
            </td>
          
            <td class="px-4 py-3 text-sm">
              <img width="100px" style="border-radius: 10px" src="{{asset('storage/' .$tek->foto_ktp)}}" alt="">    
            </td>
            <td class="px-4 py-3 text-sm">
              <img width="100px" style="border-radius: 10px" src="{{asset('storage/' .$tek->foto_diri)}}" alt="">    
            </td>
                <td class="px-4 py-3 text-sm">
                <p class="font-semibold">{{$tek->area}}</p>
                      {{-- <p class="text-xs text-gray-600 dark:text-gray-400">
                        087646464
                      </p> --}}
                </td>
                <td class="px-4 py-3 text-sm">
                {{-- <p class="font-semibold">Mandiri</p> --}}
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                        {{$tek->no_rek}}
                      </p>
                </td>
            <td class="px-4 py-3 text-xs">
              <span
                class="px-2 py-1 font-semibold leading-tight text-white bg-green-400 rounded-full dark:bg-green-700 dark:text-green-100"
              >
                ON
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</x-app-layout>