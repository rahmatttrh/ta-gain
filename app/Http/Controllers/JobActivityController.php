<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Joborder, Kordinator, Order, Pelanggan, Teknisi, jobActivity};

class JobActivityController extends Controller
{
    public function activity(Order $order)
    {
        request()->validate([
            'activity' => 'required',
            // 'jam' => 'required',
        ]);


        jobActivity::create([
            'order_id' => $order->id,
            'pelanggan_id' => $order->pelanggan->id,
            'kegiatan' => request('activity'),
            'jam' => request('jam'),
            'tanggal' => request('tanggal'),
            // 'selesai' => request('finish'),
            // 'durasi' => $this->hitungWaktu(request('start'), request('finish'))
        ]);

        return redirect()->back()->with('berhasil', 'Progres berhasil di update.');
    }

    public function finishJob(Order $order)
    {

        $order->where('id', $order->id)->update([
            'status' => '6',
        ]);

        jobActivity::create([
            'order_id' => $order->id,
            'pelanggan_id' => $order->pelanggan->id,
            'kegiatan' => 'Selesai',
            'jam' => $this->getDateNow(),
            'tanggal' => $this->getDateNow(),
            // 'selesai' => '-',
            // 'durasi' => '-'
        ]);

        return redirect()->back();
    }

    public function pendingJob(Request $request)
    {

        Order::where('id', $request->id)->update([
            'keterangan_status' => $request->keterangan_status,
            'status' => '202'
        ]);

        return redirect()->back();
    }
    public function continueJob(Order $order)
    {

        $order->where('id', $order->id)->update([
            'status' => '5',
        ]);

        return redirect()->back();
    }


    public function getDateNow()
    {
        date_default_timezone_set('Asia/Jakarta');
        $dateNow = date('Y-m-d h:i:s');

        return $dateNow;
    }
}
