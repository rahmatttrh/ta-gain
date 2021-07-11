<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{jobActivity, Joborder, JobPhoto, Kordinator, Order, Pelanggan, Teknisi};


class PagesController extends Controller
{

    public $long, $lat;
    public $geoJsonSite, $geoJsonTeknisi;
    private function loadLocSite()
    {
        $orders = Order::where('status', 3)->orWhere('status', 4)->orWhere('status', 5)->orWhere('status', 6)->orWhere('status', 7)->orWhere('status', 8)->orWhere('status', 9)->get();

        $customLocSite = [];
        foreach ($orders as $order) {
            if ($order->status == 3) {
                $status = 'Menuggu Kordinator';
                $marker = 'url(img/marker.png)';
            } elseif ($order->status == 4) {
                $status = 'Menunggu Teknisi';
                $marker = 'url(img/marker.png)';
            } elseif ($order->status == 5) {
                $status = 'On Progress';
                $marker = 'url(img/marker-blue.png)';
            } elseif ($order->status == 6) {
                $status = 'Order Report';
                $marker = 'url(img/marker-blue.png)';
            } elseif ($order->status == 7) {
                $status = 'Order Bast';
                $marker = 'url(img/marker-blue.png)';
            } elseif ($order->status == 8) {
                $status = 'Ready to Payment';
                $marker = 'url(img/marker-blue.png)';
            } elseif ($order->status == 9) {
                $status = 'Order Complete';
                $marker = 'url(img/marker-green.png)';
            }

            // dd($order->kordinator->fotoDiri);
            $customLocSite[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [$order->longitude, $order->latitude],
                    'type' => 'Point'
                ],
                'properties' => [
                    'locationId' => $order->id,
                    'title' => $order->site,
                    'kordinator' => $order->kordinator ? $order->kordinator->nama : '',
                    'image' => $order->kordinator ? $order->kordinator->foto_diri : '',
                    'kabupaten' => $order->kabupaten,
                    'provinsi' => $order->provinsi,
                    'markerLogo' => $marker,
                    'description' => $status
                ]
            ];
        }

