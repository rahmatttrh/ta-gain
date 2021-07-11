<x-app-layout>
  @section('title')
     Master Bast
 @endsection
 <div class="flex">
   <a href="{{route('job.finish')}}" class=" mb-4 w-12 f item-center  mr-2 shadow-xs dark:bg-gray-700 text-blue-400 font-bold  p-3 rounded">
     <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
   </a>
   <x-header><span class="font-bold">MASTER</span> BAST {{$order->site}}</x-header>
 </div>
   


<div class="w-full mb-5 py-4 px-4 dark:bg-gray-900  overflow-hidden rounded-lg shadow-xs">
 
     <div class="container mx-auto">
         <form action="{{route('upload.bast.master', $order)}}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="form-group mb-4">
                 <label for="exampleFormControlFile1" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Upload Master BAST</label>
                 <input type="file" name="masterBast" class="w-full bg-gray-200   text-gray-700  border border-gray-200  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                 @error('bast') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
             </div>
            
                 <button type="submit"  class="w-full px-5  text-xs font-medium  text-white transition-colors duration-150 bg-teal-600 border border-transparent rounded sm:w-auto sm:px-4 py-2 active:bg-teal-600 hover:bg-blue-400 focus:outline-none focus:shadow-outline-teal">UPLOAD</button>
             
         </form>
     </div>



 {{-- <x-info>> Fitur ini digunakan untuk memasukan order.</x-info> --}}

</div>

</x-app-layout>