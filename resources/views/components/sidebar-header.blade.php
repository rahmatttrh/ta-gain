<a class=" text-gray-500  dark:text-gray-200" href="/">
 @if(auth()->user()->isAdmin())
 <span class="text-3xl ml-6 font-bold text-white"><span >PT GAIN</span>
 <p class="text-center text-xs bg-white mx-6 rounded  uppercase text-gray-500">Administrator</p>
 @endif 
 @if(auth()->user()->isClient())
 <span class="text-2xl ml-6 font-bold"><span class="text-white">PT GAIN</span><span class="ml-1 font-bold text-sm text-gray-300">CLIENT</span></span>
 <p class="text-center text-sm bg-gray-500 mx-6 rounded  uppercase text-gray-50">{{auth()->user()->name}}</p>
 @endif 
 @if(auth()->user()->isKordinator())
 <span class="text-2xl ml-6 font-bold"><span class="text-white">PT GAIN</span><span class="ml-1 font-bold text-sm text-gray-300">KORDINATOR</span></span>
 
 <p class="text-center text-sm bg-gray-500 mx-6 rounded  uppercase text-gray-50">{{auth()->user()->name}}</p>
 @endif 
 @if(auth()->user()->isTeknisi())
 <span class="text-3xl ml-6 font-bold"><span class="text-blue-500">GO</span>ES<span class="ml-1 font-bold text-lg text-gray-300">TEKNISI</span></span>
 <p class="text-center text-sm bg-gray-500 mx-6 rounded  uppercase text-gray-50">{{auth()->user()->name}}</p>
 @endif 
 
</a>