<x-guest-layout>
  @section('title')
      Login
  @endsection
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="{{ asset('img/banner.jpg') }}"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="{{ asset('img/banner.jpg') }}"
              alt="Office"
            />
        </div>
          <div class="flex items-center  p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <span class="text-4xl font-bold"><span class="text-blue-600">PT GAIN</span>
              {{-- <P class="text-sm text-gray-400 font-semibold">Global Operations Engineering System</P> --}}
              <hr class="mb-4 mt-2">
              <form method="POST" action="{{ route('login') }}">
                  
              @csrf
              <label class="block text-sm">
                <span class="text-gray-500 dark:text-gray-400">Email</span>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="me@email.com"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-500 dark:text-gray-400">Password</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************"
                  type="password" name="password" required autocomplete="current-password" id="password"
                />
              </label>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button type="submit" name="submit" 
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-full active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple"
                href="../index.html"
              >
                Log in
              </button>
              </form>
              <hr class="my-8" />

              
              <p class="text-xs text-center  text-gray-400 dark:text-gray-400 hover:text-gray-500">
                PT. Global Abadi Inti Nusantara (GAIN)
              </p>
              <p class="text-xs text-center  text-blue-400 dark:text-gray-400 hover:text-gray-500">
                *Masih Dalam Pengembangan :)
              </p>
              {{-- <p class="mt-4">
                <a
                  class="text-sm font-medium text-gray-400 dark:text-gray-400 hover:text-gray-500"
                  href="{{ route('password.request') }}"
                >
                  Forgot your password?
                </a>
              </p>
              <p class="mt-1">
                <a
                  class="text-sm font-medium text-gray-400 dark:text-gray-400 hover:text-gray-500"
                  href="{{ route('register') }}"
                >
                  Create account
                </a>
              </p> --}}
            </div>
          </div>
        </div>
</x-guest-layout>
