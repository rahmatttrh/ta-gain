<?php

namespace App\Http\Controllers;

use App\Models\JobPhoto;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use File;
use Illuminate\Contracts\Cache\Store;

class FileController extends Controller
{
    // public function bastMaster(Order $order)
    // {
    //     return view('partials.formBastMaster', [
    //         'order' => Order::where('id', $order->id)->get()->first()
    //     ]);
    // }

    // public function uploadBastMaster(Order $order)
    // {
    //     request()->validate([
    //         'masterBast' => 'required'
    //     ]);

    //     if (request('masterBast')) {

    //         Storage::delete($order->bast_master);
    //         $masterBast = request()->file('masterBast')->store('bastMaster');
    //     } elseif (!request('masterBast')) {
    //         $masterBast = $order->bast_master;
    //     } else {
    //         $masterBast = null;
    //     }

    //     $order->update([
    //         'bast_master' => $masterBast,
    //     ]);

    //     return redirect()->to('job-finish')->with('berhasil', 'Master BAST berhasil di upload.');
    // }

    public function downloadBastMaster(Order $order)
    {
        $bast = $order->pelanggan->bast;
        if ($bast) {
            $namaFile = 'MASTER BAST ' . $order->pelanggan->nama;
            return Storage::download($bast, $namaFile);
        } else {
            return redirect()->back()->with('warning', 'BAST gagal di download.');
        }
    }


    public function bast(Order $order)
    {
        return view('partials.formBast', [
            'order' => Order::where('id', $order->id)->get()->first()
        ]);
    }

    public function uploadBast(Order $order)
    {
        request()->validate([
            'bast' => 'required'
        ]);

        if (request('bast')) {

            Storage::delete($order->bast);
            $bast = request()->file('bast')->store('bast');
        } elseif (!request('bast')) {
            $bast = $order->bast;
        } else {
            $bast = null;
        }

        $order->update([
            'bast' => $bast,
        ]);

        return redirect()->to('kordinator-finish')->with('berhasil', 'BAST berhasil di upload.');
    }

    public function downloadBast(Order $order)
    {
        if ($order->bast) {
            $order = Order::where('id', $order->id)->get()->first();
            $namaFile = 'BAST ' . $order->site;
            return Storage::download($order->bast, $namaFile);
        } else {
            return redirect()->back()->with('warning', 'BAST gagal di download.');
        }
    }

    public function getZip(Order $order)
    {
        // dd($order->id);
        $zip = new ZipArchive;
        $fileName = $order->site;
        $cek = JobPhoto::where('order_id', $order->id)->get()->first();
        if (!$cek) {
            return redirect()->back()->with('warning', 'Report tidak ada.');
        } else {
            if (public_path('file/' . $fileName)) {
                File::delete('file/' . $fileName);
                if ($zip->open(public_path('file/' . $fileName), ZipArchive::CREATE) === TRUE) {
                    $files = File::files(public_path('storage/images/foto-pekerjaan/' . $fileName));

                    foreach ($files as $key => $value) {
                        $relativeName = basename($value);
                        $zip->addFile($value, $relativeName);
                    }
                    $zip->close();
                }
                return response()->download(public_path('file/' . $fileName));
            }
        }
    }
}
