<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrderImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['site'] == 'Wajib') {
            return null;
        }

        // $unix_date = ($row['tanggal'] - 25569) * 86400;
        // $tanggal = date("Y-m-d", $unix_date);

        // $time_in = $row['jam_in'] * 86400;
        // $jam_in = date('H:i', $time_in);

        // $time_out = $row['jam_out'] * 86400;
        // $jam_out = date('H:i', $time_out);

        // $time_dur = $row['waktu_pengisian'] * 86400;
        // $waktu_pengisian = date('H:i', $time_dur);

        return new Order([
            //
            'pelanggan_id' => request('client'),
            'site' => $row['site'],
            'provinsi' => $row['provinsi'],
            'kabupaten' => $row['kabupaten'],
            'alamat' => $row['alamat'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'nama_projek' => $row['nama_projek'],
            'no_telpon' => $row['no_telpon'],
            'ukuran' => $row['ukuran'],
            'system_antena' => $row['system_antena'],
            'jenis_pekerjaan' => $row['jenis_pekerjaan'],
            'harga_paket' => $row['harga_paket'],
            'total_reimburse' => $row['total_reimburse'],
            'grand_total' => $row['grand_total'],
            'modem' => $row['modem'],
            'status' => '1',
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
