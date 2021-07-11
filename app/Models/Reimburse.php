<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimburse extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi FK
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
