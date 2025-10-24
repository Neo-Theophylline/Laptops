<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $table = 'service_items';

    protected $guarded;

            public function details()
    {
        return $this->hasMany(ServiceDetail::class, 'service_item_id');
    }
}