        $geoLocationSite = [
            'type' => 'featureCollection',
            'features' => $customLocSite
        ];
        $geoJsonSite = collect($geoLocationSite)->toJson();
        $this->geoJsonSite = $geoJsonSite;
    }
    private function loadLocTeknisi()
    {
        $teknisis = Teknisi::get();

        $customLocTeknisi = [];
        foreach ($teknisis as $teknisi) {

            
            
            // $address= $this->getaddress($teknisi->latitude,$teknisi->longitude);
            // dd($address);
            // dd($teknisi->latitude);
            $marker = 'url(img/marker-teknisi.png)';
            $customLocTeknisi[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [$teknisi->longitude, $teknisi->latitude],
                    'type' => 'Point'
                ],
                'properties' => [
                    'locationId' => $teknisi->id,
                    'title' => $teknisi->nama,
                    'no' => $teknisi->no_hp,
                    'image' => $teknisi->foto_diri,
                    'area' => $teknisi->area,
                    'lat' => $teknisi->latitude,
                    'long' => $teknisi->longitude,
                    // 'address' => $address,
                    'markerLogo' =>  $marker,
                    // 'description' => $status
                ]
            ];
        }

        $geoLocationTeknisi = [
            'type' => 'featureCollection',
            'features' => $customLocTeknisi
        ];
        $geoJsonTeknisi = collect($geoLocationTeknisi)->toJson();
        $this->geoJsonTeknisi = $geoJsonTeknisi;
    }

    // Get address from latlong
    // Belum bisa karena harus SSL
    function getaddress($lat,$lng)
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
        $json = @file_get_contents($url);
        $data=json_decode($json);
        $status = $data->status;
        if($status=="OK")
        {
        return $data->results[0]->formatted_address;
        }
        else
        {
        return $status;
        }
    }

    public function Dashboard()
    {
        if (auth()->user()->level == "admin") {
            // $this->loadLocSite();
            $this->loadLocTeknisi();
            // dd($geoJson);
            return view('dashboard', [
                'totalClient' => Pelanggan::count(),
                'totalKordinator' => Kordinator::count(),
                'totalTeknisi' => Teknisi::count(),
                'totalOrder' => Order::count(),
                'activities' => JobActivity::orderBy('created_at', 'asc')->latest()->paginate(5),
                // 'geoJsonSite' => $this->geoJsonSite,
                'geoJsonTeknisi' => $this->geoJsonTeknisi
            ]);
        }

        if (auth()->user()->level == "client") {
            $this->loadLocTeknisi();
            return view('dashboard', [
                'orders' => Order::where('pelanggan_id', $this->getClientId())->get(),
                'totalProjectClient' => Order::where('pelanggan_id', $this->getClientId())->count(),
                'totalOnProgressClient' => Order::where('pelanggan_id', $this->getClientId())->where('status', 5)->count(),
                'activities' => JobActivity::where('pelanggan_id', $this->getClientId())->orderBy('created_at', 'asc')->latest()->paginate(5),
                'validasi' => JobPhoto::where('pelanggan_id', $this->getClientId())->where('status', 1)->get()->first(),
                'geoJsonTeknisi' => $this->geoJsonTeknisi
            ]);
        }
        if (auth()->user()->level == "kordinator") {
            $kordinator = Kordinator::where('id', $this->getKordinatorId())->get()->first();
            return view('dashboard', [
                'orders' => Order::where('kordinator_id', $this->getKordinatorId())->get(),
                'orderBaru' => Order::where('kordinator_id', $this->getKordinatorId())->where('status', 3)->get()->first(),
                'onProgress' => Order::where('kordinator_id', $this->getKordinatorId())->where('status', 5)->count()


            ]);
        }
        if (auth()->user()->level == "teknisi") {
            $getGeoIp = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
            // $getGeoIp = geoip()->getLocation( '182.2.168.59');
            // dd($getGeoIp);
            $teknisi = Teknisi::where('email', auth()->user()->email)->get()->first();

            $teknisi->update([
                'latitude' => $getGeoIp['lat'],
                'longitude' => $getGeoIp['lon']
            ]);
            return view('dashboard', [
                'teknisi' => $teknisi,
                'revisi' => JobPhoto::where('teknisi_id', $this->getTeknisiId())->where('status', 201)->get()->first()

            ]);
        }
    }

    public function DashboardMapSite()
    {
        if (auth()->user()->level == "admin") {
            $this->loadLocSite();
            // $this->loadLocTeknisi();
            // dd($geoJson);
            return view('dashboard-map-site', [
                'totalClient' => Pelanggan::count(),
                'totalKordinator' => Kordinator::count(),
                'totalTeknisi' => Teknisi::count(),
                'totalOrder' => Order::count(),
                'activities' => JobActivity::orderBy('created_at', 'asc')->latest()->paginate(5),
                'geoJsonSite' => $this->geoJsonSite,
                // 'geoJsonTeknisi' => $this->geoJsonTeknisi
            ]);
        }

        if (auth()->user()->level == "client") {
            $this->loadLocSite();
            return view('dashboard-map-site', [
                'orders' => Order::where('pelanggan_id', $this->getClientId())->get(),
                'totalProjectClient' => Order::where('pelanggan_id', $this->getClientId())->count(),
                'totalOnProgressClient' => Order::where('pelanggan_id', $this->getClientId())->where('status', 5)->count(),
                'activities' => JobActivity::where('pelanggan_id', $this->getClientId())->orderBy('created_at', 'asc')->latest()->paginate(5),
                'validasi' => JobPhoto::where('pelanggan_id', $this->getClientId())->where('status', 1)->get()->first(),
                'geoJsonSite' => $this->geoJsonSite,
            ]);
        }
        if (auth()->user()->level == "kordinator") {
            $kordinator = Kordinator::where('id', $this->getKordinatorId())->get()->first();
            return view('dashboard-map-site', [
                'orders' => Order::where('kordinator_id', $this->getKordinatorId())->get(),
                'orderBaru' => Order::where('kordinator_id', $this->getKordinatorId())->where('status', 3)->get()->first(),
                'onProgress' => Order::where('kordinator_id', $this->getKordinatorId())->where('status', 5)->count()


            ]);
        }
        if (auth()->user()->level == "teknisi") {
            $teknisi = Teknisi::where('email', auth()->user()->email)->get()->first();
            return view('dashboard-map-site', [
                'teknisi' => $teknisi,
                'revisi' => JobPhoto::where('teknisi_id', $this->getTeknisiId())->where('status', 201)->get()->first()

            ]);
        }
    }

    public function getKordinatorId()
    {
        $kordinator = Kordinator::where('email', auth()->user()->email)->get()->first();
        return $kordinator->id;
    }
    public function getTeknisiId()
    {
        $teknisi = Teknisi::where('email', auth()->user()->email)->get()->first();
        return $teknisi->id;
    }
    public function getClientId()
    {
        $this->client = Pelanggan::where('email', auth()->user()->email)->first();
        return $this->client->id;
    }
}
