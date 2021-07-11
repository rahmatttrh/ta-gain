<x-app-layout>
  @section('title')
      Wallet
  @endsection
 <x-header><span class="font-bold">E-WALLET</span> RECIEVE</x-header>

 <div class="grid gap-6 mb-4 md:grid-cols-1 xl:grid-cols-3">
  <!-- Card -->
  <div class="flex items-center p-4 bg-white rounded shadow-xs dark:bg-gray-700">
    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded dark:text-blue-100 dark:bg-blue-500">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
    </div>
    <div>
      <p class=" text-lg font-semibold text-gray-700 dark:text-gray-200">
        Informasi Saldo
      </p>
      <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
        Rp. 13.000.000
      </p>
      <p class="text-sm font-medium text-gray-400 dark:text-gray-300">
       ID E00233
     </p>
    </div>
  </div>
 
  <div class=" p-4 bg-white rounded shadow-xs dark:bg-gray-700">
    <a href="{{route('withdraw.kordinator')}}" class="items-center  flex block mb-2  px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-200 bg-teal-600 border border-transparent rounded sm:w-auto sm:px-4 sm:py-2 active:bg-teal-600 hover:bg-gray-400 focus:outline-none focus:shadow-outline-teal"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>Withdraw</a>
    <a href="{{route('wallet.kordinator')}}" class="flex items-center  block mb-2 px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-200 bg-green-500 border border-transparent rounded sm:w-auto sm:px-4 sm:py-2 active:bg-teal-600 hover:bg-green-400 focus:outline-none focus:shadow-outline-teal"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>Recieve</a>
  </div>
 </div>

 
  
 

<div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
 <div class="w-full overflow-x-auto">
   <table class="w-full whitespace-no-wrap">
     <thead>
       <tr
         class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
       >
         <th class="px-4 py-3">No</th>
         <th class="px-4 py-3">Nama Project</th>
         <th class="px-4 py-3">Client</th>
         <th class="px-4 py-3">Nominal</th>
         <th class="px-4 py-3">Waktu</th>
       </tr>
     </thead>
     <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
       <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3 text-sm">
         <p class="font-semibold">1</p>
        </td>
        <td class="px-4 py-3 text-sm">
          <p class="font-semibold">Menara BTS</p> 
        </td>
        <td class="px-4 py-3 text-md">
         <p class="">PT. Telkom</p> 
        </td>
        <td class="px-4 py-3 text-md">
         <p class="font-semibold">Rp. 12.000.000</p> 
        </td>
        <td class="px-4 py-3 text-md">
         <p class="">12 November 2020</p> 
        </td>
       </tr>
       
     </tbody>
   </table>
</div>

</x-app-layout>