<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $fillable=[
        'above_search_ad_url',
        'above_search_ad_status',
        'above_footer_ad_url',
        'above_footer_ad_status',
    ];
}
