<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_name',
        'show_on_menu',
        'category_order',
      ];
      
      public function rsubcategory()
      {
      return $this->hasMany(Subcategory::class)->where('show_on_menu','Show')->orderBy('subcategory_order','asc');
      }  

      public function language()
      {
       return $this->belongsTo(Language::class,'language_id');
      }
}
