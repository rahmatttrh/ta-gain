<x-app-layout>
 @section('title')
     Create Client
 @endsection
 
   <x-header>MY <span class="font-bold">PROFILE</span></x-header>
 
 

 

<div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
 
  <div class="mt-4 mb-6 px-5">
   <form action="{{route('client.update.profile', $client)}}" method="POST" class="w-full lg:flex " >
     @csrf
     @method('put')
     <div class="lg:w-1/2 lg:mr-4">
       <div class="mb-4">
         <label for="namaPerusahaan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Nama Perusahaan</label>
         <input  type="text" value="{{$client->nama}}" name="namaPerusahaan" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nama ...">
         @error('namaPerusahaan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
       </div>
       <div class="mb-4">
         <label for="email"  class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Email Perusahaan</label>
         <input  type="email" readonly value="{{$client->email}}" name="email" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Email ...">
         @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
         <span class="text-sm text-gray-400">* Tidak bisa di ubah</span>
       </div>
       <div class="mb-4">
         <label for="alamatPerusahaan" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Alamat Perusahaan</label>
         <textarea name="alamatPerusahaan" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="" cols="30" rows="4">{{$client->alamat}}</textarea>
         @error('alamatPerusahaan') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
       </div>
       
     </div>
     <div class="lg:w-1/2">
       <div class="mb-4">
         <label for="pm" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Project Manager</label>
         <input name="pm" value="{{$client->nama_pm}}"  type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nama ...">
         @error('pm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
         <input name="nopm" value="{{$client->no_pm}}"  type="text" class=" mt-2 appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="No HP ...">
         @error('nopm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
       </div>
       <div class="mb-4">
         <label for="gm" class="block uppercase tracking-wide dark:text-gray-300 text-gray-700 text-xs font-bold mb-2">Project GM</label>
         <input name="gm" value="{{$client->nama_gm}}"  type="text" class="appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Nama ...">
         @error('gm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
         <input name="nogm" value="{{$client->no_gm}}" type="text" class=" mt-2 appearance-none block w-full bg-gray-200   text-gray-700  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="No HP ...">
         @error('nogm') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
       </div>
       <button class="flex items-center justify-center w-full px-6 py-3 text-sm font-medium leading-5 text-white transition-all duration-300 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
         Save
       </button>
     </div>
   </form>
 </div>
 
</div>



</x-app-layout>