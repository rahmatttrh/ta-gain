<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Joborder, Kordinator, Order, Pelanggan, Teknisi, jobActivity};
use App\Imports\OrderImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\helpers;

class JobController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // ADMIN
    // Unntuk Menampilkan job order yg sudah di submit dari halaman Draft (Status : 2)
    public function __invoke(Request $request)
    {
        return view('pages.job-progres', [
            'orders' => Order::where('status', 5)->orWhere('status', 4)->orWhere('status', 3)->orWhere('status', 202)->orderBy('id', 'asc')->paginate(100),
            'kordinators' => Kordinator::get()->all()
        ]);
    }
    // Untuk membuat job order baru
    public function create()
    {
        return view('partials.formJob', [
            'clients' => Pelanggan::get()->all()
        ]);
    }
    // Import document Excel
    public function import()
    {
        Excel::import(new OrderImport, 'order.xlsx');

        return redirect('/job-order')->with('success', 'Data berhasil disimpan.');
    }
    // Store ke database
    public function store(Request $request)
    {
        request()->validate([
            'client' => 'required',
            'excel' => 'required'
        ]);
        Excel::import(new OrderImport, $request->file('excel'));

        return redirect('/job-draft')->with('berhasil', 'Silahkan pilih job order yang akan di Publish.');
        // return redirect()->back()->with('berhasil', 'Data berhasil disimpan.');
    }
    // Edit Job Order  / Delegasi order ke kordinator
    public function edit(Order $order)
    {
        return view('partials.formEditJob', [
            'order' => Order::where('id', $order->id)->get()->first(),
            'kordinators' => Kordinator::get()->all(),
            'teknisis' => Teknisi::get()
        ]);
    }

    public function update(Order $order)
    {
        $order->update([
            'pelanggan_id' => request('client'),
            'site' => request('site'),
            'provinsi' => request('provinsi'),
            'kabupaten' => request('kabupaten'),
            'alamat' => request('alamat'),
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
            'nama_projek' => request('nama_projek'),
            'no_telpon' => request('no_telpon'),
            'ukuran' => request('ukuran'),
            'system_antena' => request('system_antena'),
            'jenis_pekerjaan' => request('jenis_pekerjaan'),
            'harga_paket' => request('harga_paket'),
            'total_reimburse' => request('total_reimburse'),
            'grand_total' => request('grand_total'),
            'modem' => request('modem'),
        ]);



        return redirect('/job-order')->with('berhasil', 'Data berhasil diubah');
    }

    // Job order setelah di import (status 1)
    public function draft()
    {
        return view('pages.job-draft', [
            $orders = DB::table('orders')
                ->select('pelanggan_id', DB::raw('count(*) as jumlah_site'))
                ->where('status', 1)
                ->groupBy('pelanggan_id'),

            'joborders' => DB::table('pelanggans')
                ->joinSub($orders, 'orders', function ($join) {
                    $join->on('pelanggans.id', '=', 'orders.pelanggan_id');
                })->paginate(10)

        ]);
    }

    public function draftPelanggan(Pelanggan $pelanggan)

    {
        return view('pages.job-draft-detail', [
            'orders' => Order::where('status', 1)
                ->where('pelanggan_id', $pelanggan->id)
                ->orderBy('id', 'asc')->paginate(100),
            'pelanggan_id' => $pelanggan->id
        ]);
    }

    // Memasukan job order ke halaman job order dari halaman draft (Merubah status ke 2)
    public function publish(Request $request)
    {
        $arrayItem = $request->id_item;
        $jumlah = count($arrayItem);
        $jobOrder = $this->getJo();

        Joborder::create([
            'kode_jo' => $jobOrder,
            'pelanggan_id' => $request->pelanggan_id,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => '1'
        ]);

        $joborderId = $this->getIdJoborder();

        for ($i = 0; $i < $jumlah; $i++) {
            DB::table('orders')
                ->where('id', $arrayItem[$i])
                ->update([
                    'status' => '2',
                    'joborder_id' => $joborderId
                ]);
        }
        return redirect('/job-draft')->with('berhasil', 'Selanjutnya delegasi ke kordinator.');
    }



    public function delegasi()
    {
        return view('pages.job-delegasi', [
            'joborders' => DB::table('joborders')
                ->join('pelanggans', 'pelanggans.id', '=', 'joborders.pelanggan_id')
                ->join('orders', 'joborders.id', '=', 'orders.joborder_id')->where('orders.status', 2)->groupBy('orders.joborder_id')
                ->select('joborders.id as joborder_id', 'pelanggans.nama', 'joborders.kode_jo', DB::raw('count(*) as jumlah_site'))
                ->paginate(20)
        ]);
    }

    public function delegasiOrder(Joborder $joborder)
    {
        return view('pages.job-delegasi-detail', [
            'orders' => Order::where('status', 2)
                ->where('joborder_id', $joborder->id)
                ->orderBy('id', 'asc')->paginate(100),
            'kordinators' => Kordinator::get()->all()
        ]);
    }

    public function handOver(Request $request)
    {
        $arrayItem = $request->id_item;
        $jumlah = count($arrayItem);

        for ($i = 0; $i < $jumlah; $i++) {
            DB::table('orders')
                ->where('id', $arrayItem[$i])
                ->update([
                    'kordinator_id' => $request->kordinator,
                    'status' => '3'
                ]);
        }
        return redirect('/job-delegasi')->with('berhasil', 'Job order berhasil di delegasi ke kordinator.');
    }

    // public function detail()
    // {
    //     return view('pages.job-detail', [
    //         'order' => Order::get()->first()
    //     ]);
    // }
    // Menampilkan halaman progres job order
    public function detail(Order $order)
    {
        return view('pages.job-detail', [
            'order' => Order::where('id', $order->id)->get()->first(),
            'activities' => jobActivity::where('order_id', $order->id)->paginate(100)
        ]);
    }
    // menampilkan job order yang sudah selesai (admin upload BA)
    public function finish()
    {
        return view('pages.job-finish', [
            'orders' => Order::where('status', 6)->orWhere('status', 7)->orderBy('id', 'asc')->paginate(100)
        ]);
    }
    // Menampilkan halaman ready to pay (Job order menunggu pembayaran)
    public function ready()
    {
        return view('pages.job-ready',  [
            'orders' => Order::where('status', 8)->paginate(100)
        ]);
    }

    public function paymentKonfirmasi(Order $order)
    {
        $order->where('id', $order->id)->update([
            'status' => '9',
        ]);

        return redirect()->to('job-complete')->with('berhasil', 'Konfirmasi pembayaran berhasil.');;
    }

    // Menampilkan halaman job complete 
    public function complete()
    {
        return view('pages.job-complete',  [
            'orders' => Order::where('status', 9)->paginate(100)
        ])->with('i');
    }



    public function hitungWaktu($start, $finish)
    {
        $mulai  = strtotime($start);
        $selesai  = strtotime($finish);
        $durasi = $selesai - $mulai;

        $hasil = round($durasi / 60);
        return $hasil;
    }

    protected function getJo()
    {

        // kode 2 digit tahun dan 2 digit bulan
        $kdAwal = "JO-";

        $nip = DB::table('joborders')
            ->max('kode_jo');
        if ($nip) {
            $nilaikode = substr($nip, 3);
            $kode = (int) $nilaikode;

            // Setiap kode ditambah 1
            $kode = $kode + 1;
            $kode_unik = $kdAwal . str_pad($kode, 4, "0", STR_PAD_LEFT);

            // dd($kode_unik);

        } else {
            $kode_unik = $kdAwal . '0001';
            // dd($kode_unik);
        }
        return $kode_unik;
    }

    protected function getIdJoborder()
    {

        $id = DB::table('joborders')
            ->max('id');

        return $id;
    }
}
