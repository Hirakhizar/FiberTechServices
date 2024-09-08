<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id', 'service_description', 'main_image', 'subtitle',
        'first_section_image', 'first_section_title',
        'second_section_image', 'second_section_title',
        'summary_title', 'summary_description'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
