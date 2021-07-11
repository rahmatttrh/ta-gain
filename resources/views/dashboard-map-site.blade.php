<x-app-layout>
  @section('title')
      Dashboard
  @endsection
  <x-header>DASHBOARD</x-header>

  @if(auth()->user()->isAdmin())
    <x-card-admin>
      <x-slot name="kordinator">
        {{$totalKordinator}} 
      </x-slot>
      <x-slot name="teknisi">
        {{$totalTeknisi}} 
      </x-slot>
      <x-slot name="order">
        {{$totalOrder}} 
      </x-slot>
      <x-slot name="client">
        {{$totalClient}} 
      </x-slot>
    </x-card-admin>
    
    
  @endif

  @if(auth()->user()->isClient())
    {{-- <x-welcome>Client</x-welcome> --}}
    @if ($validasi)
    <div class="mb-2 flex">
      <div class="inline-flex items-center dark:bg-gray-700 dark:text-gray-200  bg-white leading-none text-pink-600 rounded-full p-2 shadow-xs text-teal text-sm">
        <span class="inline-flex bg-pink-500 text-white rounded-full h-6 px-4 font-semibold hover:bg-pink-400 justify-center items-center"><a href="{{route('client.jobreport')}}">Lihat
          </a></span>
        <span class="inline-flex px-2">Validasi Alert!</span>
      </div>
    </div>
    @endif
    <x-card-client>
      <x-slot name="myProject">
        {{$totalProjectClient}} 
      </x-slot>
      <x-slot name="onProgress">
        {{$totalOnProgressClient}} 
      </x-slot>
    </x-card-client>
  @endif

  @if (auth()->user()->isAdmin() || auth()->user()->isClient())
      {{-- MAP Site--}}
    <div class="w-full  overflow-hidden rounded shadow-xs mb-5">
      <ul class="list-reset flex border-b">
        <li class="-mb-px mr-1">
          <a class="bg-white dark:bg-gray-700 inline-block  py-2 px-8 text-gray-500 font-semibold" href="/">Teknisi</a>
        </li>
        <li class="mr-1">
          <a class="bg-white inline-block bg-blue-500 rounded-t py-2 px-8 text-white hover:text-blue-darker font-semibold" href="{{route ('map.site')}}">Site</a>
        </li>
      </ul>
      
      {{-- Container map site--}}
      <div id='map' class="active:border"  style="width: 100%; height: 60vh"></div>
    </div>

     @push('maps')
     <script>
      const defaultLocation = [114.59075, -3.31987]
      mapboxgl.accessToken = 'pk.eyJ1IjoicmFobWF0cmgiLCJhIjoiY2tqZHBvaWUxNWg2cTJxcndraHQ0bHNxMyJ9.AO_Soy7dCqnCy6ZnC9mNKA';
      var map = new mapboxgl.Map({
        container: 'map',
        center: defaultLocation,
        zoom: 4.4,
      });

      const loadLocation = (geoJson) => {
        geoJson.features.forEach((location)=>{
          const {geometry, properties} = location
          const {iconSize, locationId,title,kordinator,image,description,provinsi,kabupaten, markerLogo} = properties
          // console.log(location)
          let marker = document.createElement('div')
          marker.clasName = 'marker' + locationId
          marker.id = locationId
          marker.style.backgroundImage = markerLogo
          
          marker.style.backgroundSize = 'cover'
          marker.style.width = '35px'
          marker.style.height = '35px'

          const content = `<div>
                <table>
                  <tbody>
                    <tr>
                      <td style="padding: 0px 10px">Site</td>
                      <td style="padding: 0px 10px">${title}</td>
                    </tr>
                    <tr>
                      <td style="padding: 0px 10px">Kordinator</td>
                      <td style="padding: 0px 10px">${kordinator}</td>
                    </tr>
                    <tr>
                      <td style="padding: 0px 10px">Alamat</td>
                      <td style="padding: 0px 10px">${kabupaten}, ${provinsi}</td>
                    </tr>
                    <tr>
                      
                      {{-- <td style="padding: 0px 10px">{!! asset('storage/' .$image) !!}</td> --}}
                      <img style="width:200px; height:90px;object-fit: cover;margin-bottom:10px;border-radius:5px" src="img/network.png" alt="">
                    </tr>
                    <tr>
                      <td style="padding: 0px 10px">Status</td>
                      <td style="padding: 0px 10px">${description}</td>
                    </tr>
                  </tbody>
                </table>
              </div> `
          const popup = new mapboxgl.Popup({
            offset:25
          }).setHTML(content).setMaxWidth("400px")

          new mapboxgl.Marker(marker).setLngLat(geometry.coordinates).setPopup(popup).addTo(map)
        })
      }

      loadLocation({!! $geoJsonSite !!})
      map.setStyle('mapbox://styles/mapbox/outdoors-v11')
      map.addControl(new mapboxgl.NavigationControl())
   
      </script>
     
    @endpush
  @endif

  @if(auth()->user()->isKordinator())
    
    @if ($orderBaru)
    <div class="mb-2 flex">
      <div class="inline-flex items-center dark:bg-gray-700 dark:text-gray-200  bg-white leading-none text-pink-600 rounded-full p-2 shadow-xs text-teal text-sm">
        <span class="inline-flex bg-pink-500 text-white rounded-full h-6 px-4 font-semibold hover:bg-pink-400 justify-center items-center"><a href="{{route('kordinator.inbox')}}">Lihat
          </a></span>
        <span class="inline-flex px-2">Anda punya job order baru!</span>
      </div>
    </div>
    @endif
    <x-card-kordinator>
      <x-slot name="myOrder">
        {{$orders->count()}} 
      </x-slot>
      <x-slot name="myProgress">
        {{$onProgress}} 
      </x-slot>
    </x-card-kordinator>
    <div class="flex justify-center ">
      <img class="md:w-1/2" src="{{asset('img/banner-kordinator.png')}}" alt="">
    </div>
    
    {{-- <x-table-kordinator></x-table-kordinator> --}}
  @endif

  @if(auth()->user()->isTeknisi())
    
    @if ($revisi)
    <div class="mb-2 flex">
      <div class="inline-flex items-center dark:bg-gray-700 dark:text-gray-200  bg-white leading-none text-pink-600 rounded-full p-2 shadow-xs text-teal text-sm">
        <span class="inline-flex bg-pink-500 text-white rounded-full h-6 px-4 font-semibold hover:bg-pink-400 justify-center items-center"><a href="{{route('jobreport.teknisi')}}">Lihat
          </a></span>
        <span class="inline-flex px-2">Revisi Alert!</span>
      </div>
    </div>
    @endif
    
    <x-card-teknisi>
      <x-slot name="myProject">{{$teknisi->orders->count()}}</x-slot>
      <x-slot name="onProgress">{{$teknisi->orders->where('status', 5)->count()}}</x-slot>
      <x-slot name="complete">{{$teknisi->orders->where('status', 6)->count()}}</x-slot>
    </x-card-teknisi>
    {{-- <x-table-teknisi></x-table-teknisi> --}}
    <div class="flex justify-center ">
      <img class="md:w-1/2" src="{{asset('img/banner-teknisi.png')}}" alt="">
    </div>
  @endif

  

      


  
</x-app-layout>