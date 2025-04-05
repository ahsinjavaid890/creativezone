<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    use HasFactory;
     protected $fillable = [
        'name', 'category_id', 'image', 'location_type', 'location_name',
        'location_address', 'address', 'start_date', 'start_time', 'end_date',
        'end_time', 'time_zone', 'description', 'video', 'website_url', 
        'facebook_url', 'instagram_url', 'youtube_url', 'tags', 'status'
    ];
}
