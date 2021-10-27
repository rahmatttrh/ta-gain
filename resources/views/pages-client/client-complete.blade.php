<x-app-layout>
  @section('title')
      Complete Job Order
  @endsection
 <x-header>COMPLETE ORDER</x-header>

<div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
 <div class="w-full overflow-x-auto">
   <table class="w-full whitespace-no-wrap basic-datatables">
     <thead>
       <tr
       class="text-xs font-semibold tracking-wide text-left bg-gray-50 dark:bg-gray-900  text-gray-500 dark:text-gray-400 uppercase border-b dark:border-gray-700  "
       >
         <th class="px-4 py-3">No</th>
         <th class="px-4 py-3">Aksi</th>
         <th class="px-4 py-3">Site</th>
         <th class="px-4 py-3">Kordinator</th>
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
       
       <td class="px-2 py-3 text-xs">
            <a href="{{route('job.detail.client', $order)}}" class=" bg-teal-600  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
        </td>
       <td class="px-4 py-3 text-sm">
           {{$order->site}}
       </td>
       <td class="px-4 py-3">
        <p class="text-sm ">
          @if ($order->kordinator_id)
                {{$order->kordinator->nama}}
                @endif
        </p>
       </td>
       
     </tr>
     @endforeach
     

       
       
     </tbody>
   </table>
</div>

</x-app-layout>