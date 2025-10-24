<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded;

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class);
    }

    public function details()
    {
        return $this->hasMany(ServiceDetail::class);
    }
}

