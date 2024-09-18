<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function keyPoints()
    {
        return $this->hasMany(ServiceKeyPoint::class,'service_id');
    }

    public function details()
    {
        return $this->hasMany(ServiceDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
