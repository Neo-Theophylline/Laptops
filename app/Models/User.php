<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded;

    protected $hidden = [
        'password',
        'remember_token',
    ];

        public function customerServices()
    {
        return $this->hasMany(Service::class, 'customer_id');
    }

    public function technicianServices()
    {
        return $this->hasMany(Service::class, 'technician_id');
    }
}
