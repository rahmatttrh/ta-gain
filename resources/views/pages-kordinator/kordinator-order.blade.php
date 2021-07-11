<x-app-layout>
  @section('title')
  List Job Order
  @endsection
  <x-header>LIST JOB PROGRESS</x-header>

  <div class="grid gap-2 mb-4  xl:grid-cols-4 xs:grid-cols-2">

    <form action="" class="flex w-full">
      <input class="p-2 pl-5 w-full mr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-4  rounded dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" type="text" placeholder="Cari .." aria-label="Search" />
      <button class="flex px-4 items-center justify-center text-gray-100 p-2 bg-gray-500 rounded hover:bg-gray-600"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg></button>
    </form>
  </div>

 <div class="w-full overflow-hidden rounded shadow-xs mb-5">
  <div class="w-full overflow-x-auto">
    <table class="w-full whitespace-no-wrap">
      <thead>
        <tr
          class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
        >
        <th class="px-4 py-3">No</th>
        <th class="px-4 py-3">Action</th>
        <th class="px-4 py-3">Status</th>
        <th class="px-4 py-3">Site</th>
        <th class="px-4 py-3">Client</th>
        <th class="px-4 py-3">Nama Projek</th>
        </tr>
      </thead>
      <tbody
        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
      >
      @foreach ($orders as $key => $order)
      <tr class="text-gray-700 dark:text-gray-400 ">
        <td class="px-4 py-3">
          {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
        </td>
        <td class="px-4 py-3 text-xs flex">
          <a href="{{route('job.detail.kordinator', $order)}}" class=" bg-teal-600 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Update</a>
        </td>
        <td class="px-4 py-3">

          @if ($order->status == 5)
            <p class="text-md text-sm text-blue-400">On Progress</p>
          @endif
          @if ($order->status == 202)
            <p class="text-md text-sm text-red-400">Pending</p>
          @endif
          
        </td>
        <td class="px-4 py-3">
          <p class="text-sm">
            {{$order->site}}
          </p>
        </td>
        <td class="px-4 py-3">
          <p class="text-sm font-semibold ">
            {{$order->pelanggan->nama}}
          </p>
        </td>
          <td class="px-4 py-3">
            <p class="text-sm">
              {{$order->nama_projek}}
            </p>
          </td>
      </tr>
      @endforeach
      



        </tbody>
      </table>
    </div>
  </div>
  </main>
</x-app-layout>