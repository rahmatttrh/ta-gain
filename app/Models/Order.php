<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function joborder()
    {
        return $this->belongsTo(Joborder::class);
    }

    public function jobActivities()
    {
        return $this->hasMany(jobActivity::class);
    }

    public function jobphotos()
    {
        return $this->hasMany(JobPhoto::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function kordinator()
    {
        return $this->belongsTo(Kordinator::class);
    }

    public function teknisis()
    {
        return $this->belongsToMany(Teknisi::class);
    }

    // Relasi PK
    public function reimburse()
    {
        return $this->hasMany(Reimburse::class);
    }
}
