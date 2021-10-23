<x-app-layout>
  @section('title')
      Client
  @endsection
  <x-header><span class="font-bold">CLIENT</x-header>

  <div class="grid gap-2 mb-4  md:grid-cols-7 grid-cols-2">
    <a href="{{route('client.create')}}" class="">
      <div class="flex items-center justify-center text-gray-100 p-3 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded ">
        <p class=" text-sm  ">
          Create
        </p>
      </div>
    </a> 
  </div>

  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
    <div class="w-full overflow-x-auto">
      {{-- <x-alert></x-alert> --}}
      <table class="w-full whitespace-no-wrap table-auto basic-datatables" >
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Perusahaan</th>
            <th class="px-4 py-3">PM</th>
            <th class="px-4 py-3">GM</th>
            <th class="px-2 py-3">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

          @foreach ($pelanggans as $client)
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                  
                  <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                    <img
                      class="object-cover w-full h-full rounded-full"
                      src="{{asset('img/profil.png')}}"
                      alt=""
                      loading="lazy"
                    />
                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                  </div>
                  <div>
                    <p class="font-semibold">{{$client->nama}}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                      {{$client->alamat}}
                    </p>
                  </div>
                </div>
              </td>
            
              <td class="px-4 py-3 text-sm">
                <p class="">{{$client->nama_pm}}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                  {{$client->no_pm}}
                </p>
              </td>
              <td class="px-4 py-3 text-sm">
                <p class="">{{$client->nama_gm}}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                  {{$client->no_gm}}
                </p>
              </td>
              <td class="px-2 py-3 text-xs flex ">
                <a href="{{route('client.edit', $client)}}" class="mr-2 mb-1 hover:bg-gray-600 text-center py-1 px-4  leading-tight text-gray-100 bg-gray-500 rounded-full dark:bg-gray-700 dark:text-gray-100">EDIT</a>
                <form id="data-{{ $client->id }}" action="{{route('client.delete', $client->id)}}"></form>
                  <button onclick="deleteRow( {{ $client->id }} )" class=" mb-1 hover:bg-red-600 text-center py-1 px-4  leading-tight text-gray-100 bg-red-400 rounded-full dark:bg-red-700 dark:text-gray-100">HAPUS</button>
              </td>
            </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>