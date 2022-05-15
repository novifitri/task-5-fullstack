<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;
    //relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relasi ke article
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
      //untuk fungsi search
      public function scopeFilter($query, array $filters)
      {
         $query->when($filters['search'] ?? false, function($query, $search){
             return $query->where('name', 'like', '%' . $search . '%');
         }); 
      }
}
