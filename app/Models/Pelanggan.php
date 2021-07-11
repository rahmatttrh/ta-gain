<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function joborder()
    {
        return $this->hasMany(Joborder::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function jobActivities()
    {
        return $this->hasMany(JobActivity::class);
    }
}
