<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPhoto extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relasi ke pk order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // relasi ke pk pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
