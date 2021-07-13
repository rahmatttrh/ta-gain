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
    {{-- <x-welcome>Highlight Progress</x-welcome> --}}
    
    
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
    {{-- <div class="flex justify-center ">
      <img class="md:w-1/2" src="{{asset('img/banner-clientnobg.png')}}" alt="">
    </div> --}}
    
    
    
  @endif

  @if(auth()->user()->isAdmin() || auth()->user()->isClient())
    {{-- MAP Teknisi--}}
    <div class="w-full  overflow-hidden rounded shadow-xs mb-4">
      {{-- <ul class="list-reset flex border-b">
        <li class="-mb-px mr-1">
          <a class=" inline-block bg-gray-500 rounded-t py-2 px-8 text-gray-50 " href="/">Teknisi</a>
        </li>
        <li class="mr-1">
          <a class="bg-white dark:bg-gray-700 inline-block py-2 px-8 text-gray-400 hover:text-blue-darker" href="{{ route('map.site') }}">Site</a>
        </li>
      </ul> --}}
      {{-- container map teknisi --}}
      <div id='map2' class="active:border"  style="width: 100%; height: 60vh"></div>
    </div>
    
    @push('maps')
    <script>
        const defaultLocationTeknisi = [114.59075, -3.31987]
        mapboxgl.accessToken = 'pk.eyJ1IjoicmFobWF0cmgiLCJhIjoiY2tqZHBvaWUxNWg2cTJxcndraHQ0bHNxMyJ9.AO_Soy7dCqnCy6ZnC9mNKA';
        var map2 = new mapboxgl.Map({
          container: 'map2',
          center: defaultLocationTeknisi,
          zoom: 4.4,
        });
        map2.on('load', function () {

            map2.addSource('earthquakes', {
                type: 'geojson',
                data: {!! $geoJsonTeknisi !!},
                cluster: true,
                clusterMaxZoom: 14,
                clusterRadius: 50
                
            });

            map2.addLayer({
                id: 'clusters', 
                type: 'circle',
                source: 'earthquakes',
                filter: ['has', 'point_count'],
                paint: {
                    'circle-color': [
                        'step',
                        ['get', 'point_count'],
                        '#51bbd6',
                        100,
                        '#f1f075',
                        750,
                        '#f28cb1'
                    ],
                    'circle-radius': [
                        'step',
                        ['get', 'point_count'],
                        20,
                        100,
                        30,
                        750,
                        40
                    ]
                }
            });

            map2.addLayer({
                id: 'cluster-count',
                type: 'symbol',
                source: 'earthquakes',
                filter: ['has', 'point_count'],
                layout: {
                    'text-field': '{point_count_abbreviated}',
                    'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                    'text-size': 12
                }
            });

            map2.addLayer({
                id: 'unclustered-point',
                type: 'circle',
                source: 'earthquakes',
                filter: ['!', ['has', 'point_count']],
                paint: {
                    'circle-color': '#A3A847',
                    'circle-radius': 6,
                    'circle-stroke-width': 1,
                    'circle-stroke-color': '#66DE93'
                }
            });

            map2.on('click', 'clusters', function (e) {
                var features = map2.queryRenderedFeatures(e.point, {
                    layers: ['clusters']
                });
                var clusterId = features[0].properties.cluster_id;
                map2.getSource('earthquakes').getClusterExpansionZoom(
                    clusterId,
                    function (err, zoom) {
                        if (err) return;

                        map2.easeTo({
                            center: features[0].geometry.coordinates,
                            zoom: zoom
                        });
                    }
                );
            });


            map2.on('click', 'unclustered-point', function (e) {
                var coordinates = e.features[0].geometry.coordinates.slice();
                var nama = e.features[0].properties.title;
                var no = e.features[0].properties.no;
                var lat = e.features[0].properties.lat;
                var long = e.features[0].properties.long;
                var tsunami;
           

                new mapboxgl.Popup()
                    .setLngLat(coordinates)
                    .setHTML(
                        "Teknisi<hr><span class='font-bold text-lg'>" + nama +"</span><br>"+no+"<hr>Lat: "+lat+"<br>Long: "+long
                    )
                    .addTo(map2);
            });

            map2.on('mouseenter', 'clusters', function () {
                map2.getCanvas().style.cursor = 'pointer';
            });
            map2.on('mouseleave', 'clusters', function () {
                map2.getCanvas().style.cursor = '';
            });
        });
        // console.log({!! $geoJsonTeknisi !!})

        // loadLocation({!! $geoJsonTeknisi !!})
        map2.setStyle('mapbox://styles/mapbox/outdoors-v11')
        map2.addControl(new mapboxgl.NavigationControl())
        // map.on('click', (e) => {
        //   const longitude = e.lngLat.lng
        //   const latitude = e.lngLat.lat
        //   console.log({longitude, latitude})
        // })
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