<li class="relative px-6 py-1">
  @if (request()->is('client') || request()->is('kordinator') || request()->is('teknisi')|| request()->is('client/create') || request()->is('kordinator/create') || request()->is('teknisi/create'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <button class="{{request()->is('client') || request()->is('kordinator') || request()->is('teknisi') || request()->is('client/create') || request()->is('kordinator/create') || request()->is('teknisi/create') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" @click="togglePagesMenu" aria-haspopup="true">
    <span class="inline-flex items-center">
      <svg class="w-7 h-7 p-1 text-white bg-gradient-to-br from-indigo-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"></path>
        <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"></path>
        <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"></path>
      </svg>
      <span class="ml-4">Master</span>
    </span>
    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
    </svg>
  </button>
  <template x-if="isPagesMenuOpen">
    <ul x-transition:enter="transition-all ease-in-out duration-300" x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl" x-transition:leave="transition-all ease-in-out duration-300" x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0" class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
      <li class="px-2 py-1 transition-colors duration-150 hover:text-blue-500 dark:hover:text-gray-200">
        <a class="w-full" href="{{route('client')}}">Client</a>
      </li>

      <li class="px-2 py-1 transition-colors duration-150 hover:text-blue-500 dark:hover:text-gray-200">
        <a class="w-full" href="{{route('kordinator')}}">
          Koordinator
        </a>
      </li>
      <li class="px-2 py-1 transition-colors duration-150 hover:text-blue-500 dark:hover:text-gray-200">
        <a class="w-full" href="{{route('teknisi')}}">
          Teknisi
        </a>
      </li>

    </ul>
  </template>
</li>
{{-- <li class="relative px-6 py-1">
  @if (request()->is('job-create'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-create') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-500 dark:hover:text-gray-200" href="{{route('job.create')}}">
<svg class="w-7 h-7 p-1 text-white bg-gradient-to-b from-blue-300 to-blue-500 rounded" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
</svg>
<span class="ml-4">Create Order</span>
</a>
</li> --}}

<li class="relative px-6 py-1">
  @if (request()->is('job-draft'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-draft')  ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('job.draft')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-b from-blue-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M8 2a1 1 0 000 2h2a1 1 0 100-2H8z"></path>
      <path d="M3 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6h-4.586l1.293-1.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L10.414 13H15v3a2 2 0 01-2 2H5a2 2 0 01-2-2V5zM15 11h2a1 1 0 110 2h-2v-2z"></path>
    </svg>
    <span class="ml-4">Draft</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('job-delegasi'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-delegasi') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('job.delegasi')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-b from-blue-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Delegate</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('job-order') ||  request()->is('job-progres-detail') || request()->is('job-detail'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-order') || request()->is('job-progres-detail') || request()->is('job-detail') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('job')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-b from-blue-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Progress</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('job-finish'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-finish') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('job.finish')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
      <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Validate</span>
  </a>
</li>

<li class="relative px-6 py-1">
  @if (request()->is('job-ready-to-pay'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-ready-to-pay') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('job.ready')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-l from-blue-400 to-purple-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
      <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Payment</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('job-complete'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-complete') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('job.complete')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-bl from-indigo-300 to-indigo-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Complete</span>
  </a>
</li>