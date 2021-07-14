<x-app-layout>
  @section('title')
      Foto Report
  @endsection
  <div class="flex">
    <a href="{{url()->previous()}}" class=" mb-2 w-12 f item-center  mr-2 shadow-xs dark:bg-gray-700 text-blue-700 font-bold  p-3 rounded">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd"></path></svg>
        </a>
        <x-header>FOTO REPORT {{$jobphoto->order->site}} ({{$jobphoto->judul_foto}})</x-header>
  </div>
 

<div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
  <img src="{{asset('storage/app/' .$jobphoto->foto_pekerjaan)}}" alt="">
  {{-- <img src="{{asset('storage/' .$jobphoto->foto_pekerjaan)}}" alt=""> --}}
</div>

</x-app-layout>