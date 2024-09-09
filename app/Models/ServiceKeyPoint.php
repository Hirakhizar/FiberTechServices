<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceKeyPoint extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'key_points'];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
   
}
