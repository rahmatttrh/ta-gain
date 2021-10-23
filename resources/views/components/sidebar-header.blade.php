<a class=" text-gray-500  dark:text-gray-200" href="/">
 @if(auth()->user()->isAdmin())
 <span class="text-3xl ml-6 font-bold text-blue-500">PT <span class="text-white">GAIN</span>
 <p class=" text-xs font-medium dark:bg-gray-800 bg-gray-50 mx-6 py-1 px-2 rounded text-gray-400">Administrator</p>
 @endif 
 @if(auth()->user()->isClient())
 <span class="text-2xl ml-6 font-bold"><span class="text-blue-500">PT <span class="text-white">GAIN</span></span><span class="ml-1 font-medium italic text-sm text-gray-300">CLIENT</span></span>
 <p class="text-xs font-medium dark:bg-gray-800 bg-gray-50 mx-6 py-1 px-2 rounded text-gray-400">{{auth()->user()->name}}</p>
 @endif 
 @if(auth()->user()->isKordinator())
 <span class="text-2xl ml-6 font-bold"><span class="text-blue-500">PT <span class="text-white">GAIN</span></span><span class="ml-1 font-medium italic text-sm text-gray-300">KORDINATOR</span></span>
 
 <p class=" text-xs font-medium dark:bg-gray-800 bg-gray-50 mx-6 py-1 px-2 rounded text-gray-400">{{auth()->user()->name}}</p>
 @endif 
 @if(auth()->user()->isTeknisi())
 <span class="text-3xl ml-6 font-bold"><span class="text-blue-500">GO</span>ES<span class="ml-1 font-bold text-lg text-gray-300">TEKNISI</span></span>
 <p class=" text-sm bg-gray-500 mx-6 rounded  uppercase text-gray-50">{{auth()->user()->name}}</p>
 @endif 
 
</a>