<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{jobActivity, JobPhoto, Teknisi, Order, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\{Hash, Storage};


class TeknisiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $teknisi;
    public function __invoke(Request $request)
    {
        $teknisis = Teknisi::all();
        return view('pages.teknisi', compact('teknisis'));
    }

    public function create()
    {
        return view('partials.formTeknisi');
    }

    public function store()
    {
        request()->validate([
            'namaTeknisi' => 'required',
            'noTeknisi' => 'required',
            'email' => 'required',
            'area' => 'required',
            'noRek' => 'required',
            'fotoKtp' => request('fotoKtp') ? 'image|mimes:jpg,jpeg,png' : '',
            'fotoDiri' => request('fotoDiri') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);

        Teknisi::create([
            'nama' => request('namaTeknisi'),
            'no_hp' => request('noTeknisi'),
            'email' => request('email'),
            'foto_ktp' => request('fotoKtp') ? request()->file('fotoKtp')->store('images/ktp') : '',
            'foto_diri' => request('fotoDiri') ? request()->file('fotoDiri')->store('images/diri') : '',
            'area' => request('area'),
            'no_rek' => request('noRek'),

        ]);

        User::create([
            'name' => request('namaTeknisi'),
            'email' => request('email'),
            'password' => Hash::make('12345678'),
            'level' => 'teknisi'
        ]);
        return redirect()->to('teknisi')->with('berhasil', 'Berhasil disimpan');
    }

    // Edit teknisi dengan menerima Teknisi ID dari slug
    public function edit(Teknisi $teknisi)
    {
        return view('partials.formEditTeknisi',  [
            'teknisi' => Teknisi::where('id', $teknisi->id)->get()->first(),
        ]);
    }
    public function update(Teknisi $teknisi)
    {
        // Validasi input
        request()->validate([
            'namaTeknisi' => 'required',
            'noTeknisi' => 'required',
            // 'email' => 'required',
            'area' => 'required',
            'noRek' => 'required',
            'fotoKtp' => request('fotoKtp') ? 'image|mimes:jpg,jpeg,png' : '',
            'fotoDiri' => request('fotoDiri') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);

        // Cek jika ada inputan file foto baru
        if (request('fotoKtp')) {
            // Jika ada inputan baru, hapus foto lama
            // Lalu input foto baru ke database
            Storage::delete($teknisi->foto_ktp);
            $fotoKtp = request()->file('fotoKtp')->store('images/ktp');
        } elseif ($teknisi->foto_ktp) {
            // Jika tidak ada foto baru maka gunakan foto lama
            $fotoKtp = $teknisi->foto_ktp;
        } else {
            $fotoKtp = null;
        }

        if (request('fotoDiri')) {
            Storage::delete($teknisi->foto_diri);
            $fotoDiri = request()->file('fotoDiri')->store('images/diri');
        } elseif ($teknisi->foto_diri) {
            $fotoDiri = $teknisi->foto_diri;
        } else {
            $fotoDiri = null;
        }

        // Update ke database
        $teknisi->update([
            'nama' => request('namaTeknisi'),
            'no_hp' => request('noTeknisi'),
            // 'email' => request('email'),
            'foto_ktp' => $fotoKtp,
            'foto_diri' => $fotoDiri,
            'area' => request('area'),
            'no_rek' => request('noRek'),
        ]);
        User::where('email', request('email'))->update([
            'name' => request('namaTeknisi'),

        ]);
        return redirect()->back()->with('berhasil', 'Data berhasil diubah.');
    }

    public function delete(Teknisi $teknisi)
    {
        // dd($teknisi->id);
        $user = User::where('email', $teknisi->email);
        $user->delete();
        Storage::delete($teknisi->foto_ktp);
        Storage::delete($teknisi->foto_diri);
        $teknisi->delete();
        return redirect()->back()->with('berhasil', 'Data berhasil dihapus.');
    }

    public function order()
    {
        $teknisi = Teknisi::where('email', auth()->user()->email)->get()->first();
        return view('pages-teknisi.teknisi-order', [
            'orders' => $teknisi->orders
        ]);
    }

    public function getTeknisiId()
    {
        $this->teknisi = Teknisi::where('email', auth()->user()->email)->first();
        return $this->teknisi->id;
    }

    public function profile()
    {
        return view('pages-teknisi.teknisi-profile', [
            'teknisi' => Teknisi::where('email', auth()->user()->email)->get()->first(),
        ]);
    }
    public function jobreport()
    {
        $teknisi = Teknisi::where('email', auth()->user()->email)->get()->first();
        return view('pages-teknisi.teknisi-jobreport', [
            'orders' => $teknisi->orders,
        ]);
    }

    public function detailJobreport(Order $order)
    {
        return view('pages-client.client-jobreport-detail', [
            'teknisi' => Teknisi::where('email', auth()->user()->email)->get()->first(),
            'order' => Order::where('id', $order->id)->get()->first(),
            'activities' => jobActivity::where('order_id', $order->id)->paginate(100),
            'jobphotos' => JobPhoto::where('order_id', $order->id)->paginate(100),
        ]);
    }

    public function storeJobreport()
    {
        request()->validate([
            'order_id' => 'required',
            'pelanggan_id' => 'required',
            'teknisi_id' => 'required',
            'judul_foto' => 'required',
            'foto_pekerjaan' => 'required',
            // Cek jika ada input foto maka formatnya harus image
            'foto_pekerjaan' => request('foto_pekerjaan') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);

        $order = Order::where('id', request('order_id'))->get()->first();
        // dd($order);
        $orderName = $order->site;
        JobPhoto::create([
            'order_id' => request('order_id'),
            'pelanggan_id' => request('pelanggan_id'),
            'teknisi_id' => request('teknisi_id'),
            'judul_foto' => request('judul_foto'),
            'deskripsi_foto' => request('deskripsi_foto'),
            // Cek jika ada input foto maka simpan ke database, dan storage
            'foto_pekerjaan' => request('foto_pekerjaan') ? request()->file('foto_pekerjaan')->store('images/foto-pekerjaan/' . $orderName) : '',
            'status' => '1'
        ]);

        $orderId = request('order_id');

        return redirect($orderId . '/jobreport-detail')->with('berhasil', 'Report berhasil disimpan.');

        // return view('pages-teknisi.teknisi-jobreport-detail', [
        //     'order' => Order::where('id', $order->id)->get()->first(),
        //     'activities' => jobActivity::where('order_id', $order->id)->paginate(100)
        // ]);
    }


    // Rahmat
    // ke halaman update revisi
    public function revisiReport(JobPhoto $job)
    {
        return view('pages-teknisi.teknisi-revisi-report', [
            'order' => Order::where('id', $job->order_id)->get()->first(),
            'job' => JobPhoto::where('id', $job->id)->get()->first(),

        ]);
    }
    // update job_photo
    public function updateRevisi(JobPhoto $job)
    {
        request()->validate([
            'judul_foto' => 'required',
            'foto_pekerjaan' => request('foto_pekerjaan') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);
        // dd($job);
        $order = Order::where('id',  $job->order_id)->get()->first();
        // dd($order);
        $orderName = $order->site;

        if (request('foto_pekerjaan')) {
            Storage::delete($job->foto_pekerjaan);
            $fotoPekerejaan = request()->file('foto_pekerjaan')->store('images/foto-pekerjaan/' . $orderName);
        } elseif ($job->foto_pekerjaan) {
            $fotoPekerejaan = $job->foto_pekerjaan;
        } else {
            $fotoPekerejaan = null;
        }

        $job->update([
            'judul_foto' => request('judul_foto'),
            'deskripsi_foto' => request('deskripsi_foto'),
            'foto_pekerjaan' => $fotoPekerejaan,
            'status' => '1'
        ]);

        return redirect()->to('teknisi-jobreport')->with('berhasil', 'Revisi berhasil');
    }



    // nurdin
    public function revisiJobreport(Request $request)
    {
        request()->validate([
            'judul_foto' => 'required',
            // 'foto_pekerjaan' => 'required',
            // Cek jika ada input foto maka formatnya harus image
            'revisi_foto_pekerjaan' => request('foto_pekerjaan') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);

        // Cek jika ada inputan file foto baru
        if (request('foto_pekerjaan')) {
            // Jika ada inputan baru, hapus foto lama
            // Lalu input foto baru ke database
            Storage::delete($teknisi->foto_ktp);
            $fotoKtp = request()->file('fotoKtp')->store('images/ktp');
        } elseif ($teknisi->foto_ktp) {
            // Jika tidak ada foto baru maka gunakan foto lama
            $fotoKtp = $teknisi->foto_ktp;
        } else {
            $fotoKtp = null;
        }




        DB::table('job_photos')
            ->where('id', $request->job_photo_id)
            ->update([
                'judul_foto' => request('judul_foto'),
                'deskripsi_foto' => request('deskripsi_foto'),
                // Cek jika ada input foto maka simpan ke database, dan storage
                'foto_pekerjaan' => request('revisi_foto_pekerjaan') ? request()->file('revisi_foto_pekerjaan')->store('images/foto-pekerjaan') : '',
                'status' => '1'
            ]);

        return redirect()->back()->with('berhasil', 'Data berhasil diubah.');
    }

    public function finish()
    {

        return view('pages-teknisi.teknisi-finish', [
            'orders' => Order::get(),
            'teknisi' => Teknisi::where('email', auth()->user()->email)->get()->first(),
        ]);
    }

    public function payment()
    {
        return view('pages-teknisi.teknisi-payment', [
            'orders' => Order::get(),
            'teknisi' => Teknisi::where('email', auth()->user()->email)->get()->first(),
        ]);
    }
    public function complete()
    {
        return view('pages-teknisi.teknisi-complete', [
            'orders' => Order::get(),
            'teknisi' => Teknisi::where('email', auth()->user()->email)->get()->first(),
        ]);
    }

    public function wallet()
    {
        return view('pages-teknisi.teknisi-wallet', [
            'orders' => Order::orderBy('id', 'asc')->paginate(100)
        ]);
    }
    public function withdraw()
    {
        return view('pages-teknisi.teknisi-withdraw', [
            'orders' => Order::orderBy('id', 'asc')->paginate(100)
        ]);
    }
}
