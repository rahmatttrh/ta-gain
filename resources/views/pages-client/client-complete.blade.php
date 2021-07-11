<x-app-layout>
  @section('title')
      Complete Job Order
  @endsection
 <x-header>COMPLETE ORDER</x-header>

<div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
 <div class="w-full overflow-x-auto">
   <table class="w-full whitespace-no-wrap">
     <thead>
       <tr
       class="text-xs font-semibold tracking-wide text-left bg-gray-200 dark:bg-gray-900  text-gray-500 dark:text-gray-400 uppercase border-b dark:border-gray-700  "
       >
         <th class="px-4 py-3">No</th>
         <th class="px-4 py-3">Status</th>
         <th class="px-4 py-3"></th>
         <th class="px-4 py-3">Site</th>
         <th class="px-4 py-3">Kordinator</th>
         {{-- <th class="px-4 py-3">Harga</th> --}}
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
       <td class="px-4 py-3 flex text-xs">
        <div  class=" flex items-center  font-bold text-green-500 py-1 px-4  rounded-xl leading-tight ">
         <svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
         <span> Done</span>
        </div>
       </td>
       <td class="px-2 py-3 text-xs">
            <a href="{{route('job.detail.client', $order)}}" class=" bg-teal-600 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
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