<?php

namespace App\Http\Controllers;

use App\Models\{Joborder, Kordinator, Teknisi, Order, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KordinatorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $kordinator, $nama;

    // ADMIN
    // Untuk Menampilkan semua kordinator
    public function __invoke(Request $request)
    {
        $kordinators = Kordinator::all();
        return view('pages.kordinator', compact('kordinators'));
    }

    // Inbox ketika ada kerjaan baru
    public function inbox()
    {
        $kordinatorId = $this->getKordinatorId();

        return view('pages-kordinator.kordinator-inbox', [
            'joborders' => DB::table('joborders')
                ->join('pelanggans', 'pelanggans.id', '=', 'joborders.pelanggan_id')
                ->join('orders', 'joborders.id', '=', 'orders.joborder_id')->where('orders.status', 3)->where('orders.kordinator_id', $kordinatorId)->groupBy('orders.joborder_id')
                ->select('joborders.id as joborder_id', 'pelanggans.nama', 'joborders.kode_jo', DB::raw('count(*) as jumlah_site'))
                ->paginate(20)
        ]);
    }

    public function inboxDetail(Joborder $joborder)
    {
        $kordinatorId = $this->getKordinatorId();
        return view('pages-kordinator.kordinator-inbox-detail', [
            'orders' => Order::where('status', 3)
                ->where('joborder_id', $joborder->id)
                ->where('kordinator_id', $kordinatorId)
                ->orderBy('id', 'asc')->paginate(100),
            'kordinators' => Kordinator::get()->all()
        ]);
    }

    // Setelah di respon oleh kordinator
    public function inboxRespond(Request $request)
    {
        $request->validate([
            'id_item' => 'required',
            'tanggapan' => 'required'
        ]);
        $arrayItem = $request->id_item;
        $jumlah = count($arrayItem);

        $tanggapan = $request->tanggapan;
        if ($tanggapan == 'terima') {
            for ($i = 0; $i < $jumlah; $i++) {
                DB::table('orders')
                    ->where('id', $arrayItem[$i])
                    ->update([
                        'status' => '4'
                    ]);
            }
            return redirect('/kordinator-delegasi')->with('berhasil', 'Langkah selanjutnya adalah delegasi ke teknisi.');
        } else if ($tanggapan == 'tolak') {
            for ($i = 0; $i < $jumlah; $i++) {
                DB::table('orders')
                    ->where('id', $arrayItem[$i])
                    ->update([
                        'alasan_penolakan' => $request->alasan_penolakan,
                        'status' => '2'
                    ]);
            }
            return redirect('/kordinator-inbox')->with('berhasil', 'Job Order ditolak.');
        }
    }

    // Job Delegasi
    public function delegasi()
    {
        return view('pages-kordinator.kordinator-delegasi', [
            'joborders' => DB::table('joborders')
                ->join('pelanggans', 'pelanggans.id', '=', 'joborders.pelanggan_id')
                ->join('orders', 'joborders.id', '=', 'orders.joborder_id')->where('orders.status', 4)->groupBy('orders.joborder_id')
                ->select('joborders.id as joborder_id', 'pelanggans.nama', 'joborders.kode_jo', DB::raw('count(*) as jumlah_site'))
                ->paginate(20)
        ]);
    }
    // Delegasi Detail
    public function delegasiOrder(Joborder $joborder)
    {
        return view('pages-kordinator.kordinator-delegasi-detail', [
            'orders' => Order::where('status', 4)
                ->where('pelanggan_id', $joborder->id)
                ->orderBy('id', 'asc')->paginate(100),
            'kordinators' => Kordinator::get()->all(),
            'teknisis' => Teknisi::get()->all()
        ]);
    }
    // Hand Over 
    public function handOver(Request $request)
    {
        $arrayItem = $request->id_item;
        $jumlah = count($arrayItem);

        $teknisis = $request->teknisis;

        for ($i = 0; $i < $jumlah; $i++) {
            DB::table('orders')
                ->where('id', $arrayItem[$i])
                ->update([
                    'status' => '5'
                ]);

            foreach ($teknisis as $key => $teknisi) {
                DB::table('order_teknisi')
                    ->insert([
                        'order_id' => $arrayItem[$i],
                        'teknisi_id' => $teknisi
                    ]);
            }
            // $order->teknisis()->sync(request('teknisis'));
        }
        // return redirect('/kordinator-delegasi')->with('berhasil', 'Job order sudah di delegasi ke teknisi.');
        return redirect()->back()->with('berhasil', 'Job order berhasil di delegasi ke teknisi.');
    }

    public function editOrder(Order $order)
    {
        return view('partials.formEditJob', [
            'order' => Order::where('id', $order->id)->get()->first(),
            'kordinators' => Kordinator::get()->all(),
            'teknisis' => Teknisi::get()
        ]);
    }
    // Untuk menambahkan kordinator baru
    public function create()
    {
        return view('partials.formKordinator');
    }
    public function store()
    {
        // Validasi
        request()->validate([
            'namaKordinator' => 'required',
            'noKordinator' => 'required',
            'email' => 'required',
            'area' => 'required',
            'noRek' => 'required',
            // Cek jika ada input foto maka formatnya harus image
            'fotoKtp' => request('fotoKtp') ? 'image|mimes:jpg,jpeg,png' : '',
            'fotoDiri' => request('fotoDiri') ? 'image|mimes:jpg,jpeg,png' : '',
        ]);

        Kordinator::create([
            'nama' => request('namaKordinator'),
            'no_hp' => request('noKordinator'),
            'email' => request('email'),
            // Cek jika ada input foto maka simpan ke database, dan storage
            'foto_ktp' => request('fotoKtp') ? request()->file('fotoKtp')->store('images/ktp') : '',
            'foto_diri' => request('fotoDiri') ? request()->file('fotoDiri')->store('images/diri') : '',
            'area' => request('area'),
            'no_rek' => request('noRek'),
        ]);

        // Masukan kordinator ke table User agar bisa Login
        User::create([
            'name' => request('namaKordinator'),
            'email' => request('email'),
            'password' => Hash::make('12345678'),
            'level' => 'kordinator'
        ]);
        // Kembali ke halaman daftar Kordinator
        return redirect()->to('kordinator')->with('berhasil', 'Data berhasil disimpan.');
    }

    // Edit kordinator dengan menerima Kordinator ID dari slug
    public function edit(Kordinator $kordinator)
    {
        return view('partials.formEditKordinator',  [
            'kordinator' => Kordinator::where('id', $kordinator->id)->get()->first(),
        ]);
    }
    public function update(Kordinator $kordinator)
    {
        // Validasi input
        request()->validate([
            'namaKordinator' => 'required',
            'noKordinator' => 'required',
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
            Storage::delete($kordinator->foto_ktp);
            $fotoKtp = request()->file('fotoKtp')->store('images/ktp');
        } elseif ($kordinator->foto_ktp) {
            // Jika tidak ada foto baru maka gunakan foto lama
            $fotoKtp = $kordinator->foto_ktp;
        } else {
            $fotoKtp = null;
        }

        if (request('fotoDiri')) {
            Storage::delete($kordinator->foto_diri);
            $fotoDiri = request()->file('fotoDiri')->store('images/diri');
        } elseif ($kordinator->foto_diri) {
            $fotoDiri = $kordinator->foto_diri;
        } else {
            $fotoDiri = null;
        }

        // Update ke database
        $kordinator->update([
            'nama' => request('namaKordinator'),
            'no_hp' => request('noKordinator'),
            // 'email' => request('email'),
            'foto_ktp' => $fotoKtp,
            'foto_diri' => $fotoDiri,
            'area' => request('area'),
            'no_rek' => request('noRek'),
        ]);
        // $user = User::where('email', request('email'))->get()->first();
        // dd($user);
        User::where('email', request('email'))->update([
            'name' => request('namaKordinator'),

        ]);
        return redirect()->back()->with('berhasil', 'Data berhasil diubah.');
    }

    public function delete(Kordinator $kordinator)
    {
        // dd($kordinator->id);
        $user = User::where('email', $kordinator->email);
        $user->delete();
        Storage::delete($kordinator->foto_ktp);
        Storage::delete($kordinator->foto_diri);
        $kordinator->delete();
        return redirect()->back()->with('berhasil', 'Data berhasil dihapus.');
    }
    // KORDINATOR
    // Menampilkan job order yg dimiliki
    public function order()
    {
        return view('pages-kordinator.kordinator-order', [
            'orders' => Order::where('status', '5')->orWhere('status', '202')->where('kordinator_id', $this->getKordinatorId())->paginate(100)
        ]);
    }

    public function editJob(Order $order)
    {

        return view('partials.formEditJob', [
            'order' => Order::where('id', $order->id)->get()->first(),
            'kordinators' => Kordinator::get()->all()
        ]);
    }

    public function profile()
    {
        return view('pages-kordinator.kordinator-profile', [
            'kordinator' => Kordinator::where('email', auth()->user()->email)->get()->first(),
        ]);
    }

    public function teknisi()
    {
        $teknisis = Teknisi::all();
        return view('pages-kordinator.kordinator-teknisi', compact('teknisis'));
    }

    public function finish()
    {
        return view('pages-kordinator.kordinator-finish', [
            'orders' => Order::where('kordinator_id', $this->getKordinatorId())->where('status', '6')->orWhere('status', 7)->paginate(100)
        ]);
    }
    public function payment()
    {
        return view('pages-kordinator.kordinator-payment', [
            'orders' =>  Order::where('kordinator_id', $this->getKordinatorId())->where('status', '8')->paginate(100)
        ]);
    }
    public function complete()
    {
        return view('pages-kordinator.kordinator-complete', [
            'orders' => Order::where('kordinator_id', $this->getKordinatorId())->where('status', '9')->paginate(100)
        ]);
    }

    public function wallet()
    {
        return view('pages-kordinator.kordinator-wallet', [
            'orders' => Order::orderBy('id', 'asc')->paginate(100)
        ]);
    }
    public function withdraw()
    {
        return view('pages-kordinator.kordinator-withdraw', [
            'orders' => Order::orderBy('id', 'asc')->paginate(100)
        ]);
    }

    public function getKordinatorId()
    {
        $this->kordinator = Kordinator::where('email', auth()->user()->email)->first();
        return $this->kordinator->id;
    }
}
