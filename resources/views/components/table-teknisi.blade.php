<div class="w-full overflow-hidden rounded shadow-xs mb-5">
 <div class="w-full overflow-x-auto">
   <table class="w-full whitespace-no-wrap">
     <thead>
       <tr
       class="text-xs font-semibold tracking-wide text-left bg-gray-200 dark:bg-gray-900  text-gray-500 dark:text-gray-400 uppercase border-b dark:border-gray-700  "
       >
         <th class="px-4 py-3">No</th>
         <th class="px-4 py-3">Nama Site</th>
         <th class="px-4 py-3">Area</th>
         <th class="px-4 py-3">Teknisi</th>
         <th class="px-4 py-3">Klien</th>
         <th class="px-4 py-3">Kordinator</th>
         <th class="px-4 py-3">Status</th>
         {{-- <th class="px-4 py-3">Date</th> --}}
       </tr>
     </thead>
     <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
       <tr class="text-gray-700 dark:text-gray-400">
         <td class="px-4 py-3 text-sm">
           1
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-bold"> Site 1</p>
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-semibold">Papua</p>
             <p class="text-xs text-gray-600 dark:text-gray-400">
               Distrik Nduga
           </p>
         </td>
         <td class="px-4 py-3">
           <div class="flex items-center text-sm">
             <!-- Avatar with inset shadow -->
             <div
               class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
             >
               <img
                 class="object-cover w-full h-full rounded-md"
                 src="{{asset('img/teknisi.png')}}"
                 alt=""
                 loading="lazy"
               />
               <div
                 class="absolute inset-0 rounded-full shadow-inner"
                 aria-hidden="true"
               ></div>
             </div>
             <div>
               <p class="font-semibold">Desta Dwi</p>
               <p class="text-xs text-gray-600 dark:text-gray-400">
                 Teknisi Kabel
               </p>
             </div>
           </div>
         </td>
         <td class="px-4 py-3 text-sm">
           PT. Telkom
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-semibold">Agus</p>
               <p class="text-xs text-gray-600 dark:text-gray-400">
                 098847474
               </p>
         </td>
          
         <td class="px-4 py-3 text-xs">
          <form action="" class="flex">
           <div class="relative mr-2">
            <select wire:model="rekening_id" class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" required>
                
                <option value="">Persiapan</option>
                <option value="">Menuju Lokasi</option>
                <option value="">Kordinasi</option>
                <option value="">Mulai bekerja</option>
                <option value="">Pengecekan Akhir</option>
                <option value="">Selesai</option>
                
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
            </div>
           </div>
           <button type="submit" class="select2 block appearance-none  bg-green-500 border border-gray-200 text-gray-100 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">Update</button>
          </form>
         </td>
       </tr>
       <tr class="text-gray-700 dark:text-gray-400">
         <td class="px-4 py-3 text-sm">
           1
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-bold"> Site 3</p>
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-semibold">Jawa Barat</p>
             <p class="text-xs text-gray-600 dark:text-gray-400">
               Sukabumi
           </p>
         </td>
         <td class="px-4 py-3">
           <div class="flex items-center text-sm">
             <!-- Avatar with inset shadow -->
             <div
               class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
             >
               <img
                 class="object-cover w-full h-full rounded-md"
                 src="{{asset('img/teknisi.png')}}"
                 alt=""
                 loading="lazy"
               />
               <div
                 class="absolute inset-0 rounded-full shadow-inner"
                 aria-hidden="true"
               ></div>
             </div>
             <div>
               <p class="font-semibold">Nurdiansah</p>
               <p class="text-xs text-gray-600 dark:text-gray-400">
                 Teknisi Kabel
               </p>
             </div>
           </div>
         </td>
         <td class="px-4 py-3 text-sm">
           PT. Indosat
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-semibold">Hendra</p>
               <p class="text-xs text-gray-600 dark:text-gray-400">
                 098847474
               </p>
         </td>
          
         <td class="px-4 py-3 text-xs">
          <form action="" class="flex">
           <div class="relative mr-2">
            <select wire:model="rekening_id" class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" required>
                
                <option value="">Persiapan</option>
                <option value="">Menuju Lokasi</option>
                <option value="">Kordinasi</option>
                <option value="">Mulai bekerja</option>
                <option value="">Pengecekan Akhir</option>
                <option value="">Selesai</option>
                
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
            </div>
           </div>
           <button type="submit" class="select2 block appearance-none  bg-green-500 border border-gray-200 text-gray-100 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">Update</button>
          </form>
         </td>
       </tr>
       <tr class="text-gray-700 dark:text-gray-400">
         <td class="px-4 py-3 text-sm">
           1
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-bold"> Site 5</p>
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-semibold">Sulawesi</p>
             <p class="text-xs text-gray-600 dark:text-gray-400">
               Makassar
           </p>
         </td>
         <td class="px-4 py-3">
           <div class="flex items-center text-sm">
             <!-- Avatar with inset shadow -->
             <div
               class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
             >
               <img
                 class="object-cover w-full h-full rounded-md"
                 src="{{asset('img/teknisi.png')}}"
                 alt=""
                 loading="lazy"
               />
               <div
                 class="absolute inset-0 rounded-full shadow-inner"
                 aria-hidden="true"
               ></div>
             </div>
             <div>
               <p class="font-semibold">Rahmat H</p>
               <p class="text-xs text-gray-600 dark:text-gray-400">
                 Teknisi Kabel
               </p>
             </div>
           </div>
         </td>
         <td class="px-4 py-3 text-sm">
           PT. Adikarya
         </td>
         <td class="px-4 py-3 text-sm">
           <p class="font-semibold">Agus</p>
               <p class="text-xs text-gray-600 dark:text-gray-400">
                 098847474
               </p>
         </td>
          
         <td class="px-4 py-3 text-xs">
          <form action="" class="flex">
           <div class="relative mr-2">
            <select wire:model="rekening_id" class="select2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" required>
                
                <option value="">Persiapan</option>
                <option value="">Menuju Lokasi</option>
                <option value="">Kordinasi</option>
                <option value="">Mulai bekerja</option>
                <option value="">Pengecekan Akhir</option>
                <option value="">Selesai</option>
                
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
            </div>
           </div>
           <button type="submit" class="select2 block appearance-none  bg-green-500 border border-gray-200 text-gray-100 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">Update</button>
          </form>
         </td>
       </tr>
     </tbody>
   </table>
</div>