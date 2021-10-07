<div class="grid gap-2 mb-4  md:grid-cols-7 grid-cols-2">
  <a href="{{route('job.create')}}" class="">
   <div class="flex  items-center justify-center text-gray-50 p-3 bg-blue-400 hover:from-blue-300 hover:to-blue-500 rounded  ">
     <p class=" text-sm">
       Create
     </p>
   </div>
  </a>  
  <form action="" class="flex md:w-full col-span-2">
    <input
    class="p-2 pl-5 w-full mr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-4  rounded dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
    type="text"
    placeholder="Cari .."
    aria-label="Search"
    />
    <button class="flex px-4 items-center justify-center text-gray-100 p-2 bg-gray-500 rounded hover:bg-gray-600"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg></button>
  </form>
</div>