<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Teknisi, Order, JobPhoto, jobActivity};
use Illuminate\Support\Facades\{Hash, Storage};
use App\Http\Resources\{OrderResource, OrdersResource,  JobReportResource};

class ReportController extends Controller
{
    public function report(Teknisi $teknisi){
        $orders = $teknisi->orders->where('status', 6);
        return response()->json([
            'message' => 'success',
            'orders' => OrderResource::collection($orders)
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
            'jobReport' => JobReportResource::collection($jobReport),
            // 'jobReport' => $jobReport,
            'revisiReport' => $revisi
        ]);
    }

    public function reportRevisi(JobPhoto $job){
        $foto = JobPhoto::where('id', $job->id)->get()->first();
        return response()->json([
            'foto' => new JobReportResource($foto)
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
            'foto_pekerjaan' => $request->file('foto_pekerjaan')?$request->file('foto_pekerjaan')->store('images/foto-pekerjaan/' . $orderName): '',
            'status' => '1'
        ]);

        return response()->json([
            'message' => 'success',
            'job' => $job
        ]);

    }

    public function update(Request $request, JobPhoto $job){

        $order = Order::where('id',  $job->order_id)->get()->first();
        // dd($order);
        $orderName = $order->site;

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
