<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable=[
      'subcategory_name',
      'category_id',
      'show_on_menu',
      'subcategory_order',
    ];
    public function category()
    {
  return $this->belongsTo(Category::class,'category_id');
    }

    public function rpost()
    {
    return $this->hasMany(Post::class)->orderBy('id','desc');
    }

    public function language()
    {
      return $this->belongsTo(Language::class,'language_id');
    }
}
