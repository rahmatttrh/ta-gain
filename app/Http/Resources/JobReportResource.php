<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\{JobPhoto, Teknisi,Pelanggan, Order};

class JobReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $order = Order::where('id', $this->order_id)->get()->first();
        $client = Pelanggan::where('id', $this->pelanggan_id)->get()->first();
        $teknisi = Teknisi::where('id', $this->teknisi_id)->get()->first();
        // dd($teknisi);
        if($this->status == "1"){
            $status = "Waiting for client validation";
        } else if($this->status == "2"){
            $status = "Approved";
        } else if($this->status == "201"){
            $status = "Rejected, need revision ";
        }
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'site' => $order->site,
            'pelanggan_id' => $this->pelanggan_id,
            'client_name' => $client->nama,
            'teknisi_id' => $this->teknisi_id,
            'teknisi_nama' => $teknisi->nama,
            'foto_pekerjaan' => $this->foto_pekerjaan,
            'judul_foto' => $this->judul_foto,
            'deskripsi_foto' => $this->deskripsi_foto,
            'keterangan' => $this->keterangan,
            'status' => $this->status,
            'info_status' => $status,
            'date_created_at' => $this->created_at->format("d F Y"),
            'time_created_at' => $this->created_at->toTimeString(),
            'date_updated_at' => $this->updated_at->format("d F Y"),
            'time_updated_at' => $this->updated_at->toTimeString(),
        ];
    }
}
