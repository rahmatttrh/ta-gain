@if ($paginator->hasPages())
<div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t        dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
  {{-- <span class="flex items-center col-span-3">
    Showing 21-30 of 100
  </span>
  <span class="col-span-2"></span> --}}
  <!-- Pagination -->
  <span class="flex  mt-2 sm:mt-auto mx-auto">
    <nav aria-label="Table navigation">
      <ul class="inline-flex items-center">
        
          @if ($paginator->onFirstPage())
          {{-- <li>
            <button  class="px-3 py-1 rounded-md mr-1 rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
              <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                <path
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                  clip-rule="evenodd"
                  fill-rule="evenodd"
                ></path>
              </svg>
            </button>
          </li>  --}}
          
          @else

          <li>
            <button wire:click="previousPage" class="px-3 py-1 rounded-md mr-1 border shadow-sm rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
              <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                <path
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                  clip-rule="evenodd"
                  fill-rule="evenodd"
                ></path>
              </svg>
            </button>
          </li>
          @endif
          @if ($paginator->hasMorePages())
          <li>
            <button wire:click="nextPage" class="px-3 py-1 mr-1 rounded-md border shadow-sm rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
              <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                <path
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"
                  fill-rule="evenodd"
                ></path>
              </svg>
            </button>
          </li>
          @else
          {{-- <li>
            <button  class="px-3 py-1 rounded-md mr-1  rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
              <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                <path
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"
                  fill-rule="evenodd"
                ></path>
              </svg>
            </button>
          </li> --}}
          @endif

          
          @foreach ($elements as $element)
            @if (is_array($element))
              @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li>
                  <button wire:click="gotoPage({{$page}})" class="px-3 mr-1 py-1 bg-blue-500 text-white rounded-md focus:outline-none focus:shadow-outline-purple">
                    {{$page}}
                  </button>
                </li>
                @else
                <li>
                  <button wire:click="gotoPage({{$page}})" class="px-3 mr-1 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                    {{$page}}
                  </button>
                </li>
                @endif
              @endforeach
            @endif
          @endforeach
        
        
        
      </ul>
    </nav>
  </span>
</div> 
@endif