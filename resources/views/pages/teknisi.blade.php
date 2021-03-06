<x-app-layout>
  @section('title')
      Teknisi
  @endsection
  <x-header><span class="font-bold">TEKNISI</x-header>

  <div class="grid gap-2 mb-4  md:grid-cols-7 grid-cols-2">
    <a href="{{route('teknisi.create')}}" class="">
      <div class="flex w-full items-center justify-center text-gray-100 p-3 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded ">
        <p class=" text-sm font-medium ">
          Create
        </p>
      </div>
    </a>  
    
  </div>
 
  

  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
    <div class="w-full overflow-x-auto">
      <x-alert></x-alert>

      <table class="w-full whitespace-no-wrap basic-datatables">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Nama</th>
            {{-- <th class="px-4 py-3">KTP</th> --}}
            <th class="px-4 py-3">Foto</th>
            <th class="px-4 py-3">Area</th>
            <th class="px-4 py-3">Rekening</th>
            <th class="px-2 py-3">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($teknisis as $tek)
          <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 ">
                  <p class="">{{$tek->nama}}</p>
                  <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{$tek->no_hp}}
                  </p>
            </td>
          
            {{-- <td class="px-4 py-3 text-sm">
              <img width="75px" style="border-radius: 10px" src="{{asset('storage/' .$tek->foto_ktp)}}" alt="">    
            </td> --}}
            <td class="px-4 py-3 text-sm">
              <img width="75px" class="rounded" src="{{asset('storage/app/' .$tek->foto_diri)}}" alt="">  
              {{-- <img width="75px" class="rounded" src="{{asset('storage/' .$tek->foto_diri)}}" alt=""> --}}
            </td>
                <td class="px-4 py-3 text-sm">
                <p class="">{{$tek->area}}</p>
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
                <td class="px-2 py-3 text-xs flex">
                  <a href="{{route('teknisi.edit', $tek)}}" class="mr-2 mb-1 hover:bg-gray-600 text-center py-1 px-4  leading-tight text-gray-100 bg-gray-500 rounded-full dark:bg-gray-700 dark:text-gray-100">EDIT</a>
                  <form id="data-{{ $tek->id }}" action="{{route('teknisi.delete', $tek->id)}}"></form>
                  <button onclick="deleteRow( {{ $tek->id }} )" class="mr-2 mb-1 hover:bg-red-600 text-center py-1 px-4  leading-tight text-gray-100 bg-red-400 rounded-full dark:bg-red-700 dark:text-gray-100">HAPUS</button>
                    
                </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>


  {{-- <script>
  function deleteRow(id)
    {
      swal({
          title: "Yakin?",
          text: "Data akan terhapus!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              $('#data-'+id).submit();
          }
      });
      }
  </script> --}}

</x-app-layout>