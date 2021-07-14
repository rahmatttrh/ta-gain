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
        if($this->status == "1"){
            $status = "Drafted Order";
        } else if($this->status == "2"){
            $status = "Published Order";
        } else if($this->status == "3"){
            $status = "Waiting for the coordinator's response";
        } else if($this->status == "4"){
            $status = "Waiting waiting for the delegation to the technician";
        } else if($this->status == "5"){
            $status = "On progress";
        } else if($this->status == "6"){
            $status = "Reporting on progress";
        } else if($this->status == "7"){
            $status = "Finished order";
        } else if($this->status == "8"){
            $status = "Waiting for BAST Validation";
        } else if($this->status == "9"){
            $status = "Waiting for payment";
        } else if($this->status == "10"){
            $status = "Completed order";
        }

        return [
            'id' => $this->id,
            'status' => $this->status,
            'info_status' => $status,
            'joborder_id' => $this->joborder_id,
            'client' => $this->pelanggan->nama,
            'client_id' => $this->pelanggan_id,
            'kordinator' => $this->kordinator->nama,
            'kordinator_id' => $this->kordinator->id,
            'bast' => $this->bast,
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
            'created_at' => $this->created_at->format("d F Y"),
            'updated_at' => $this->updated_at->format("d F Y")
        ];
    }

    public function with($request){
        return ['status' => 'success'];
    }
}
