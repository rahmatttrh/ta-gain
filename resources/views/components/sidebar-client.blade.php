<li class="relative px-6 py-1">
  @if (request()->is('client-order') || request()->is('job-create') || request()->is('job-progres-detail') || request()->is('job-detail'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('client-order') || request()->is('job-create') || request()->is('job-progres-detail') || request()->is('job-detail') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('client-order')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-b from-blue-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Job Order</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('client-jobreport'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('client-jobreport') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('client.jobreport')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-br from-indigo-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
      <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Job Report</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('client-finish'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('job-order') || request()->is('job-create') || request()->is('job-progres-detail') || request()->is('job-detail') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('finish.order')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-br from-indigo-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
      <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Finish Order</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('client-ready'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('client-ready') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('ready.order')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-tr from-blue-300 to-purple-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
      <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Ready to Pay</span>
  </a>
</li>
<li class="relative px-6 py-1">
  @if (request()->is('client-complete'))
  <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
  @endif
  <a class="{{request()->is('client-complete') ? 'text-white dark:text-blue-500' : 'text-gray-300 dark:text-gray-400'}} inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200" href="{{route('complete.order')}}">
    <svg class="w-7 h-7 p-1 text-white bg-gradient-to-r from-indigo-300 to-blue-500 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
    <span class="ml-4">Complete Order</span>
  </a>
</li>