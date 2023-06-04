<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopAds extends Model
{
    use HasFactory;
    protected $fillable=[
        'top_ad',
        'top_ad_url',
        'top_ad_status',
    ];
}
