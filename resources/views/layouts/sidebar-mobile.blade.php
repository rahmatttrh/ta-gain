<div
  x-show="isSideMenuOpen"
  x-transition:enter="transition ease-in-out duration-150"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition ease-in-out duration-150"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0"
  class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
</div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-gray-700 dark:bg-gray-700 md:hidden"
  x-show="isSideMenuOpen"
  x-transition:enter="transition ease-in-out duration-150"
  x-transition:enter-start="opacity-0 transform -translate-x-20"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition ease-in-out duration-150"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0 transform -translate-x-20"
  @click.away="closeSideMenu"
  @keydown.escape="closeSideMenu">
    <div class="py-1 text-gray-500 dark:text-gray-400">
      <x-sidebar-header></x-sidebar-header>
      <ul class="mt-3">
        <li class="relative px-6 py-3">
          @if (request()->is('/'))
          <span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
          @endif
          <a
            class="inline-flex items-center w-full text-sm font-semibold text-gray-300 transition-colors duration-150 hover:text-blue-400 dark:hover:text-gray-200 dark:text-gray-400"
            href="/"
          >
          <svg class="w-7 h-7 p-1 text-white bg-gradient-to-r from-blue-300 to-blue-500 rounded" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
            <span class="ml-4">Dashboard</span>
          </a>
        </li>
      </ul>
      <ul>
        @if(auth()->user()->isAdmin())
          <x-sidebar-admin></x-sidebar-admin>
        @endif
        @if(auth()->user()->isClient())
          <x-sidebar-client></x-sidebar-client>
        @endif
        @if (auth()->user()->isKordinator())
          <x-sidebar-kordinator></x-sidebar-kordinator>
        @endif
        @if (auth()->user()->isTeknisi())
          <x-sidebar-teknisi></x-sidebar-teknisi>
        @endif
      </ul>
         
      @if(auth()->user()->isAdmin())
      <div class="px-6 my-6">
        <a href="{{route('job.create')}}">
          <button class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gradient-to-b from-blue-400 to-blue-500 hover:from-blue-300 hover:to-blue-500 rounded active:bg-teal-600 hover:bg-teal-800 focus:outline-none focus:shadow-outline-teal">
            Buat Order
            <span class="ml-2" aria-hidden="true">+</span>
          </button>
        </a>
      </div>
      @endif
    </div>
</aside>