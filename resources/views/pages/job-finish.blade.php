<x-app-layout>
  @section('title')
      Finish Job Order
  @endsection
  <x-header><span class="font-bold">FINISH</span> JOB ORDER</x-header>

<div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
 <div class="w-full overflow-x-auto">
   <table class="w-full whitespace-no-wrap">
     <thead>
       <tr
         class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
       >
         <th class="px-4 py-3">No</th>
         <th class="px-1 py-3">Action</th>
         <th class="px-1 py-3">Status</th>
         <th class="px-4 py-3">Kordinator</th>
         <th class="px-4 py-3">Client</th>
         <th class="px-4 py-3">Site</th>
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
       <td class="px-1 py-3 text-xs">
          @if ($order->bast)
            <a href="{{route('job.bast', $order)}}" class="bg-green-500 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-600">Master BAST Uploaded</a>
          @endif
          {{-- @if ($order->bast)
          <a href="{{route('job.bast', $order)}}" class="bg-green-500 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-600">Master BAST Uploaded</a>
          @else
          <a href="{{route('job.bast', $order)}}" class=" bg-teal-600 font-semibold  text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-teal-700">Upload BAST</a>
         @endif --}}
          <a href="{{route('bast', $order)}}" class=" bg-green-500   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-600">Upload BAST</a>
          <a href="{{route('download.bast', $order)}}" class=" bg-green-500   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-green-600">Download BAST</a>
          <a href="{{route('job.detail.admin', $order)}}" class=" bg-teal-600   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">Detail</a>
         
         
      </td>
      <td class="px-4 py-3 text-xs">
        @if ($order->status == 6)
         <p class="text-md text-blue-400">Progress Report</p>
         @elseif($order->status == 7)
         <p class="text-md text-green-400">Report Tervalidasi</p>
        @endif
        @if ($order->bast)
            <p class="text-md text-gray-400">BAST Uploaded</p>
        @else
        <p class="text-xs text-gray-400">BAST Empty</p>
        @endif
       </td>
      <td class="px-4 py-3  text-sm">
           {{$order->kordinator->nama}}
       </td>
       <td class="px-4 py-3">
        <p class="text-sm ">
          {{$order->pelanggan->nama}}
        </p>
       </td>
       <td class="px-4 py-3  text-sm">
           {{$order->site}}
       </td>
       
         
     </tr>
     @endforeach
     

       
       
     </tbody>
   </table>
</div>

</x-app-layout>