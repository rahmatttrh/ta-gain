<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joborder extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi PK
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    // Relasi FK
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
