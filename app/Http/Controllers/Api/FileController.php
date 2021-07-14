<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Storage};
use App\Models\{Order,JobPhoto, Pelanggan};
use ZipArchive;
use File;

class FileController extends Controller
{
    public function getZip(Order $order)
    {

        // return "haloo";
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
                    $files = File::files(public_path('storage/app/images/foto-pekerjaan/' . $fileName));

                    foreach ($files as $key => $value) {
                        $relativeName = basename($value);
                        $zip->addFile($value, $relativeName);
                    }
                    $zip->close();
                }
                // return response()->download(public_path('file/' . $fileName));
                $urlFile = "file/".$fileName;
                return response()->json([
                    "message" => "success",
                    "url" => $urlFile
                ]);
                // return redirect()->to('http://localhost:8000/file/'.$fileName);
            }
        }
    }
}
