<x-app-layout>
  @section('title')
      Complete Job Order
  @endsection
  <x-header><span class="font-bold">COMPLETE</span> JOB ORDER</x-header>

<div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
 <div class="w-full overflow-x-auto">
   <table class="w-full whitespace-no-wrap basic-datatables">
     <thead>
       <tr
         class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
       >
         <th class="px-4 py-3">No</th>
         <th class="px-4 py-3">Aksi</th>
         <th class="px-4 py-3">Site</th>
         <th class="px-4 py-3">Client</th>
         <th class="px-4 py-3">Kordinator</th>
     </thead>
     <tbody
       class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
     >

     @foreach ($orders as $key => $order)
      <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3 ">
         {{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}
        </td>
        <td class="px-4 py-3 flex text-xs">
          
          <a href="{{route('job.detail.client', $order)}}" class=" bg-teal-600   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
         </td>
         <td class="px-4 py-3 ">
            <p class="text-sm">{{$order->site}}</p>
                  
        </td>
         <td class="px-4 py-3">
              <p class=" text-sm">{{$order->pelanggan->nama}}</p>
         </td>
        
          
          <td class="px-4 py-3 ">
          <p class="text-sm">{{$order->kordinator->nama}}</p>
          </td>
        
      </tr>
     @endforeach
      
     </tbody>
   </table>
</div>

</x-app-layout>