<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function subcategory()
    {
  return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function language()
    {
  return $this->belongsTo(Language::class,'language_id');
    }
}
