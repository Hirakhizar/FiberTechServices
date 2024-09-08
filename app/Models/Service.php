<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon'];
    
    public function keyPoints()
    {
        return $this->hasMany(ServiceKeyPoint::class);
    }

    public function details()
    {
        return $this->hasOne(ServiceDetail::class);
    }
}
