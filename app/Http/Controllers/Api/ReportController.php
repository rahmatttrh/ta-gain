<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Teknisi, Order, JobPhoto, jobActivity};

use App\Http\Resources\{OrderResource, OrdersResource};

class ReportController extends Controller
{
    public function report(Teknisi $teknisi){
        $orders = $teknisi->orders->where('status', 6);
        return response()->json([
            'message' => 'success',
            'orders' => OrdersResource::collection($orders)
        ]);
    }

    public function reportDetail(Order $order){
        $jobReport = JobPhoto::where('order_id', $order->id)->get();
        $revisiReport = JobPhoto::where('order_id', $order->id)->where('status', 201)->get()->first();
        if($revisiReport){
            $revisi = 1;
        } else if(!$revisiReport) {
            $revisi = 0;
        }
        return response()->json([
            'order' => new OrderResource($order) ,
            'jobReport' => $jobReport,
            'revisiReport' => $revisi
        ]);
    }

    public function reportRevisi(JobPhoto $job){
        $foto = JobPhoto::where('id', $job->id)->get()->first();
        return response()->json([
            'foto' => $foto
        ]);
    }

    public function upload(Request $request){
        // return $request->file('foto_pekerjaan');
        $order = Order::where('id', $request->order_id)->get()->first();
        
        $orderName = $order->site;
        $job = JobPhoto::create([
            'order_id' => $request->order_id,
            'pelanggan_id' => $request->pelanggan_id,
            'teknisi_id' => $request->teknisi_id,
            'judul_foto' => $request->judul_foto,
            'deskripsi_foto' => $request->deskripsi_foto,
            'foto_pekerjaan' => $request->file('foto_pekerjaan')?$request->file('foto_pekerjaan')->store('storage/images/foto-pekerjaan/' . $orderName): '',
            'status' => '1'
        ]);

        return response()->json([
            'message' => 'success',
            'job' => $job
        ]);

    }

    public function update(Request $request, JobPhoto $job){

        if ($request->file('foto_pekerjaan')) {
            Storage::delete($job->foto_pekerjaan);
            $fotoPekerejaan = $request->foto_pekerjaan->store('images/foto-pekerjaan/' . $orderName);
        } elseif ($job->foto_pekerjaan) {
            $fotoPekerejaan = $job->foto_pekerjaan;
        } else {
            $fotoPekerejaan = null;
        }

        $job->update([
            'judul_foto' => $request->judul_foto,
            'deskripsi_foto' => $request->deskripsi_foto,
            'foto_pekerjaan' => $fotoPekerejaan,
            'status' => '1'
        ]);

        return response()->json([
            'message' => 'success',
            'job' => $job
        ]);

    }
}
