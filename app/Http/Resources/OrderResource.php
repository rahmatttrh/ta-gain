<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'joborder_id' => $this->joborder_id,
            'client' => $this->pelanggan->nama,
            'client_id' => $this->pelanggan_id,
            'kordinator' => $this->kordinator->nama,
            'teknisi' => $this->teknisis,
            'site' => $this->site,
            'provinsi' => $this->provinsi,
            'kabupaten' => $this->kabupaten,
            'alamat' => $this->alamat,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'nama_projek' => $this->nama_projek,
            'no_telpon' => $this->no_telpon,
            'ukuran' => $this->ukuran,
            'system_antena' => $this->system_antena,
            'jenis_pekerjaan' => $this->jenis_pekerjaan,
            'harga_paket' => $this->harga_paket,
            'total_reimburse' => $this->total_reimburse,
            'modem' => $this->modem,
            'alasan_penolakan' => $this->alasan_penolakan,
            'keterangan_status' => $this->keterangan_status,
            'published' => $this->created_at->format("d F Y")
        ];
    }

    public function with($request){
        return ['status' => 'success'];
    }
}
